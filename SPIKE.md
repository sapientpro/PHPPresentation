# Spike: a package layer, and a binding generated from the schema

Branch `spike/opc-and-binding`, no PR. Nothing existing was edited: the only change to a
tracked file is three lines of `composer.json` registering two namespaces. Everything else
is new files.

    src/Opc/                      845 lines   the OPC package layer
    src/OpenXml/                  620 lines   schema parser, exporter, binding engine
    src/OpenXml/Schema/Generated/ 3747 lines  generated, not written
    src/PhpPresentation/OpenXml/  149 lines   the one hand-written mapping
    tests/                        476 lines   36 tests

Gates: `phpunit` 854 tests green (818 before), `phpstan` level 6 clean, `phpmd` clean,
`php-cs-fixer` clean. No PHP 8 only syntax, so the 7.4 leg of the matrix is safe.

## Part 1 -- `PhpOffice\Opc`

The layer every OOXML format shares, with nothing above it: a package is a zip of parts,
each part has a content type, and parts name each other through relationships.

    Package::open() / create() / save()   parts read lazily out of the zip
    Package::getPart() / addPart() / getRelatedParts()
    Part                                   name, content type, bytes, its relationships
    Relationships / Relationship           parsed and written, ids allocated
    ContentTypes                           defaults by extension, overrides by name
    PartName                               resolve, relativise, the `_rels` naming rule

`PackageTest` opens a real `.pptx` the library itself wrote and walks it -- package to
presentation to slide to layout -- **without a single line that knows what a slide is**,
then builds a package from nothing, saves it, reopens it and checks what came back. A
target written as `media/image1.png` inside `/ppt/presentation.xml` reads back as
`/ppt/media/image1.png`, which is the whole point of the layer.

This is the part that is format-agnostic: a `.docx` and a `.xlsx` are read by the same
code. Nothing here needed inventing -- it is what the existing reader and writer do by
hand, in one place instead of scattered.

## Part 2 -- `PhpOffice\OpenXml`, the binding

`XsdParser` reads `dml-main.xsd` and hands back, for each complex type, the attributes it
allows (with their value spaces) and the children it allows **in the order the sequence
declares them**. `SpecExporter` writes that into a checked-in PHP file. `Engine` reads and
writes an element from that description. `FontBinding` -- 149 lines -- says how the
model's `Style\Font` lines up with `CT_TextCharacterProperties`, and says it once.

What the generated description knows about `a:rPr` without anyone telling it: 19
attributes, `b` is a boolean, `u` is one of 18 words, and the 21 children go in the order
`ln, noFill, solidFill, gradFill, blipFill, pattFill, grpFill, effectLst, effectDag,
highlight, uLnTx, uLn, uFillTx, uFill, latin, ea, cs, sym, hlinkClick, hlinkMouseOver,
extLst`.

### The measure

`BindingTest` writes a presentation with the library's own writer, opens it **with the OPC
layer from part 1**, pulls the `a:rPr` out of the slide, and compares it -- canonicalised,
so whitespace and attribute order do not count -- against what the engine produces from
the same run. Nine fonts: left alone, bold and italic, a size and a colour, a translucent
colour, underlined and struck through, small capitals spaced out and raised, an east asian
face, a complex script face with a panose and a charset, another language.

**All nine are identical.** The same table then reads its own output back into a `Font`
that matches the original in every property.

So: for this family, the hand-written writer is redundant, and the reader that does not
exist yet is free.

### What it found on the way

`CT_TextFont@charset` is an `xsd:byte`. The writer spells it in hexadecimal
(`AbstractSlide::writeRunStyles()`), the reader reads it as decimal
(`PowerPoint2007::loadParagraph()`), and the schema allows only the decimal form. A
charset of 18 is written as `"12"` and read back as 12. No test complains --
`PptSlidesTest::testRichTextRunFontCharset()` asserts the `"12"`.

Three parties disagree and the suite is green. That is the class of bug the approach is
supposed to make impossible, and it surfaced on the first family, before the engine was
even finished. Pinned in `BindingTest::testTheBindingFindsWhatTheHandWrittenPairGetsWrong()`;
not fixed here, it deserves its own PR upstream.

### Why one family is worth this much

The same run properties are written in **27 places** (`a:rPr`, `a:defRPr`, `a:endParaRPr`
across `PptCharts`, `AbstractSlide`, `PptSlideMasters`) and read in **3**. That asymmetry
is the 3599:420 ratio from `REFACTORING.md` in miniature, and it is why a saved deck loses
what it loses: the writer says twenty-seven things and the reader asks three questions.

One description, two directions, one mapping per concept -- 27 and 3 both become 1.

## What the pilot does not do yet

1. **Qualified attributes.** `r:id` on `a:hlinkClick` is declared as `xsd:attribute ref=`,
   which the parser skips. Hyperlinks are therefore out of the mapping. Half a day.
2. **Text content.** Types with simple content (`a:t`) are not modelled; only elements
   with attributes and children are. Half a day.
3. **Choices are not enforced.** The engine will happily write both `noFill` and
   `solidFill`; the schema says pick one. A day, and it makes invalid output impossible.
4. **Schema defaults are not applied on read** -- an absent attribute stays absent rather
   than becoming its declared default.
5. Only the types reachable from `CT_TextCharacterProperties` and
   `CT_TextParagraphProperties` are generated (95 of them).

## The weight question

95 types cost 106 KB of generated PHP. The pptx-relevant schemas hold 510 complex types
(`dml-main` 227, `pml` 148, `dml-chart` 135), so the full description would be roughly
570 KB -- one `require` per vocabulary, loaded only when something reads or writes that
vocabulary. Apache POI ships 15 MB of generated classes for the same job; this is a table,
not ten thousand classes, which is the shape that suits PHP.

## What the next step would cost

- Close the four gaps above: 2-3 days.
- Move `a:rPr` writing in the library onto the binding (27 sites): 2-3 days, each site a
  small commit, the existing tests as the net.
- Generate `c:` and `p:` and do the same for the chart axis and the shape properties:
  1-2 weeks.
- Extract `PhpOffice\Opc` into a package of its own once a second library wants it: a day,
  and it is a decision rather than work.

# Readers

## ODPresentation
The name of the reader is `ODPresentation`.

``` php
<?php

$reader = IOFactory::createReader('ODPresentation');
$reader->load(__DIR__ . '/sample.odp');
```

### Options

#### Load without images

You can load a presentation without images.

``` php
<?php

use PhpOffice\PhpPresentation\Reader\ODPresentation;

$reader = new ODPresentation();
$reader->load(__DIR__ . '/sample.odp', ODPresentation::SKIP_IMAGES);
```

## PowerPoint97
The name of the reader is `PowerPoint97`.

``` php
<?php

$reader = IOFactory::createReader('PowerPoint97');
$reader->load(__DIR__ . '/sample.ppt');
```

### Options

#### Load without images

You can load a presentation without images.

``` php
<?php

use PhpOffice\PhpPresentation\Reader\PowerPoint97;

$reader = new PowerPoint97();
$reader->load(__DIR__ . '/sample.ppt', PowerPoint97::SKIP_IMAGES);
```

## PowerPoint2007
The name of the reader is `PowerPoint2007`.

``` php
<?php

$reader = IOFactory::createReader('PowerPoint2007');
$reader->load(__DIR__ . '/sample.pptx');
```

### Options

#### Load without images

You can load a presentation without images.

``` php
<?php

use PhpOffice\PhpPresentation\Reader\PowerPoint2007;

$reader = new PowerPoint2007();
$reader->load(__DIR__ . '/sample.pptx', PowerPoint2007::SKIP_IMAGES);
```

## Serialized
The name of the reader is `Serialized`.

``` php
<?php

$reader = IOFactory::createReader('Serialized');
$reader->load(__DIR__ . '/sample.phppt');
```

## A reader of your own
`IOFactory` names a reader shipped here by its short name, and one of your own by its fully
qualified class name. Anything implementing `ReaderInterface` will do.

``` php
<?php

use PhpOffice\PhpPresentation\IOFactory;

$reader = IOFactory::createReader(\Acme\Presentation\Reader\Keynote::class);
$reader->load(__DIR__ . '/sample.key');
```

`IOFactory::load()` asks each reader in turn whether it can read the file. Pass the readers to ask,
in the order to ask them; `getDefaultReaders()` gives the ones shipped here, so that yours can be
added to them rather than replace them.

``` php
<?php

use PhpOffice\PhpPresentation\IOFactory;

$presentation = IOFactory::load(__DIR__ . '/sample.key', array_merge(
    [\Acme\Presentation\Reader\Keynote::class],
    IOFactory::getDefaultReaders()
));
```

A reader that says it can read the file and then fails does not end the search: the next one is
asked. Only when none of them has produced a presentation is the failure raised, carrying the first
one as its previous exception.

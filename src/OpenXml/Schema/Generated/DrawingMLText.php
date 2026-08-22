<?php

/**
 * This file is part of PHPPresentation - A pure PHP library for reading and writing
 * presentations documents.
 *
 * PHPPresentation is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPPresentation/contributors.
 *
 * @see        https://github.com/PHPOffice/PHPPresentation
 *
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

declare(strict_types=1);

/*
 * Generated from tests/resources/schema/ecma-376/dml-main.xsd, rooted at CT_TextCharacterProperties, CT_TextParagraphProperties, by PhpOffice\OpenXml\Codegen\SpecExporter.
 * Do not edit: run the generator instead, and let the test that checks it prove it is current.
 */

return [
    'CT_AlphaBiLevelEffect' => [
        'attributes' => [
            'thresh' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_AlphaCeilingEffect' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_AlphaFloorEffect' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_AlphaInverseEffect' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'scrgbClr',
                'type' => 'CT_ScRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'srgbClr',
                'type' => 'CT_SRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'hslClr',
                'type' => 'CT_HslColor',
                'repeated' => false,
            ],
            [
                'name' => 'sysClr',
                'type' => 'CT_SystemColor',
                'repeated' => false,
            ],
            [
                'name' => 'schemeClr',
                'type' => 'CT_SchemeColor',
                'repeated' => false,
            ],
            [
                'name' => 'prstClr',
                'type' => 'CT_PresetColor',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_AlphaModulateEffect' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'cont',
                'type' => 'CT_EffectContainer',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_AlphaModulateFixedEffect' => [
        'attributes' => [
            'amt' => [
                'type' => 'int',
                'values' => [],
                'default' => '100000',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_AlphaOutsetEffect' => [
        'attributes' => [
            'rad' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_AlphaReplaceEffect' => [
        'attributes' => [
            'a' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_Angle' => [
        'attributes' => [
            'val' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_BiLevelEffect' => [
        'attributes' => [
            'thresh' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_BlendEffect' => [
        'attributes' => [
            'blend' => [
                'type' => 'enum',
                'values' => [
                    'over',
                    'mult',
                    'screen',
                    'darken',
                    'lighten',
                ],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'cont',
                'type' => 'CT_EffectContainer',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_Blip' => [
        'attributes' => [
            'cstate' => [
                'type' => 'enum',
                'values' => [
                    'email',
                    'screen',
                    'print',
                    'hqprint',
                    'none',
                ],
                'default' => 'none',
            ],
        ],
        'children' => [
            [
                'name' => 'alphaBiLevel',
                'type' => 'CT_AlphaBiLevelEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaCeiling',
                'type' => 'CT_AlphaCeilingEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaFloor',
                'type' => 'CT_AlphaFloorEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaInv',
                'type' => 'CT_AlphaInverseEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaMod',
                'type' => 'CT_AlphaModulateEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaModFix',
                'type' => 'CT_AlphaModulateFixedEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaRepl',
                'type' => 'CT_AlphaReplaceEffect',
                'repeated' => false,
            ],
            [
                'name' => 'biLevel',
                'type' => 'CT_BiLevelEffect',
                'repeated' => false,
            ],
            [
                'name' => 'blur',
                'type' => 'CT_BlurEffect',
                'repeated' => false,
            ],
            [
                'name' => 'clrChange',
                'type' => 'CT_ColorChangeEffect',
                'repeated' => false,
            ],
            [
                'name' => 'clrRepl',
                'type' => 'CT_ColorReplaceEffect',
                'repeated' => false,
            ],
            [
                'name' => 'duotone',
                'type' => 'CT_DuotoneEffect',
                'repeated' => false,
            ],
            [
                'name' => 'fillOverlay',
                'type' => 'CT_FillOverlayEffect',
                'repeated' => false,
            ],
            [
                'name' => 'grayscl',
                'type' => 'CT_GrayscaleEffect',
                'repeated' => false,
            ],
            [
                'name' => 'hsl',
                'type' => 'CT_HSLEffect',
                'repeated' => false,
            ],
            [
                'name' => 'lum',
                'type' => 'CT_LuminanceEffect',
                'repeated' => false,
            ],
            [
                'name' => 'tint',
                'type' => 'CT_TintEffect',
                'repeated' => false,
            ],
            [
                'name' => 'extLst',
                'type' => 'CT_OfficeArtExtensionList',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_BlipFillProperties' => [
        'attributes' => [
            'dpi' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'rotWithShape' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'blip',
                'type' => 'CT_Blip',
                'repeated' => false,
            ],
            [
                'name' => 'srcRect',
                'type' => 'CT_RelativeRect',
                'repeated' => false,
            ],
            [
                'name' => 'tile',
                'type' => 'CT_TileInfoProperties',
                'repeated' => false,
            ],
            [
                'name' => 'stretch',
                'type' => 'CT_StretchInfoProperties',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_BlurEffect' => [
        'attributes' => [
            'rad' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'grow' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'true',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_Color' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'scrgbClr',
                'type' => 'CT_ScRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'srgbClr',
                'type' => 'CT_SRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'hslClr',
                'type' => 'CT_HslColor',
                'repeated' => false,
            ],
            [
                'name' => 'sysClr',
                'type' => 'CT_SystemColor',
                'repeated' => false,
            ],
            [
                'name' => 'schemeClr',
                'type' => 'CT_SchemeColor',
                'repeated' => false,
            ],
            [
                'name' => 'prstClr',
                'type' => 'CT_PresetColor',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_ColorChangeEffect' => [
        'attributes' => [
            'useA' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'true',
            ],
        ],
        'children' => [
            [
                'name' => 'clrFrom',
                'type' => 'CT_Color',
                'repeated' => false,
            ],
            [
                'name' => 'clrTo',
                'type' => 'CT_Color',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_ColorReplaceEffect' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'scrgbClr',
                'type' => 'CT_ScRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'srgbClr',
                'type' => 'CT_SRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'hslClr',
                'type' => 'CT_HslColor',
                'repeated' => false,
            ],
            [
                'name' => 'sysClr',
                'type' => 'CT_SystemColor',
                'repeated' => false,
            ],
            [
                'name' => 'schemeClr',
                'type' => 'CT_SchemeColor',
                'repeated' => false,
            ],
            [
                'name' => 'prstClr',
                'type' => 'CT_PresetColor',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_ComplementTransform' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_DashStop' => [
        'attributes' => [
            'd' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'sp' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_DashStopList' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'ds',
                'type' => 'CT_DashStop',
                'repeated' => true,
            ],
        ],
        'opaque' => false,
    ],
    'CT_DuotoneEffect' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'scrgbClr',
                'type' => 'CT_ScRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'srgbClr',
                'type' => 'CT_SRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'hslClr',
                'type' => 'CT_HslColor',
                'repeated' => false,
            ],
            [
                'name' => 'sysClr',
                'type' => 'CT_SystemColor',
                'repeated' => false,
            ],
            [
                'name' => 'schemeClr',
                'type' => 'CT_SchemeColor',
                'repeated' => false,
            ],
            [
                'name' => 'prstClr',
                'type' => 'CT_PresetColor',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_EffectContainer' => [
        'attributes' => [
            'type' => [
                'type' => 'enum',
                'values' => [
                    'sib',
                    'tree',
                ],
                'default' => 'sib',
            ],
            'name' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'cont',
                'type' => 'CT_EffectContainer',
                'repeated' => false,
            ],
            [
                'name' => 'effect',
                'type' => 'CT_EffectReference',
                'repeated' => false,
            ],
            [
                'name' => 'alphaBiLevel',
                'type' => 'CT_AlphaBiLevelEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaCeiling',
                'type' => 'CT_AlphaCeilingEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaFloor',
                'type' => 'CT_AlphaFloorEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaInv',
                'type' => 'CT_AlphaInverseEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaMod',
                'type' => 'CT_AlphaModulateEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaModFix',
                'type' => 'CT_AlphaModulateFixedEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaOutset',
                'type' => 'CT_AlphaOutsetEffect',
                'repeated' => false,
            ],
            [
                'name' => 'alphaRepl',
                'type' => 'CT_AlphaReplaceEffect',
                'repeated' => false,
            ],
            [
                'name' => 'biLevel',
                'type' => 'CT_BiLevelEffect',
                'repeated' => false,
            ],
            [
                'name' => 'blend',
                'type' => 'CT_BlendEffect',
                'repeated' => false,
            ],
            [
                'name' => 'blur',
                'type' => 'CT_BlurEffect',
                'repeated' => false,
            ],
            [
                'name' => 'clrChange',
                'type' => 'CT_ColorChangeEffect',
                'repeated' => false,
            ],
            [
                'name' => 'clrRepl',
                'type' => 'CT_ColorReplaceEffect',
                'repeated' => false,
            ],
            [
                'name' => 'duotone',
                'type' => 'CT_DuotoneEffect',
                'repeated' => false,
            ],
            [
                'name' => 'fill',
                'type' => 'CT_FillEffect',
                'repeated' => false,
            ],
            [
                'name' => 'fillOverlay',
                'type' => 'CT_FillOverlayEffect',
                'repeated' => false,
            ],
            [
                'name' => 'glow',
                'type' => 'CT_GlowEffect',
                'repeated' => false,
            ],
            [
                'name' => 'grayscl',
                'type' => 'CT_GrayscaleEffect',
                'repeated' => false,
            ],
            [
                'name' => 'hsl',
                'type' => 'CT_HSLEffect',
                'repeated' => false,
            ],
            [
                'name' => 'innerShdw',
                'type' => 'CT_InnerShadowEffect',
                'repeated' => false,
            ],
            [
                'name' => 'lum',
                'type' => 'CT_LuminanceEffect',
                'repeated' => false,
            ],
            [
                'name' => 'outerShdw',
                'type' => 'CT_OuterShadowEffect',
                'repeated' => false,
            ],
            [
                'name' => 'prstShdw',
                'type' => 'CT_PresetShadowEffect',
                'repeated' => false,
            ],
            [
                'name' => 'reflection',
                'type' => 'CT_ReflectionEffect',
                'repeated' => false,
            ],
            [
                'name' => 'relOff',
                'type' => 'CT_RelativeOffsetEffect',
                'repeated' => false,
            ],
            [
                'name' => 'softEdge',
                'type' => 'CT_SoftEdgesEffect',
                'repeated' => false,
            ],
            [
                'name' => 'tint',
                'type' => 'CT_TintEffect',
                'repeated' => false,
            ],
            [
                'name' => 'xfrm',
                'type' => 'CT_TransformEffect',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_EffectList' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'blur',
                'type' => 'CT_BlurEffect',
                'repeated' => false,
            ],
            [
                'name' => 'fillOverlay',
                'type' => 'CT_FillOverlayEffect',
                'repeated' => false,
            ],
            [
                'name' => 'glow',
                'type' => 'CT_GlowEffect',
                'repeated' => false,
            ],
            [
                'name' => 'innerShdw',
                'type' => 'CT_InnerShadowEffect',
                'repeated' => false,
            ],
            [
                'name' => 'outerShdw',
                'type' => 'CT_OuterShadowEffect',
                'repeated' => false,
            ],
            [
                'name' => 'prstShdw',
                'type' => 'CT_PresetShadowEffect',
                'repeated' => false,
            ],
            [
                'name' => 'reflection',
                'type' => 'CT_ReflectionEffect',
                'repeated' => false,
            ],
            [
                'name' => 'softEdge',
                'type' => 'CT_SoftEdgesEffect',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_EffectReference' => [
        'attributes' => [
            'ref' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_EmbeddedWAVAudioFile' => [
        'attributes' => [
            'name' => [
                'type' => 'string',
                'values' => [],
                'default' => '',
            ],
            'builtIn' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'false',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_FillEffect' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'noFill',
                'type' => 'CT_NoFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'solidFill',
                'type' => 'CT_SolidColorFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'gradFill',
                'type' => 'CT_GradientFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'blipFill',
                'type' => 'CT_BlipFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'pattFill',
                'type' => 'CT_PatternFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'grpFill',
                'type' => 'CT_GroupFillProperties',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_FillOverlayEffect' => [
        'attributes' => [
            'blend' => [
                'type' => 'enum',
                'values' => [
                    'over',
                    'mult',
                    'screen',
                    'darken',
                    'lighten',
                ],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'noFill',
                'type' => 'CT_NoFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'solidFill',
                'type' => 'CT_SolidColorFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'gradFill',
                'type' => 'CT_GradientFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'blipFill',
                'type' => 'CT_BlipFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'pattFill',
                'type' => 'CT_PatternFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'grpFill',
                'type' => 'CT_GroupFillProperties',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_FixedPercentage' => [
        'attributes' => [
            'val' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_GammaTransform' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_GlowEffect' => [
        'attributes' => [
            'rad' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
        ],
        'children' => [
            [
                'name' => 'scrgbClr',
                'type' => 'CT_ScRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'srgbClr',
                'type' => 'CT_SRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'hslClr',
                'type' => 'CT_HslColor',
                'repeated' => false,
            ],
            [
                'name' => 'sysClr',
                'type' => 'CT_SystemColor',
                'repeated' => false,
            ],
            [
                'name' => 'schemeClr',
                'type' => 'CT_SchemeColor',
                'repeated' => false,
            ],
            [
                'name' => 'prstClr',
                'type' => 'CT_PresetColor',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_GradientFillProperties' => [
        'attributes' => [
            'flip' => [
                'type' => 'enum',
                'values' => [
                    'none',
                    'x',
                    'y',
                    'xy',
                ],
                'default' => null,
            ],
            'rotWithShape' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'gsLst',
                'type' => 'CT_GradientStopList',
                'repeated' => false,
            ],
            [
                'name' => 'lin',
                'type' => 'CT_LinearShadeProperties',
                'repeated' => false,
            ],
            [
                'name' => 'path',
                'type' => 'CT_PathShadeProperties',
                'repeated' => false,
            ],
            [
                'name' => 'tileRect',
                'type' => 'CT_RelativeRect',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_GradientStop' => [
        'attributes' => [
            'pos' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'scrgbClr',
                'type' => 'CT_ScRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'srgbClr',
                'type' => 'CT_SRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'hslClr',
                'type' => 'CT_HslColor',
                'repeated' => false,
            ],
            [
                'name' => 'sysClr',
                'type' => 'CT_SystemColor',
                'repeated' => false,
            ],
            [
                'name' => 'schemeClr',
                'type' => 'CT_SchemeColor',
                'repeated' => false,
            ],
            [
                'name' => 'prstClr',
                'type' => 'CT_PresetColor',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_GradientStopList' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'gs',
                'type' => 'CT_GradientStop',
                'repeated' => true,
            ],
        ],
        'opaque' => false,
    ],
    'CT_GrayscaleEffect' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_GrayscaleTransform' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_GroupFillProperties' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_HSLEffect' => [
        'attributes' => [
            'hue' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'sat' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'lum' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_HslColor' => [
        'attributes' => [
            'hue' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'sat' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'lum' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'tint',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'shade',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'comp',
                'type' => 'CT_ComplementTransform',
                'repeated' => false,
            ],
            [
                'name' => 'inv',
                'type' => 'CT_InverseTransform',
                'repeated' => false,
            ],
            [
                'name' => 'gray',
                'type' => 'CT_GrayscaleTransform',
                'repeated' => false,
            ],
            [
                'name' => 'alpha',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaOff',
                'type' => 'CT_FixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'hue',
                'type' => 'CT_PositiveFixedAngle',
                'repeated' => false,
            ],
            [
                'name' => 'hueOff',
                'type' => 'CT_Angle',
                'repeated' => false,
            ],
            [
                'name' => 'hueMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'sat',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lum',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'red',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'green',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blue',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'gamma',
                'type' => 'CT_GammaTransform',
                'repeated' => false,
            ],
            [
                'name' => 'invGamma',
                'type' => 'CT_InverseGammaTransform',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_Hyperlink' => [
        'attributes' => [
            'invalidUrl' => [
                'type' => 'string',
                'values' => [],
                'default' => '',
            ],
            'action' => [
                'type' => 'string',
                'values' => [],
                'default' => '',
            ],
            'tgtFrame' => [
                'type' => 'string',
                'values' => [],
                'default' => '',
            ],
            'tooltip' => [
                'type' => 'string',
                'values' => [],
                'default' => '',
            ],
            'history' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'true',
            ],
            'highlightClick' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'false',
            ],
            'endSnd' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'false',
            ],
        ],
        'children' => [
            [
                'name' => 'snd',
                'type' => 'CT_EmbeddedWAVAudioFile',
                'repeated' => false,
            ],
            [
                'name' => 'extLst',
                'type' => 'CT_OfficeArtExtensionList',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_InnerShadowEffect' => [
        'attributes' => [
            'blurRad' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'dist' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'dir' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
        ],
        'children' => [
            [
                'name' => 'scrgbClr',
                'type' => 'CT_ScRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'srgbClr',
                'type' => 'CT_SRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'hslClr',
                'type' => 'CT_HslColor',
                'repeated' => false,
            ],
            [
                'name' => 'sysClr',
                'type' => 'CT_SystemColor',
                'repeated' => false,
            ],
            [
                'name' => 'schemeClr',
                'type' => 'CT_SchemeColor',
                'repeated' => false,
            ],
            [
                'name' => 'prstClr',
                'type' => 'CT_PresetColor',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_InverseGammaTransform' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_InverseTransform' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_LineEndProperties' => [
        'attributes' => [
            'type' => [
                'type' => 'enum',
                'values' => [
                    'none',
                    'triangle',
                    'stealth',
                    'diamond',
                    'oval',
                    'arrow',
                ],
                'default' => null,
            ],
            'w' => [
                'type' => 'enum',
                'values' => [
                    'sm',
                    'med',
                    'lg',
                ],
                'default' => null,
            ],
            'len' => [
                'type' => 'enum',
                'values' => [
                    'sm',
                    'med',
                    'lg',
                ],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_LineJoinBevel' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_LineJoinMiterProperties' => [
        'attributes' => [
            'lim' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_LineJoinRound' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_LineProperties' => [
        'attributes' => [
            'w' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'cap' => [
                'type' => 'enum',
                'values' => [
                    'rnd',
                    'sq',
                    'flat',
                ],
                'default' => null,
            ],
            'cmpd' => [
                'type' => 'enum',
                'values' => [
                    'sng',
                    'dbl',
                    'thickThin',
                    'thinThick',
                    'tri',
                ],
                'default' => null,
            ],
            'algn' => [
                'type' => 'enum',
                'values' => [
                    'ctr',
                    'in',
                ],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'noFill',
                'type' => 'CT_NoFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'solidFill',
                'type' => 'CT_SolidColorFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'gradFill',
                'type' => 'CT_GradientFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'pattFill',
                'type' => 'CT_PatternFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'prstDash',
                'type' => 'CT_PresetLineDashProperties',
                'repeated' => false,
            ],
            [
                'name' => 'custDash',
                'type' => 'CT_DashStopList',
                'repeated' => false,
            ],
            [
                'name' => 'round',
                'type' => 'CT_LineJoinRound',
                'repeated' => false,
            ],
            [
                'name' => 'bevel',
                'type' => 'CT_LineJoinBevel',
                'repeated' => false,
            ],
            [
                'name' => 'miter',
                'type' => 'CT_LineJoinMiterProperties',
                'repeated' => false,
            ],
            [
                'name' => 'headEnd',
                'type' => 'CT_LineEndProperties',
                'repeated' => false,
            ],
            [
                'name' => 'tailEnd',
                'type' => 'CT_LineEndProperties',
                'repeated' => false,
            ],
            [
                'name' => 'extLst',
                'type' => 'CT_OfficeArtExtensionList',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_LinearShadeProperties' => [
        'attributes' => [
            'ang' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'scaled' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_LuminanceEffect' => [
        'attributes' => [
            'bright' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'contrast' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_NoFillProperties' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_OfficeArtExtension' => [
        'attributes' => [
            'uri' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_OfficeArtExtensionList' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'ext',
                'type' => 'CT_OfficeArtExtension',
                'repeated' => true,
            ],
        ],
        'opaque' => false,
    ],
    'CT_OuterShadowEffect' => [
        'attributes' => [
            'blurRad' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'dist' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'dir' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'sx' => [
                'type' => 'int',
                'values' => [],
                'default' => '100000',
            ],
            'sy' => [
                'type' => 'int',
                'values' => [],
                'default' => '100000',
            ],
            'kx' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'ky' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'algn' => [
                'type' => 'enum',
                'values' => [
                    'tl',
                    't',
                    'tr',
                    'l',
                    'ctr',
                    'r',
                    'bl',
                    'b',
                    'br',
                ],
                'default' => 'b',
            ],
            'rotWithShape' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'true',
            ],
        ],
        'children' => [
            [
                'name' => 'scrgbClr',
                'type' => 'CT_ScRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'srgbClr',
                'type' => 'CT_SRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'hslClr',
                'type' => 'CT_HslColor',
                'repeated' => false,
            ],
            [
                'name' => 'sysClr',
                'type' => 'CT_SystemColor',
                'repeated' => false,
            ],
            [
                'name' => 'schemeClr',
                'type' => 'CT_SchemeColor',
                'repeated' => false,
            ],
            [
                'name' => 'prstClr',
                'type' => 'CT_PresetColor',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_PathShadeProperties' => [
        'attributes' => [
            'path' => [
                'type' => 'enum',
                'values' => [
                    'shape',
                    'circle',
                    'rect',
                ],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'fillToRect',
                'type' => 'CT_RelativeRect',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_PatternFillProperties' => [
        'attributes' => [
            'prst' => [
                'type' => 'enum',
                'values' => [
                    'pct5',
                    'pct10',
                    'pct20',
                    'pct25',
                    'pct30',
                    'pct40',
                    'pct50',
                    'pct60',
                    'pct70',
                    'pct75',
                    'pct80',
                    'pct90',
                    'horz',
                    'vert',
                    'ltHorz',
                    'ltVert',
                    'dkHorz',
                    'dkVert',
                    'narHorz',
                    'narVert',
                    'dashHorz',
                    'dashVert',
                    'cross',
                    'dnDiag',
                    'upDiag',
                    'ltDnDiag',
                    'ltUpDiag',
                    'dkDnDiag',
                    'dkUpDiag',
                    'wdDnDiag',
                    'wdUpDiag',
                    'dashDnDiag',
                    'dashUpDiag',
                    'diagCross',
                    'smCheck',
                    'lgCheck',
                    'smGrid',
                    'lgGrid',
                    'dotGrid',
                    'smConfetti',
                    'lgConfetti',
                    'horzBrick',
                    'diagBrick',
                    'solidDmnd',
                    'openDmnd',
                    'dotDmnd',
                    'plaid',
                    'sphere',
                    'weave',
                    'divot',
                    'shingle',
                    'wave',
                    'trellis',
                    'zigZag',
                ],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'fgClr',
                'type' => 'CT_Color',
                'repeated' => false,
            ],
            [
                'name' => 'bgClr',
                'type' => 'CT_Color',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_Percentage' => [
        'attributes' => [
            'val' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_PositiveFixedAngle' => [
        'attributes' => [
            'val' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_PositiveFixedPercentage' => [
        'attributes' => [
            'val' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_PositivePercentage' => [
        'attributes' => [
            'val' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_PresetColor' => [
        'attributes' => [
            'val' => [
                'type' => 'enum',
                'values' => [
                    'aliceBlue',
                    'antiqueWhite',
                    'aqua',
                    'aquamarine',
                    'azure',
                    'beige',
                    'bisque',
                    'black',
                    'blanchedAlmond',
                    'blue',
                    'blueViolet',
                    'brown',
                    'burlyWood',
                    'cadetBlue',
                    'chartreuse',
                    'chocolate',
                    'coral',
                    'cornflowerBlue',
                    'cornsilk',
                    'crimson',
                    'cyan',
                    'dkBlue',
                    'dkCyan',
                    'dkGoldenrod',
                    'dkGray',
                    'dkGreen',
                    'dkKhaki',
                    'dkMagenta',
                    'dkOliveGreen',
                    'dkOrange',
                    'dkOrchid',
                    'dkRed',
                    'dkSalmon',
                    'dkSeaGreen',
                    'dkSlateBlue',
                    'dkSlateGray',
                    'dkTurquoise',
                    'dkViolet',
                    'deepPink',
                    'deepSkyBlue',
                    'dimGray',
                    'dodgerBlue',
                    'firebrick',
                    'floralWhite',
                    'forestGreen',
                    'fuchsia',
                    'gainsboro',
                    'ghostWhite',
                    'gold',
                    'goldenrod',
                    'gray',
                    'green',
                    'greenYellow',
                    'honeydew',
                    'hotPink',
                    'indianRed',
                    'indigo',
                    'ivory',
                    'khaki',
                    'lavender',
                    'lavenderBlush',
                    'lawnGreen',
                    'lemonChiffon',
                    'ltBlue',
                    'ltCoral',
                    'ltCyan',
                    'ltGoldenrodYellow',
                    'ltGray',
                    'ltGreen',
                    'ltPink',
                    'ltSalmon',
                    'ltSeaGreen',
                    'ltSkyBlue',
                    'ltSlateGray',
                    'ltSteelBlue',
                    'ltYellow',
                    'lime',
                    'limeGreen',
                    'linen',
                    'magenta',
                    'maroon',
                    'medAquamarine',
                    'medBlue',
                    'medOrchid',
                    'medPurple',
                    'medSeaGreen',
                    'medSlateBlue',
                    'medSpringGreen',
                    'medTurquoise',
                    'medVioletRed',
                    'midnightBlue',
                    'mintCream',
                    'mistyRose',
                    'moccasin',
                    'navajoWhite',
                    'navy',
                    'oldLace',
                    'olive',
                    'oliveDrab',
                    'orange',
                    'orangeRed',
                    'orchid',
                    'paleGoldenrod',
                    'paleGreen',
                    'paleTurquoise',
                    'paleVioletRed',
                    'papayaWhip',
                    'peachPuff',
                    'peru',
                    'pink',
                    'plum',
                    'powderBlue',
                    'purple',
                    'red',
                    'rosyBrown',
                    'royalBlue',
                    'saddleBrown',
                    'salmon',
                    'sandyBrown',
                    'seaGreen',
                    'seaShell',
                    'sienna',
                    'silver',
                    'skyBlue',
                    'slateBlue',
                    'slateGray',
                    'snow',
                    'springGreen',
                    'steelBlue',
                    'tan',
                    'teal',
                    'thistle',
                    'tomato',
                    'turquoise',
                    'violet',
                    'wheat',
                    'white',
                    'whiteSmoke',
                    'yellow',
                    'yellowGreen',
                ],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'tint',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'shade',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'comp',
                'type' => 'CT_ComplementTransform',
                'repeated' => false,
            ],
            [
                'name' => 'inv',
                'type' => 'CT_InverseTransform',
                'repeated' => false,
            ],
            [
                'name' => 'gray',
                'type' => 'CT_GrayscaleTransform',
                'repeated' => false,
            ],
            [
                'name' => 'alpha',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaOff',
                'type' => 'CT_FixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'hue',
                'type' => 'CT_PositiveFixedAngle',
                'repeated' => false,
            ],
            [
                'name' => 'hueOff',
                'type' => 'CT_Angle',
                'repeated' => false,
            ],
            [
                'name' => 'hueMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'sat',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lum',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'red',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'green',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blue',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'gamma',
                'type' => 'CT_GammaTransform',
                'repeated' => false,
            ],
            [
                'name' => 'invGamma',
                'type' => 'CT_InverseGammaTransform',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_PresetLineDashProperties' => [
        'attributes' => [
            'val' => [
                'type' => 'enum',
                'values' => [
                    'solid',
                    'dot',
                    'dash',
                    'lgDash',
                    'dashDot',
                    'lgDashDot',
                    'lgDashDotDot',
                    'sysDash',
                    'sysDot',
                    'sysDashDot',
                    'sysDashDotDot',
                ],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_PresetShadowEffect' => [
        'attributes' => [
            'prst' => [
                'type' => 'enum',
                'values' => [
                    'shdw1',
                    'shdw2',
                    'shdw3',
                    'shdw4',
                    'shdw5',
                    'shdw6',
                    'shdw7',
                    'shdw8',
                    'shdw9',
                    'shdw10',
                    'shdw11',
                    'shdw12',
                    'shdw13',
                    'shdw14',
                    'shdw15',
                    'shdw16',
                    'shdw17',
                    'shdw18',
                    'shdw19',
                    'shdw20',
                ],
                'default' => null,
            ],
            'dist' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'dir' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
        ],
        'children' => [
            [
                'name' => 'scrgbClr',
                'type' => 'CT_ScRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'srgbClr',
                'type' => 'CT_SRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'hslClr',
                'type' => 'CT_HslColor',
                'repeated' => false,
            ],
            [
                'name' => 'sysClr',
                'type' => 'CT_SystemColor',
                'repeated' => false,
            ],
            [
                'name' => 'schemeClr',
                'type' => 'CT_SchemeColor',
                'repeated' => false,
            ],
            [
                'name' => 'prstClr',
                'type' => 'CT_PresetColor',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_ReflectionEffect' => [
        'attributes' => [
            'blurRad' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'stA' => [
                'type' => 'int',
                'values' => [],
                'default' => '100000',
            ],
            'stPos' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'endA' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'endPos' => [
                'type' => 'int',
                'values' => [],
                'default' => '100000',
            ],
            'dist' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'dir' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'fadeDir' => [
                'type' => 'int',
                'values' => [],
                'default' => '5400000',
            ],
            'sx' => [
                'type' => 'int',
                'values' => [],
                'default' => '100000',
            ],
            'sy' => [
                'type' => 'int',
                'values' => [],
                'default' => '100000',
            ],
            'kx' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'ky' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'algn' => [
                'type' => 'enum',
                'values' => [
                    'tl',
                    't',
                    'tr',
                    'l',
                    'ctr',
                    'r',
                    'bl',
                    'b',
                    'br',
                ],
                'default' => 'b',
            ],
            'rotWithShape' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'true',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_RelativeOffsetEffect' => [
        'attributes' => [
            'tx' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'ty' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_RelativeRect' => [
        'attributes' => [
            'l' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            't' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'r' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'b' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_SRgbColor' => [
        'attributes' => [
            'val' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'tint',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'shade',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'comp',
                'type' => 'CT_ComplementTransform',
                'repeated' => false,
            ],
            [
                'name' => 'inv',
                'type' => 'CT_InverseTransform',
                'repeated' => false,
            ],
            [
                'name' => 'gray',
                'type' => 'CT_GrayscaleTransform',
                'repeated' => false,
            ],
            [
                'name' => 'alpha',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaOff',
                'type' => 'CT_FixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'hue',
                'type' => 'CT_PositiveFixedAngle',
                'repeated' => false,
            ],
            [
                'name' => 'hueOff',
                'type' => 'CT_Angle',
                'repeated' => false,
            ],
            [
                'name' => 'hueMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'sat',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lum',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'red',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'green',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blue',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'gamma',
                'type' => 'CT_GammaTransform',
                'repeated' => false,
            ],
            [
                'name' => 'invGamma',
                'type' => 'CT_InverseGammaTransform',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_ScRgbColor' => [
        'attributes' => [
            'r' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'g' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'b' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'tint',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'shade',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'comp',
                'type' => 'CT_ComplementTransform',
                'repeated' => false,
            ],
            [
                'name' => 'inv',
                'type' => 'CT_InverseTransform',
                'repeated' => false,
            ],
            [
                'name' => 'gray',
                'type' => 'CT_GrayscaleTransform',
                'repeated' => false,
            ],
            [
                'name' => 'alpha',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaOff',
                'type' => 'CT_FixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'hue',
                'type' => 'CT_PositiveFixedAngle',
                'repeated' => false,
            ],
            [
                'name' => 'hueOff',
                'type' => 'CT_Angle',
                'repeated' => false,
            ],
            [
                'name' => 'hueMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'sat',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lum',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'red',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'green',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blue',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'gamma',
                'type' => 'CT_GammaTransform',
                'repeated' => false,
            ],
            [
                'name' => 'invGamma',
                'type' => 'CT_InverseGammaTransform',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_SchemeColor' => [
        'attributes' => [
            'val' => [
                'type' => 'enum',
                'values' => [
                    'bg1',
                    'tx1',
                    'bg2',
                    'tx2',
                    'accent1',
                    'accent2',
                    'accent3',
                    'accent4',
                    'accent5',
                    'accent6',
                    'hlink',
                    'folHlink',
                    'phClr',
                    'dk1',
                    'lt1',
                    'dk2',
                    'lt2',
                ],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'tint',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'shade',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'comp',
                'type' => 'CT_ComplementTransform',
                'repeated' => false,
            ],
            [
                'name' => 'inv',
                'type' => 'CT_InverseTransform',
                'repeated' => false,
            ],
            [
                'name' => 'gray',
                'type' => 'CT_GrayscaleTransform',
                'repeated' => false,
            ],
            [
                'name' => 'alpha',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaOff',
                'type' => 'CT_FixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'hue',
                'type' => 'CT_PositiveFixedAngle',
                'repeated' => false,
            ],
            [
                'name' => 'hueOff',
                'type' => 'CT_Angle',
                'repeated' => false,
            ],
            [
                'name' => 'hueMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'sat',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lum',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'red',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'green',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blue',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'gamma',
                'type' => 'CT_GammaTransform',
                'repeated' => false,
            ],
            [
                'name' => 'invGamma',
                'type' => 'CT_InverseGammaTransform',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_SoftEdgesEffect' => [
        'attributes' => [
            'rad' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_SolidColorFillProperties' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'scrgbClr',
                'type' => 'CT_ScRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'srgbClr',
                'type' => 'CT_SRgbColor',
                'repeated' => false,
            ],
            [
                'name' => 'hslClr',
                'type' => 'CT_HslColor',
                'repeated' => false,
            ],
            [
                'name' => 'sysClr',
                'type' => 'CT_SystemColor',
                'repeated' => false,
            ],
            [
                'name' => 'schemeClr',
                'type' => 'CT_SchemeColor',
                'repeated' => false,
            ],
            [
                'name' => 'prstClr',
                'type' => 'CT_PresetColor',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_StretchInfoProperties' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'fillRect',
                'type' => 'CT_RelativeRect',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_SystemColor' => [
        'attributes' => [
            'val' => [
                'type' => 'enum',
                'values' => [
                    'scrollBar',
                    'background',
                    'activeCaption',
                    'inactiveCaption',
                    'menu',
                    'window',
                    'windowFrame',
                    'menuText',
                    'windowText',
                    'captionText',
                    'activeBorder',
                    'inactiveBorder',
                    'appWorkspace',
                    'highlight',
                    'highlightText',
                    'btnFace',
                    'btnShadow',
                    'grayText',
                    'btnText',
                    'inactiveCaptionText',
                    'btnHighlight',
                    '3dDkShadow',
                    '3dLight',
                    'infoText',
                    'infoBk',
                    'hotLight',
                    'gradientActiveCaption',
                    'gradientInactiveCaption',
                    'menuHighlight',
                    'menuBar',
                ],
                'default' => null,
            ],
            'lastClr' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'tint',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'shade',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'comp',
                'type' => 'CT_ComplementTransform',
                'repeated' => false,
            ],
            [
                'name' => 'inv',
                'type' => 'CT_InverseTransform',
                'repeated' => false,
            ],
            [
                'name' => 'gray',
                'type' => 'CT_GrayscaleTransform',
                'repeated' => false,
            ],
            [
                'name' => 'alpha',
                'type' => 'CT_PositiveFixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaOff',
                'type' => 'CT_FixedPercentage',
                'repeated' => false,
            ],
            [
                'name' => 'alphaMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'hue',
                'type' => 'CT_PositiveFixedAngle',
                'repeated' => false,
            ],
            [
                'name' => 'hueOff',
                'type' => 'CT_Angle',
                'repeated' => false,
            ],
            [
                'name' => 'hueMod',
                'type' => 'CT_PositivePercentage',
                'repeated' => false,
            ],
            [
                'name' => 'sat',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'satMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lum',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'lumMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'red',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'redMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'green',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'greenMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blue',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueOff',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'blueMod',
                'type' => 'CT_Percentage',
                'repeated' => false,
            ],
            [
                'name' => 'gamma',
                'type' => 'CT_GammaTransform',
                'repeated' => false,
            ],
            [
                'name' => 'invGamma',
                'type' => 'CT_InverseGammaTransform',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_TextAutonumberBullet' => [
        'attributes' => [
            'type' => [
                'type' => 'enum',
                'values' => [
                    'alphaLcParenBoth',
                    'alphaUcParenBoth',
                    'alphaLcParenR',
                    'alphaUcParenR',
                    'alphaLcPeriod',
                    'alphaUcPeriod',
                    'arabicParenBoth',
                    'arabicParenR',
                    'arabicPeriod',
                    'arabicPlain',
                    'romanLcParenBoth',
                    'romanUcParenBoth',
                    'romanLcParenR',
                    'romanUcParenR',
                    'romanLcPeriod',
                    'romanUcPeriod',
                    'circleNumDbPlain',
                    'circleNumWdBlackPlain',
                    'circleNumWdWhitePlain',
                    'arabicDbPeriod',
                    'arabicDbPlain',
                    'ea1ChsPeriod',
                    'ea1ChsPlain',
                    'ea1ChtPeriod',
                    'ea1ChtPlain',
                    'ea1JpnChsDbPeriod',
                    'ea1JpnKorPlain',
                    'ea1JpnKorPeriod',
                    'arabic1Minus',
                    'arabic2Minus',
                    'hebrew2Minus',
                    'thaiAlphaPeriod',
                    'thaiAlphaParenR',
                    'thaiAlphaParenBoth',
                    'thaiNumPeriod',
                    'thaiNumParenR',
                    'thaiNumParenBoth',
                    'hindiAlphaPeriod',
                    'hindiNumPeriod',
                    'hindiNumParenR',
                    'hindiAlpha1Period',
                ],
                'default' => null,
            ],
            'startAt' => [
                'type' => 'int',
                'values' => [],
                'default' => '1',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextBlipBullet' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'blip',
                'type' => 'CT_Blip',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_TextBulletColorFollowText' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextBulletSizeFollowText' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextBulletSizePercent' => [
        'attributes' => [
            'val' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextBulletSizePoint' => [
        'attributes' => [
            'val' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextBulletTypefaceFollowText' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextCharBullet' => [
        'attributes' => [
            'char' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextCharacterProperties' => [
        'attributes' => [
            'kumimoji' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
            'lang' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
            'altLang' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
            'sz' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'b' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
            'i' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
            'u' => [
                'type' => 'enum',
                'values' => [
                    'none',
                    'words',
                    'sng',
                    'dbl',
                    'heavy',
                    'dotted',
                    'dottedHeavy',
                    'dash',
                    'dashHeavy',
                    'dashLong',
                    'dashLongHeavy',
                    'dotDash',
                    'dotDashHeavy',
                    'dotDotDash',
                    'dotDotDashHeavy',
                    'wavy',
                    'wavyHeavy',
                    'wavyDbl',
                ],
                'default' => null,
            ],
            'strike' => [
                'type' => 'enum',
                'values' => [
                    'noStrike',
                    'sngStrike',
                    'dblStrike',
                ],
                'default' => null,
            ],
            'kern' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'cap' => [
                'type' => 'enum',
                'values' => [
                    'none',
                    'small',
                    'all',
                ],
                'default' => null,
            ],
            'spc' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'normalizeH' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
            'baseline' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'noProof' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
            'dirty' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'true',
            ],
            'err' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'false',
            ],
            'smtClean' => [
                'type' => 'bool',
                'values' => [],
                'default' => 'true',
            ],
            'smtId' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'bmk' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'ln',
                'type' => 'CT_LineProperties',
                'repeated' => false,
            ],
            [
                'name' => 'noFill',
                'type' => 'CT_NoFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'solidFill',
                'type' => 'CT_SolidColorFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'gradFill',
                'type' => 'CT_GradientFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'blipFill',
                'type' => 'CT_BlipFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'pattFill',
                'type' => 'CT_PatternFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'grpFill',
                'type' => 'CT_GroupFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'effectLst',
                'type' => 'CT_EffectList',
                'repeated' => false,
            ],
            [
                'name' => 'effectDag',
                'type' => 'CT_EffectContainer',
                'repeated' => false,
            ],
            [
                'name' => 'highlight',
                'type' => 'CT_Color',
                'repeated' => false,
            ],
            [
                'name' => 'uLnTx',
                'type' => 'CT_TextUnderlineLineFollowText',
                'repeated' => false,
            ],
            [
                'name' => 'uLn',
                'type' => 'CT_LineProperties',
                'repeated' => false,
            ],
            [
                'name' => 'uFillTx',
                'type' => 'CT_TextUnderlineFillFollowText',
                'repeated' => false,
            ],
            [
                'name' => 'uFill',
                'type' => 'CT_TextUnderlineFillGroupWrapper',
                'repeated' => false,
            ],
            [
                'name' => 'latin',
                'type' => 'CT_TextFont',
                'repeated' => false,
            ],
            [
                'name' => 'ea',
                'type' => 'CT_TextFont',
                'repeated' => false,
            ],
            [
                'name' => 'cs',
                'type' => 'CT_TextFont',
                'repeated' => false,
            ],
            [
                'name' => 'sym',
                'type' => 'CT_TextFont',
                'repeated' => false,
            ],
            [
                'name' => 'hlinkClick',
                'type' => 'CT_Hyperlink',
                'repeated' => false,
            ],
            [
                'name' => 'hlinkMouseOver',
                'type' => 'CT_Hyperlink',
                'repeated' => false,
            ],
            [
                'name' => 'extLst',
                'type' => 'CT_OfficeArtExtensionList',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_TextFont' => [
        'attributes' => [
            'typeface' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
            'panose' => [
                'type' => 'string',
                'values' => [],
                'default' => null,
            ],
            'pitchFamily' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'charset' => [
                'type' => 'int',
                'values' => [],
                'default' => '1',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextNoBullet' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextParagraphProperties' => [
        'attributes' => [
            'marL' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'marR' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'lvl' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'indent' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'algn' => [
                'type' => 'enum',
                'values' => [
                    'l',
                    'ctr',
                    'r',
                    'just',
                    'justLow',
                    'dist',
                    'thaiDist',
                ],
                'default' => null,
            ],
            'defTabSz' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'rtl' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
            'eaLnBrk' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
            'fontAlgn' => [
                'type' => 'enum',
                'values' => [
                    'auto',
                    't',
                    'ctr',
                    'base',
                    'b',
                ],
                'default' => null,
            ],
            'latinLnBrk' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
            'hangingPunct' => [
                'type' => 'bool',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [
            [
                'name' => 'lnSpc',
                'type' => 'CT_TextSpacing',
                'repeated' => false,
            ],
            [
                'name' => 'spcBef',
                'type' => 'CT_TextSpacing',
                'repeated' => false,
            ],
            [
                'name' => 'spcAft',
                'type' => 'CT_TextSpacing',
                'repeated' => false,
            ],
            [
                'name' => 'buClrTx',
                'type' => 'CT_TextBulletColorFollowText',
                'repeated' => false,
            ],
            [
                'name' => 'buClr',
                'type' => 'CT_Color',
                'repeated' => false,
            ],
            [
                'name' => 'buSzTx',
                'type' => 'CT_TextBulletSizeFollowText',
                'repeated' => false,
            ],
            [
                'name' => 'buSzPct',
                'type' => 'CT_TextBulletSizePercent',
                'repeated' => false,
            ],
            [
                'name' => 'buSzPts',
                'type' => 'CT_TextBulletSizePoint',
                'repeated' => false,
            ],
            [
                'name' => 'buFontTx',
                'type' => 'CT_TextBulletTypefaceFollowText',
                'repeated' => false,
            ],
            [
                'name' => 'buFont',
                'type' => 'CT_TextFont',
                'repeated' => false,
            ],
            [
                'name' => 'buNone',
                'type' => 'CT_TextNoBullet',
                'repeated' => false,
            ],
            [
                'name' => 'buAutoNum',
                'type' => 'CT_TextAutonumberBullet',
                'repeated' => false,
            ],
            [
                'name' => 'buChar',
                'type' => 'CT_TextCharBullet',
                'repeated' => false,
            ],
            [
                'name' => 'buBlip',
                'type' => 'CT_TextBlipBullet',
                'repeated' => false,
            ],
            [
                'name' => 'tabLst',
                'type' => 'CT_TextTabStopList',
                'repeated' => false,
            ],
            [
                'name' => 'defRPr',
                'type' => 'CT_TextCharacterProperties',
                'repeated' => false,
            ],
            [
                'name' => 'extLst',
                'type' => 'CT_OfficeArtExtensionList',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_TextSpacing' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'spcPct',
                'type' => 'CT_TextSpacingPercent',
                'repeated' => false,
            ],
            [
                'name' => 'spcPts',
                'type' => 'CT_TextSpacingPoint',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_TextSpacingPercent' => [
        'attributes' => [
            'val' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextSpacingPoint' => [
        'attributes' => [
            'val' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextTabStop' => [
        'attributes' => [
            'pos' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'algn' => [
                'type' => 'enum',
                'values' => [
                    'l',
                    'ctr',
                    'r',
                    'dec',
                ],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextTabStopList' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'tab',
                'type' => 'CT_TextTabStop',
                'repeated' => true,
            ],
        ],
        'opaque' => false,
    ],
    'CT_TextUnderlineFillFollowText' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TextUnderlineFillGroupWrapper' => [
        'attributes' => [],
        'children' => [
            [
                'name' => 'noFill',
                'type' => 'CT_NoFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'solidFill',
                'type' => 'CT_SolidColorFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'gradFill',
                'type' => 'CT_GradientFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'blipFill',
                'type' => 'CT_BlipFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'pattFill',
                'type' => 'CT_PatternFillProperties',
                'repeated' => false,
            ],
            [
                'name' => 'grpFill',
                'type' => 'CT_GroupFillProperties',
                'repeated' => false,
            ],
        ],
        'opaque' => false,
    ],
    'CT_TextUnderlineLineFollowText' => [
        'attributes' => [],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TileInfoProperties' => [
        'attributes' => [
            'tx' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'ty' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'sx' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'sy' => [
                'type' => 'int',
                'values' => [],
                'default' => null,
            ],
            'flip' => [
                'type' => 'enum',
                'values' => [
                    'none',
                    'x',
                    'y',
                    'xy',
                ],
                'default' => null,
            ],
            'algn' => [
                'type' => 'enum',
                'values' => [
                    'tl',
                    't',
                    'tr',
                    'l',
                    'ctr',
                    'r',
                    'bl',
                    'b',
                    'br',
                ],
                'default' => null,
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TintEffect' => [
        'attributes' => [
            'hue' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'amt' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
    'CT_TransformEffect' => [
        'attributes' => [
            'sx' => [
                'type' => 'int',
                'values' => [],
                'default' => '100000',
            ],
            'sy' => [
                'type' => 'int',
                'values' => [],
                'default' => '100000',
            ],
            'kx' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'ky' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'tx' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
            'ty' => [
                'type' => 'int',
                'values' => [],
                'default' => '0',
            ],
        ],
        'children' => [],
        'opaque' => false,
    ],
];

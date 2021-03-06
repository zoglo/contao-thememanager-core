<?php
/*
 * This file is part of Contao ThemeManager Core.
 *
 * (c) https://www.oveleon.de/
 */

namespace ContaoThemeManager\Core;

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\DataContainer;

class ThemeManager
{
    /**
     * Extends the headline field for modules and content elements.
     */
    public function extendHeadlineField($dc)
    {
        $objPalette = PaletteManipulator::create()
            ->addField(array('headlineStyle', 'headline2', 'headline2Style'), 'headline');

        foreach ($GLOBALS['TL_DCA'][$dc->table]['palettes'] as $name => $palette)
        {
            if($name === '__selector__')
            {
                continue;
            }

            if (!is_array($palette) && strpos($palette, 'headlineStyle') === false && strpos($palette, 'headline') !== false)
            {
                $objPalette->applyToPalette($name, $dc->table);
            }
        }
    }

    /**
     * Extends the headline field for modules and content elements.
     *
     * @param $context
     */
    public function addHeadlineFieldsToTemplate(&$context)
    {
        $arrHeadline2 = \StringUtil::deserialize($context->headline2);
        $context->headline2 = \is_array($arrHeadline2) ? $arrHeadline2['value'] : $arrHeadline2;
        $context->hl2 = \is_array($arrHeadline2) ? $arrHeadline2['unit'] : 'h1';
    }

    /**
     * Extends the headline palette for modules and content elements.
     *
     * @param DataContainer $dc
     *
     * @deprecated Deprecated since ThemeManager 1.2.4, to be removed in ThemeManager 2.0.
     */
    public function extendHeadlinePalette($dc)
    {
        return;
    }
}

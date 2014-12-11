<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\Bundle\TinymceBundle\AssetProvider;

use Phlexible\Bundle\GuiBundle\AssetProvider\AssetProviderInterface;

/**
 * Tinymce asset provider
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class TinymceAssetProvider implements AssetProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getUxScriptsCollection()
    {
        return array(

        );
    }

    /**
     * {@inheritDoc}
     */
    public function getUxCssCollection()
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getScriptsCollection()
    {
        return array(
            '@PhlexibleTinymceBundle/Resources/scripts-ux/Ext.ux.TinyMCE.js',

            '@PhlexibleTinymceBundle/Resources/scripts/Definitions.js',

            '@PhlexibleTinymceBundle/Resources/scripts/configuration/FieldConfigurationTinymce.js',

            '@PhlexibleTinymceBundle/Resources/scripts/field/HtmlEditor.js',
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getCssCollection()
    {
        return null;
    }
}

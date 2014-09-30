<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\Bundle\TinymceBundle\AssetProvider;

use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use Phlexible\Bundle\GuiBundle\AssetProvider\AssetProviderInterface;
use Symfony\Component\HttpKernel\Config\FileLocator;

/**
 * Tinymce asset provider
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class TinymceAssetProvider implements AssetProviderInterface
{
    /**
     * @var FileLocator
     */
    private $locator;

    /**
     * @param FileLocator $locator
     */
    public function __construct(FileLocator $locator)
    {
        $this->locator = $locator;
    }

    /**
     * {@inheritDoc}
     */
    public function getUxScriptsCollection()
    {
        return null;
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
        $collection = new AssetCollection(array(
            new FileAsset($this->locator->locate('@PhlexibleTinymceBundle/Resources/scripts/ux/Ext.ux.TinyMCE.js')),

            new FileAsset($this->locator->locate('@PhlexibleTinymceBundle/Resources/scripts/Definitions.js')),

            new FileAsset($this->locator->locate('@PhlexibleTinymceBundle/Resources/scripts/configuration/FieldConfigurationTinymce.js')),

            new FileAsset($this->locator->locate('@PhlexibleTinymceBundle/Resources/scripts/field/HtmlEditor.js')),
        ));

        return $collection;
    }

    /**
     * {@inheritDoc}
     */
    public function getCssCollection()
    {
        return null;
    }
}

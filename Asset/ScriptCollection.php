<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\TinymceComponent\Asset;

use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;

/**
 * Script collection
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class ScriptCollection extends AssetCollection
{
    /**
     * @param array $scriptDir
     */
    public function __construct($scriptDir)
    {
        $assets = array(
            new FileAsset($scriptDir . 'ux/Ext.ux.TinyMCE.js'),

            new FileAsset($scriptDir . 'Definitions.js'),

            new FileAsset($scriptDir . 'configuration/FieldConfigurationTinymce.js'),

            new FileAsset($scriptDir . 'fields/HtmlEditor.js'),
        );

        parent::__construct($assets);
    }
}

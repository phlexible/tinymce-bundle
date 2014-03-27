<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\TinymceComponent\Field;

use Phlexible\ElementtypesComponent\Field\TextareaField;

/**
 * Tiny MCE field
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class EditorField extends TextareaField
{
    const TYPE = 'editor';
    public $icon = 'm-fields-field_editor-icon';
}
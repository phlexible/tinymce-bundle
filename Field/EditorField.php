<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\Bundle\TinymceBundle\Field;

use Phlexible\Bundle\ElementtypeBundle\Field\TextareaField;

/**
 * Tiny MCE field
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class EditorField extends TextareaField
{
    /**
     * {@inheritdoc}
     */
    public function getIcon()
    {
        return 'p-elementtype-field_editor-icon';
    }
}
<?php

/*
 * This file is part of the phlexible tinymce package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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

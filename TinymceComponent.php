<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\TinymceComponent;

use Phlexible\Component\Component;

/**
 * TinyMce Component
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class TinymceComponent extends Component
{
    public function __construct()
    {
        $this
            ->setVersion('0.7.0')
            ->setId('tinymce')
            ->setPackage('phlexible');
    }
}

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
 * TinyMce bundle
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class TinymceBundle extends Component
{
    public function __construct()
    {
        $this
            ->setVersion('0.7.0')
            ->setId('tinymce')
            ->setPackage('phlexible');
    }
}

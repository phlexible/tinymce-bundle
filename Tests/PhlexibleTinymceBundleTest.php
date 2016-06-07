<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\Bundle\TinymceBundle\Tests;

use Phlexible\Bundle\TinymceBundle\PhlexibleTinymceBundle;

/**
 * Tinymce bundle test
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class PhlexibleTinymceBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testBundle()
    {
        $bundle = new PhlexibleTinymceBundle();

        $this->assertSame('PhlexibleTinymceBundle', $bundle->getName());
    }
}

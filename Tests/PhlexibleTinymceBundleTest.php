<?php

/*
 * This file is part of the phlexible tinymce package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Bundle\TinymceBundle\Tests;

use Phlexible\Bundle\TinymceBundle\PhlexibleTinymceBundle;
use PHPUnit\Framework\TestCase;

/**
 * Tinymce bundle test.
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class PhlexibleTinymceBundleTest extends TestCase
{
    public function testBundle()
    {
        $bundle = new PhlexibleTinymceBundle();

        $this->assertSame('PhlexibleTinymceBundle', $bundle->getName());
    }
}

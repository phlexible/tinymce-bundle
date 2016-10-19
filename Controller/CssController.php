<?php

/*
 * This file is part of the phlexible tinymce package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Bundle\TinymceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * CSS controller.
 *
 * @author Stephan Wentz <sw@brainbits.net>
 * @Route("/tinymce/css")
 */
class CssController extends Controller
{
    /**
     * New CSS.
     *
     * @return Response
     * @Route("/new", name="tinymce_css_new")
     */
    public function newAction()
    {
        $content = 'body {background: none #FBB !important;}';

        return new Response($content, 200, array('Content-type' => 'text/css'));
    }

    /**
     * Change CSS.
     *
     * @return Response
     * @Route("/change", name="tinymce_css_change")
     */
    public function changeAction()
    {
        $content = 'body {background: none #FBB !important;}';

        return new Response($content, 200, array('Content-type' => 'text/css'));
    }
}

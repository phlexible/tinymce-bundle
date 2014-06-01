<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\TinymceComponent\Controller;

use Phlexible\CoreComponent\Controller\Action\Action;
use Phlexible\CoreComponent\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * CSS controller
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class CssController extends Controller
{
    /**
     * New CSS
     *
     * @return Response
     */
    public function newAction()
    {
        $content = 'body {background: none #FBB !important;}';

        return new Response($content, 200, array('Content-type' => 'text/css'));
    }

    /**
     * Change CSS
     *
     * @return Response
     */
    public function changeAction()
    {
        $content = 'body {background: none #FBB !important;}';

        return new Response($content, 200, array('Content-type' => 'text/css'));
    }
}

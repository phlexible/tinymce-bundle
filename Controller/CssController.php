<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

use Phlexible\CoreComponent\Controller\Action\Action;

/**
 * CSS controller
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class CssController extends Action
{
    public function newAction()
    {
        $this->_response
            ->setHeader('Content-type', 'text/css')
            ->setBody('body {background: none #FBB !important;}');
    }

    public function changeAction()
    {
        $this->_response
            ->setHeader('Content-type', 'text/css')
            ->setBody('body {background: none #FBB !important;}');
    }
}

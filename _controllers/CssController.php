<?php
/**
 * MAKEweb
 *
 * PHP Version 5
 *
 * @category    MAKEweb
 * @package     Makeweb_TinyMce
 * @copyright   2007 brainbits GmbH (http://www.brainbits.net)
 * @version     SVN: $Id: Generator.php 2312 2007-01-25 18:46:27Z swentz $
 */

/**
 * Include Controller
 *
 * @category    MAKEweb
 * @package     Makeweb_TinyMce
 * @author      Stephan Wentz <sw@brainbits.net>
 * @copyright   2007 brainbits GmbH (http://www.brainbits.net)
 */
final class TinyMce_CssController extends MWF_Controller_Action
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

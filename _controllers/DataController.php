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
 * Data Controller
 *
 * @category    MAKEweb
 * @package     Makeweb_TinyMce
 * @author      Stephan Wentz <sw@brainbits.net>
 * @copyright   2007 brainbits GmbH (http://www.brainbits.net)
 */
final class TinyMce_DataController extends MWF_Controller_Action
{
    public function linkAction()
    {
        $tid = $this->_getParam('tid');
        $language = $this->_getParam('language', 'en');

        $container = $this->getContainer();
        $treeManager = $container->elementsTreeManager;
        $elementsVersionManager = $container->elementsVersionManager;

        $node = $treeManager->getNodeByNodeId($tid);
        $elementVersion = $elementsVersionManager->getLatest($node->getEid());
        $title = $elementVersion->getBackendTitle($language);
        $title .= ' [' . $tid . ']';

        $data = MWF_Ext_Result::encode(true, $tid, 'Name loaded', array('title' => $title));

        $this->_response->setAjaxPayload($data);
    }
}

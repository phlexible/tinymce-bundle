<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

/**
 * Data controller
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
final class DataController extends MWF_Controller_Action
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

        $this->_response->setResult(true, $tid, 'Name loaded', array('title' => $title));
    }
}

<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */
namespace Phlexible\TinymceComponent\Controller;

use Phlexible\CoreComponent\Controller\Action\Action;

/**
 * Data controller
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
final class DataController extends Action
{
    /**
     * Link action
     */
    public function linkAction()
    {
        $tid = $this->getParam('tid');
        $language = $this->getParam('language', 'en');

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

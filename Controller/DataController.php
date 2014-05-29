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
     * Link
     */
    public function linkAction()
    {
        $tid = $this->getParam('tid');
        $language = $this->getParam('language', 'en');

        $container = $this->getContainer();
        $treeManager = $container->get('tree.manager');
        $elementService = $container->get('elements.service');

        $node = $treeManager->getByNodeId($tid)->get($tid);
        $element = $elementService->findElement($node->getTypeId());
        $elementVersion = $elementService->findLatestElementVersion($element);
        $title = $elementVersion->getBackendTitle($language) . ' [' . $tid . ']';

        $this->_response->setResult(true, $tid, 'Name loaded', array('title' => $title));
    }
}

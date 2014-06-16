<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */
namespace Phlexible\TinymceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Phlexible\GuiBundle\Response\ResultResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Data controller
 *
 * @author Stephan Wentz <sw@brainbits.net>
 * @Route("/tinymce/data")
 */
class DataController extends Controller
{
    /**
     * Link
     *
     * @param Request $request
     *
     * @return ResultResponse
     * @Route("/link", name="tiymce_data_link")
     */
    public function linkAction(Request $request)
    {
        $tid = $request->request->get('tid');
        $language = $request->request->get('language', 'en');

        $treeManager = $this->get('tree.manager');
        $elementService = $this->get('elements.service');

        $node = $treeManager->getByNodeId($tid)->get($tid);
        $element = $elementService->findElement($node->getTypeId());
        $elementVersion = $elementService->findLatestElementVersion($element);
        $title = $elementVersion->getBackendTitle($language) . ' [' . $tid . ']';

        return new ResultResponse(true, 'Name loaded', array('title' => $title));
    }
}

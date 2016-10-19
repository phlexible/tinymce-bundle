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

use Phlexible\Bundle\GuiBundle\Response\ResultResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Data controller.
 *
 * @author Stephan Wentz <sw@brainbits.net>
 * @Route("/tinymce/data")
 */
class DataController extends Controller
{
    /**
     * Link.
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

        $treeManager = $this->get('phlexible_tree.tree_manager');
        $elementService = $this->get('phlexible_element.element_service');

        $node = $treeManager->getByNodeId($tid)->get($tid);
        $element = $elementService->findElement($node->getTypeId());
        $elementVersion = $elementService->findLatestElementVersion($element);
        $title = $elementVersion->getBackendTitle($language).' ['.$tid.']';

        return new ResultResponse(true, 'Name loaded', array('title' => $title));
    }
}

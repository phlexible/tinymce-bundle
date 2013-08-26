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
final class TinyMce_IncludeController extends MWF_Controller_Action
{
    public function indexAction()
    {
        $basedir = dirname(dirname(__FILE__)) . '/_tinymce/';
        $filename = $this->_getParam(1);

        $this->_processResponse($this->_request, $this->_response, $basedir.$filename);
    }

    protected function _processResponse($request, $response, $filename)
    {
        if (!file_exists($filename))
        {
            $response->setHttpResponseCode(404);
            return;
        }

        $lastModified = filemtime($filename);
        $fileSize     = filesize($filename);

        $mimeType = 'application/octet-stream';
        $include  = false;

        switch(substr($filename, strrpos($filename, '.')))
        {
            case '.css':
                $mimeType = 'text/css';
                break;

            case '.js':
                $mimeType = 'text/javascript';
                break;

            case '.png':
                $mimeType = 'image/png';
                break;

            case '.gif':
                $mimeType = 'image/gif';
                break;

            case '.jpg':
                $mimeType = 'image/jpg';
                break;

            case '.swf':
                $mimeType = 'application/x-shockwave-flash';
                break;

            default:
                $mimeType = Brainbits_Mime::getMimetype($filename, true);
                break;
        }

        $this->_response
            ->setFile($filename)
            ->setContentType($mimeType)
            ->setContentDisposition(MWF_Controller_Response_File::CONTENT_DISPOSITION_ATTACHMENT, basename($filename))
            ->setContentLength($fileSize);
    }
}

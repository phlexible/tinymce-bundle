<?php
/**
 * MAKEweb
 *
 * PHP Version 5
 *
 * @category    Makeweb
 * @package     Makeweb_TinyMce
 * @copyright   2010 brainbits GmbH (http://www.brainbits.net)
 */

/**
 * TinyMce
 *
 * @category    Makeweb
 * @package     Makeweb_TinyMce
 * @author      Stephan Wentz <sw@brainbits.net>
 * @copyright   2010 brainbits GmbH (http://www.brainbits.net)
 */
class Makeweb_TinyMce_Component extends MWF_Component_Abstract
{
    /**
     * Constructor
     * Initialses the Component values
     */
    public function __construct()
    {
        $this->setVersion('0.7.0');
        $this->setId('tinymce');
        $this->setFile(__FILE__);
        $this->setPackage('makeweb');
        $this->setOrder('after fields');
    }

    public function initContainer(MWF_Container_ContainerBuilder $container, array $configs)
    {
        $processor = new Symfony\Component\Config\Definition\Processor();
        $configuration = new Makeweb_TinyMce_Container_Configuration;
        $processedConfiguration = $processor->processConfiguration(
            $configuration,
            $configs
        );

        if (!empty($processedConfiguration['settings'])) {
            $container->setParam(':tinymce.settings', $processedConfiguration['settings']);

            if (!empty($processedConfiguration['setup'])) {
                $container->setParam(':tinymce.setup', $processedConfiguration['setup']);
            }
        }

        $container->addComponents(array(
            // listeners
            'tinymceListenerViewDefault' => array(
                'tag' => array(
                    'name' => 'event.listener',
                    'event' => MWF_Core_Frame_Event::VIEW_FRAME,
                    'callback' => array('Makeweb_TinyMce_Callback', 'callViewDefault'),
                ),
            ),
        ));
    }

    public function getFields()
    {
        $fields = array(
            'editor' => 'Makeweb_TinyMce_Field_Editor'
        );

        return $fields;
    }

    public function getRoutes()
    {
        $routes = array(
            'tinymce_include' => new MWF_Controller_Router_Route_Regex(
                'tinymce/(.*)',
                array('module' => 'tinymce', 'controller' => 'include', 'action' => 'index')
            ),
            'tiymce_contentcss' => new MWF_Controller_Router_Route(
                'tinymce/content_css/:action',
                array('module' => 'tinymce', 'controller' => 'css', 'action' => 'index')
            ),
            'tiymce_data' => new MWF_Controller_Router_Route(
                'tinymce/data/:action/*',
                array('module' => 'tinymce', 'controller' => 'data', 'action' => 'index')
            ),
        );

        return $routes;
    }

    public function getScripts()
    {
        $path = $this->getPath().'/_scripts/';

        return array(
            $path.'Ext.ux.TinyMCE.js',
            $path.'fields/HtmlEditor.js',
        );
    }

}

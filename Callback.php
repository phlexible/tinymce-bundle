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
class Makeweb_TinyMce_Callback
{
    public static function callViewDefault(MWF_Core_Frame_Event_ViewFrame $event, array $params = array())
    {
        $view = $event->getView();

        $container = $params['container'];
        $setup = '';
        if ($container->getParam(':tinymce.settings'))
        {
            $settings = $container->getParam(':tinymce.settings');

            if ($container->getParam(':tinymce.setup'))
            {
                $setup = $container->getParam(':tinymce.setup');
            }
        }
        else
        {
            $settings = array(
                'theme' => "advanced",
                'plugins' => "safari,advlink,searchreplace,contextmenu,paste,noneditable,visualchars,xhtmlxtras",
                'theme_advanced_buttons1' => "code,|,cut,copy,paste,pastetext,pasteword,|,removeformat,cleanup,|,search,replace,|,undo,redo",
                'theme_advanced_buttons2' => "bold,italic,|,sub,sup,|,blockquote,cite,abbr,acronym,|,visualchars,|,charmap,|,bullist,numlist,|,link,unlink",
                'theme_advanced_buttons3' => "",
                'theme_advanced_buttons4' => "",
                'theme_advanced_toolbar_location' => "top",
                'theme_advanced_toolbar_align' => "left",
                'theme_advanced_statusbar_location' => "bottom",
                'theme_advanced_resizing' => false,
                'extended_valid_elements' => "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
                'template_external_list_url' => "example_template_list.js"
            );
        }

        $script = 'var tinymceSettings = ' . Zend_Json::encode($settings). ';' . PHP_EOL;
        if ($setup) {
            $script .= 'tinymceSettings.setup = ' . $setup . ';' . PHP_EOL;
        }

        $view
            ->addScript($event->getRequest()->getBasePath() . '/components/tinymce/scripts/tinymce/tiny_mce' . (MWF_Env::isDebug() ? '_src' : '') . '.js')
            ->addInlineScript($script);
    }
}

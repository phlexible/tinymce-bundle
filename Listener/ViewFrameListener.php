<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\TinymceComponent\Listener;

use Phlexible\FrameComponent\Event\ViewEvent;

/**
 * View frame listener
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class ViewFrameListener
{
    /**
     * @var bool
     */
    private $debug;

    /**
     * @var string
     */
    private $tinymceSettings;

    /**
     * @var string
     */
    private $tinymceSetup;

    /**
     * @param bool   $debug
     * @param string $tinymceSettings
     * @param string $tinymceSetup
     */
    public function __construct($debug, $tinymceSettings, $tinymceSetup)
    {
        $this->debug = $debug;
        $this->tinymceSettings = $tinymceSettings;
        $this->tinymceSetup = $tinymceSetup;
    }

    /**
     * @param ViewEvent $event
     */
    public function onViewFrame(ViewEvent $event)
    {
        $view = $event->getView();

        $setup = '';
        if ($this->tinymceSettings) {
            $settings = $this->tinymceSettings;

            if ($this->tinymceSetup) {
                $setup = $this->tinymceSetup;
            }
        } else {
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

        $script = 'var tinymceSettings = ' . json_encode($settings). ';' . PHP_EOL;
        if ($setup) {
            $script .= 'tinymceSettings.setup = ' . $setup . ';' . PHP_EOL;
        }

        $view
            ->addScript('/bundles/tinymce/scripts/tinymce/tiny_mce' . ($this->debug ? '_src' : '') . '.js')
            ->addInlineScript($script);
    }
}

<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\TinymceComponent\Container;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * TinyMCe Configuration
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tinymce');

        /*
        $config['tinymce']['settings'] = array(
            'content_css' => "/styles/editor/custom.css",
            'theme' => "advanced",
            'plugins' => "safari,advlink,searchreplace,contextmenu,paste,noneditable,visualchars,xhtmlxtras,fullscreen",
            'theme_advanced_buttons1' => "code,fullscreen,|,pastetext,removeformat,|,bold,underline,italic,|,sub,sup,|abbr,acronym,|,link,unlink,|,bullist,numlist",
            'theme_advanced_buttons2' => "",
            'theme_advanced_buttons3' => "",
            'theme_advanced_buttons4' => "",
            'theme_advanced_toolbar_location' => "top",
            'theme_advanced_toolbar_align' => "left",
            'theme_advanced_statusbar_location' => "bottom",
            'theme_advanced_resizing' => false,
            'extended_valid_elements' => "a[name|href|target|title|onclick|class]",
            'template_external_list_url' => "example_template_list.js",
            'advlink_styles' => 'External Link=icons-external;Internal Link=icons-internal;E-Mail Link=icons-mail;Download Link=icons-download',
            'paste_auto_cleanup_on_paste' => true,
            'paste_text_sticky' => true,
            'fullscreen_new_window' => true,
            'fullscreen_settings' => array(
                'theme_advanced_path_location' => "top"
            )
        );
        */

        $rootNode
            ->children()
                ->scalarNode('settings')->end()
                ->scalarNode('setup')->end()
            ->end();

        return $treeBuilder;
    }
}
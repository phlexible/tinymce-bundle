<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\Bundle\TinymceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * TinyMCe Configuration
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('phlexible_tinymce');

        $rootNode
            ->children()
                ->arrayNode('settings')
                    ->info('TinyMCE settings.')
                    ->prototype('variable')->end()
                ->end()
                ->scalarNode('setup')->info('TinyMCE setup.')->end()
            ->end();

        return $treeBuilder;
    }
}

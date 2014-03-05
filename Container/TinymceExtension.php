<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\TinymceComponent\Container;

use Phlexible\Container\ContainerBuilder;
use Phlexible\Container\Extension\Extension;
use Phlexible\Container\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * Tiny MCE extension
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class TinymceExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $configs)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../_config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($container);
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameters(
            array(
                'tinymce.asset.script_path' => __DIR__ . '/../_scripts',
                'tinymce.asset.css_path'    => __DIR__ . '/../_styles',
                'tinymce.settings' => null,
                'tinymce.setup' => null,
            )
        );

        if (!empty($config['settings'])) {
            $container->setParameter('tinymce.settings', $config['settings']);

            if (!empty($config['setup'])) {
                $container->setParameter('tinymce.setup', $config['setup']);
            }
        }
    }
}

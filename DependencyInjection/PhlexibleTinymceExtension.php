<?php
/**
 * phlexible
 *
 * @copyright 2007-2013 brainbits GmbH (http://www.brainbits.net)
 * @license   proprietary
 */

namespace Phlexible\TinymceBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Tiny MCE extension
 *
 * @author Stephan Wentz <sw@brainbits.net>
 */
class PhlexibleTinymceExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($config, $container);
        $config = $this->processConfiguration($configuration, $config);

        $container->setParameter('tinymce.settings', null);
        $container->setParameter('tinymce.setup', null);

        if (!empty($config['settings'])) {
            $container->setParameter('tinymce.settings', $config['settings']);

            if (!empty($config['setup'])) {
                $container->setParameter('tinymce.setup', $config['setup']);
            }
        }
    }
}

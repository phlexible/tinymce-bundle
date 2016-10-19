<?php

/*
 * This file is part of the phlexible tinymce package.
 *
 * (c) Stephan Wentz <sw@brainbits.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Phlexible\Bundle\TinymceBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Tiny MCE extension.
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

        $container->setParameter('phlexible_tinymce.settings', null);
        $container->setParameter('phlexible_tinymce.setup', null);

        if (!empty($config['settings'])) {
            $container->setParameter('phlexible_tinymce.settings', $config['settings']);

            if (!empty($config['setup'])) {
                $container->setParameter('phlexible_tinymce.setup', $config['setup']);
            }
        }
    }
}

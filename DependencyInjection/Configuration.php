<?php

namespace tkuska\RibbonBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tkuska_ribbon');

        $rootNode
            ->children()
                ->scalarNode('listener_class')->defaultValue('tkuska\RibbonBundle\Ribbon\Listener')->end()
                ->scalarNode('extension_class')->defaultValue('tkuska\RibbonBundle\Twig\Extension\RibbonExtension')->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        return $treeBuilder;
    }
}

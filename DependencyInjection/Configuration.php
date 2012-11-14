<?php

namespace CodeMeme\IronMqBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('code_meme_iron_mq')
            ->children()
                ->scalarNode('token')->cannotBeEmpty()->end()
                ->scalarNode('project_id')->cannotBeEmpty()->end()

                ->arrayNode('api')
                    ->children()
                        ->scalarNode('protocol')->cannotBeEmpty()->end()
                        ->scalarNode('host')->cannotBeEmpty()->end()
                        ->scalarNode('port')->cannotBeEmpty()->end()
                        ->scalarNode('api_version')->cannotBeEmpty()->end()
                    ->end()
                ->end()

                ->arrayNode('options')
                    ->children()
                        ->scalarNode('max_retries')->cannotBeEmpty()->end()
                        ->booleanNode('debug_enabled')->end()
                        ->booleanNode('ssl_verifypeer')->end()
                        ->scalarNode('connection_timeout')->cannotBeEmpty()->end()
                    ->end()
                ->end()

            ->end();

        return $treeBuilder;
    }
}

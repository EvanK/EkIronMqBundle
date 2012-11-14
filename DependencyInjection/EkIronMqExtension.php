<?php

namespace Ek\IronMqBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class EkIronMqExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if (isset($config['token'], $config['project_id'])) {
            // Required constructor args
            $options = array(
                'token'      => $config['token'],
                'project_id' => $config['project_id'],
            );

            // Copy optional constructor args from 'api' node
            if (isset($config['api'])) {
                $options = array_merge($options, $config['api']);
            }

            $definition = new Definition('IronMQ', array($options));

            // Set public properties from 'options' node
            if (isset($config['options'])) {
                foreach ($config['options'] as $key => $value) {
                    $definition->setProperty($key, $value);
                }
            }

            $container->setDefinition('ek_iron_mq.messagequeue', $definition);
        }
    }
}

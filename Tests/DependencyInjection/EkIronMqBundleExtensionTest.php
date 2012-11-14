<?php

namespace Ek\IronMqBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Ek\IronMqBundle\DependencyInjection\EkIronMqExtension;

class EkIronMqExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testExtensionEnabled()
    {
        $container = $this->getContainer('enabled.yml');
        $this->assertTrue($container->has('ek_iron_mq.messagequeue'));

        $definition = $container->getDefinition('ek_iron_mq.messagequeue');
        $this->assertEquals('IronMQ', $definition->getClass());
        $this->assertEquals(array(array('token' => 'abc123','project_id' => 'xyz987')), $definition->getArguments());
    }

    public function testExtensionDisabled()
    {
        $container = $this->getContainer('disabled.yml');
        $this->assertFalse($container->has('ek_iron_mq.messagequeue'));
    }

    private function getContainer($file, $debug = false)
    {
        $container = new ContainerBuilder(new ParameterBag(array('kernel.debug' => $debug)));
        $container->registerExtension(new EkIronMqExtension());

        $locator = new FileLocator(__DIR__.'/Fixtures');
        $loader = new YamlFileLoader($container, $locator);
        $loader->load($file);

        $container->getCompilerPassConfig()->setOptimizationPasses(array());
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->compile();

        return $container;
    }
}

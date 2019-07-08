<?php

namespace Borsaco\TCPDFBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Definition,
    Symfony\Component\DependencyInjection\Loader\XmlFileLoader,
    Symfony\Component\Config\Definition\Processor,
    Symfony\Component\Config\FileLocator;

use TCPDFBundle\DependencyInjection\Configuration;

class TCPDFExtension extends Extension
{
    /**
     * Load our configuration
     *
     * @param array $configs
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $container->setParameter('tcpdf.file', $config['file']);
        $container->setParameter('tcpdf.class', $config['class']);
        $container->setParameter('tcpdf.tcpdf', $config['tcpdf']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
}

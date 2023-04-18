<?php

declare(strict_types=1);

namespace NoResponseMate\SuiteTagIsolationExtension\ServiceContainer;

use Behat\Testwork\Cli\ServiceContainer\CliExtension;
use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Behat\Testwork\Suite\ServiceContainer\SuiteExtension;
use NoResponseMate\SuiteTagIsolationExtension\Suite\Cli\SuiteController;
use NoResponseMate\SuiteTagIsolationExtension\Suite\Cli\TagIsolatingSuiteController;
use NoResponseMate\SuiteTagIsolationExtension\Suite\MutableSuiteRegistry;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

final class SuiteTagIsolationExtension implements Extension
{
    public function process(ContainerBuilder $container): void
    {
    }

    public function getConfigKey(): string
    {
        return 'nrm_suite_tag_isolation';
    }

    public function initialize(ExtensionManager $extensionManager): void
    {
    }

    public function configure(ArrayNodeDefinition $builder): void
    {
    }

    public function load(ContainerBuilder $container, array $config): void
    {
        $this->overwriteSuiteRegistry($container);
        $this->overwriteSuiteController($container);

        $controllerDefinition = new Definition(TagIsolatingSuiteController::class, [
            new Reference(SuiteExtension::REGISTRY_ID),
        ]);
        $controllerDefinition->addTag(CliExtension::CONTROLLER_TAG, array('priority' => 1000));
        $container->setDefinition(CliExtension::CONTROLLER_TAG . '.tag_isolating_suite', $controllerDefinition);
    }

    private function overwriteSuiteRegistry(ContainerBuilder $container): void
    {
        $definition = new Definition(MutableSuiteRegistry::class);
        $container->setDefinition(SuiteExtension::REGISTRY_ID, $definition);
    }

    private function overwriteSuiteController(ContainerBuilder $container): void
    {
        $container
            ->getDefinition(CliExtension::CONTROLLER_TAG . '.suite')
            ->setClass(SuiteController::class)
        ;
    }
}

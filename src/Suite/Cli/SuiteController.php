<?php

declare(strict_types=1);

namespace SyliusLabs\SuiteTagsExtension\Suite\Cli;

use Behat\Testwork\Cli\Controller;
use Behat\Testwork\Suite\Cli\SuiteController as BaseSuiteController;
use Behat\Testwork\Suite\Exception\SuiteNotFoundException;
use Behat\Testwork\Suite\SuiteRegistry;
use Behat\Testwork\Suite\SuiteRepository;
use SyliusLabs\SuiteTagsExtension\Suite\MutableSuiteRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Overridden to allow passing a different suite registry.
 *
 * @see BaseSuiteController
 */
final class SuiteController implements Controller
{
    /** @var SuiteRegistry|MutableSuiteRegistry */
    private SuiteRepository $registry;

    private array $suiteConfigurations;

    public function __construct(SuiteRepository $registry, array $suiteConfigurations = [])
    {
        $this->registry = $registry;
        $this->suiteConfigurations = $suiteConfigurations;
    }

    public function configure(Command $command): void
    {
        $command->addOption('--suite', '-s', InputOption::VALUE_REQUIRED, 'Only execute a specific suite.');
    }

    public function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $exerciseSuiteName = $input->getOption('suite');

        if (null !== $exerciseSuiteName && !isset($this->suiteConfigurations[$exerciseSuiteName])) {
            throw new SuiteNotFoundException(sprintf(
                '`%s` suite is not found or has not been properly registered.',
                $exerciseSuiteName
            ), $exerciseSuiteName);
        }

        foreach ($this->suiteConfigurations as $name => $config) {
            if (null !== $exerciseSuiteName && $exerciseSuiteName !== $name) {
                continue;
            }

            $this->registry->registerSuiteConfiguration($name, $config['type'], $config['settings']);
        }

        return null;
    }
}

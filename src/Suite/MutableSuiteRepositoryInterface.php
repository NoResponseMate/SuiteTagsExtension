<?php

declare(strict_types=1);

namespace NoResponseMate\SuiteTagsExtension\Suite;

use Behat\Testwork\Suite\SuiteRepository;

interface MutableSuiteRepositoryInterface extends SuiteRepository
{
    public function getSuitesConfigurations(): array;

    public function removeSuiteConfiguration(string $name): void;
}

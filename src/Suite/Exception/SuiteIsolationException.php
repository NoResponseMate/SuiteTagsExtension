<?php

declare(strict_types=1);

namespace NoResponseMate\SuiteTagIsolationExtension\Suite\Exception;

use Behat\Testwork\Exception\TestworkException;

final class SuiteIsolationException extends \InvalidArgumentException implements TestworkException
{
    public function __construct(string $message, \Throwable $previousException = null)
    {
        parent::__construct($message, 0, $previousException);
    }
}

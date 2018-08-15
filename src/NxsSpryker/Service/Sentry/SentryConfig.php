<?php
declare(strict_types=1);


namespace NxsSpryker\Service\Sentry;


use Spryker\Service\Kernel\AbstractBundleConfig;

class SentryConfig extends AbstractBundleConfig
{
    public const CLIENT_URL = 'sentry.client.url';
    public const URL_KEY = 'sentry.url.key';
    public const URL_DOMAIN = 'sentry.url.domain';
    public const URL_PROJECT = 'sentry.url.project';
    public const CLIENT_CONFIG = 'sentry.client.config';
    public const ERROR_TO_LOG = 'sentry.error.to.log';
    public const RUN_PREVIOUR_HANDLER = 'sentry.run.previour.handler';

    /**
     * @return bool
     */
    public function isRunPreviousHandler(): bool
    {
        return $this->get(self::RUN_PREVIOUR_HANDLER, false);
    }

    /**
     * @return int
     */
    public function getErrorToLog(): int
    {
        return $this->get(
            self::ERROR_TO_LOG,
            E_ERROR & E_WARNING & E_PARSE & E_NOTICE & E_CORE_ERROR
            & E_CORE_WARNING & E_COMPILE_ERROR & E_COMPILE_WARNING
            & E_USER_ERROR & E_USER_WARNING & E_USER_NOTICE & E_STRICT
            & E_RECOVERABLE_ERROR
        );
    }

    /**
     * @return string
     */
    public function getClientUrl(): string
    {
        return $this->get(self::CLIENT_URL);
    }

    /**
     * @return array
     */
    public function getClientConfig(): array
    {
        return $this->get(self::CLIENT_CONFIG, [
            'environment' => getenv('APPLICATION_ENV'),
            'store' => getenv('APPLICATION_STORE')
        ]);
    }
}
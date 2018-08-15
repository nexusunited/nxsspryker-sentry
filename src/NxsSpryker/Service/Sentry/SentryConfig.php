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
    public const IGNORE_ERROR_TYPES = 'sentry.ignore.error.types';
    public const RUN_PREVIOUS_HANDLER = 'sentry.run.previous.handler';

    /**
     * @return bool
     */
    public function isRunPreviousHandler(): bool
    {
        return $this->get(self::RUN_PREVIOUS_HANDLER, true);
    }

    /**
     * @return int
     */
    public function getIgnoredErrorTypes(): int
    {
        return $this->get(
            self::IGNORE_ERROR_TYPES,
            E_DEPRECATED & E_USER_DEPRECATED
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
            'tags' => [
                'environment' => getenv('APPLICATION_ENV'),
                'store' => getenv('APPLICATION_STORE')
            ]
        ]);
    }
}
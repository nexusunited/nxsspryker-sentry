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
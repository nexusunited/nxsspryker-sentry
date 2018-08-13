<?php


namespace NxsSpryker\Shared\Sentry;


use Spryker\Shared\Kernel\AbstractBundleConfig;

class SentryConfig extends AbstractBundleConfig
{
    public const CLIENT_URL = 'sentry.client.url';
    public const URL_KEY = 'sentry.url.key';
    public const URL_DOMAIN = 'sentry.url.domain';
    public const URL_PROJECT = 'sentry.url.project';

    /**
     * @return string
     */
    public function getClientUrl(): string
    {
        return $this->get(self::CLIENT_URL);
    }
}
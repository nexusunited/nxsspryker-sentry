<?php
declare(strict_types=1);


namespace NxsSpryker\Yves\Sentry;


use Spryker\Yves\Kernel\AbstractBundleConfig;

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
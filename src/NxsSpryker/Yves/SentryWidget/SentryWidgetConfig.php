<?php

namespace NxsSpryker\Yves\SentryWidget;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class SentryWidgetConfig extends AbstractBundleConfig
{
    public const JS_IS_ACTIVE = 'sentry.widget.is.active';
    public const JS_CLIENT_URL = 'sentry.widget.client.url';
    public const URL_KEY = 'sentry.url.key';
    public const URL_DOMAIN = 'sentry.url.domain';
    public const URL_PROJECT = 'sentry.url.project';

    /**
     * @return string
     */
    public function getJsClientUrl(): string
    {
        return $this->get(self::JS_CLIENT_URL, '');
    }

    /**
     * @return bool
     */
    public function isJsClientActive(): bool
    {
        return $this->get(self::JS_IS_ACTIVE, false);
    }
}

<?php

namespace NxsSpryker\Yves\SentryWidget;

use NxsSpryker\Shared\Sentry\SentryConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

/**
 * @method \NxsSpryker\Yves\SentryWidgetFactory getFactory()
 */
class SentryWidgetConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getJsClientUrl(): string
    {
        return $this->get(SentryConstants::JS_CLIENT_URL, '');
    }
}

<?php

namespace NxsSpryker\Yves\SentryWidget\Plugin\Provider;

use Spryker\Yves\Kernel\Widget\AbstractWidgetPlugin;

/**
 * @method \NxsSpryker\Yves\SentryWidget\SentryWidgetConfig getConfig()
 */
class SentryWidgetPlugin extends AbstractWidgetPlugin
{
    const NAME = 'SentryWidgetPlugin';

    /**
     * @return void
     */
    public function initialize(): void
    {
        $this->addParameter('sentryIsActive', $this->getConfig()->isJsClientActive());
        $this->addParameter('sentryUrl', $this->getConfig()->getJsClientUrl());
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@SentryWidget/index.twig';
    }
}

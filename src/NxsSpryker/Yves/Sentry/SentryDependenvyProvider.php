<?php
declare(strict_types=1);


namespace NxsSpryker\Yves\Sentry;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;


/**
 * @method \NxsSpryker\Yves\Sentry\SentryConfig getConfig()
 */
class SentryDependenvyProvider extends AbstractBundleDependencyProvider
{
    public const SENTRY_CLIENT         = 'sentry.raven.client';
    public const SENTRY_CLIENT_PLUGINS = 'sentry.client.plugins';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->addSentryClient($container);
        $container = $this->addSentryClientPlugins($container);

        return $container;
    }


    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addSentryClient(Container $container): \Spryker\Yves\Kernel\Container
    {
        $container[self::SENTRY_CLIENT] = function (Container $container) {
            return new \Raven_Client($this->getConfig()->getClientUrl());
        };
        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function addSentryClientPlugins(Container $container): \Spryker\Yves\Kernel\Container
    {
        $container[self::SENTRY_CLIENT_PLUGINS] = function (Container $container) {
            return $this->getSentryClientPlugins($container);
        };
        return $container;
    }

    /**
     * @return \NxsSpryker\Yves\Sentry\Dependency\Plugin\SentryClientPluginInterface[]
     */
    protected function getSentryClientPlugins(Container $container): array
    {
        return [];
    }
}
<?php


namespace NxsSpryker\Shared\Sentry;



/**
 * @method \NxsSpryker\Shared\Sentry\SentryConfig getConfig()
 */
class SentryDependenvyProvider extends AbstractBundleDependencyProvider
{
    public const SENTRY_CLIENT = 'sentry.raven.client';

    /**
     * @param \Spryker\Shared\Kernel\Container $container
     *
     * @return \Spryker\Shared\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addSentryClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Shared\Kernel\Container $container
     *
     * @return \Spryker\Shared\Kernel\Container
     */
    protected function addSentryClient(Container $container): \Spryker\Shared\Kernel\Container
    {
        $container[self::SENTRY_CLIENT] = function (Container $container) {
            return new \Raven_Client($this->getConfig()->getClientUrl());
        };
        return $container;
    }

    /**
     * @return \NxsSpryker\Shared\Sentry\Dependency\Plugin\SentryClientPluginInterface[]
     */
    protected function getSentryClientPlugins(): array
    {
        return [];
    }
}
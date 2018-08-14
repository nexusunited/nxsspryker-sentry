<?php
declare(strict_types=1);


namespace NxsSpryker\Service\Sentry;

use NxsSpryker\Service\Sentry\Business\Model\Client\SentryClient;
use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;


/**
 * @method \NxsSpryker\Service\Sentry\SentryConfig getConfig()
 */
class SentryDependencyProvider extends AbstractBundleDependencyProvider
{
    public const SENTRY_CLIENT         = 'sentry.raven.client';
    public const SENTRY_CLIENT_PLUGINS = 'sentry.client.plugins';

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->addSentryClient($container);
        $container = $this->addSentryClientPlugins($container);

        return $container;
    }


    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    protected function addSentryClient(Container $container): \Spryker\Service\Kernel\Container
    {
        $container[self::SENTRY_CLIENT] = function (Container $container) {
            return new SentryClient(
                $this->getConfig()->getClientUrl(),
                $this->getConfig()->getClientConfig(),
                $this->getSentryClientPlugins()
            );
        };
        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    protected function addSentryClientPlugins(Container $container): \Spryker\Service\Kernel\Container
    {
        $container[self::SENTRY_CLIENT_PLUGINS] = function (Container $container) {
            return $this->getSentryClientPlugins($container);
        };
        return $container;
    }

    /**
     * @return \NxsSpryker\Service\Sentry\Dependency\Plugin\SentryClientPluginInterface[]
     */
    protected function getSentryClientPlugins(Container $container): array
    {
        return [];
    }
}
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

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container)
    {
        $container = $this->addSentryClient($container);

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
                $this->getConfig()->isActive(),
                $this->getConfig()->getClientUrl(),
                $this->getConfig()->getClientConfig(),
                $this->getSentryClientPlugins($container)
            );
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
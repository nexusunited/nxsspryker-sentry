<?php
declare(strict_types=1);


namespace NxsSpryker\Yves\Sentry;


use NxsSpryker\Yves\Sentry\Business\Model\Client\ClientProvider;
use NxsSpryker\Yves\Sentry\Business\Model\Client\ClientProviderInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class SentryFactory extends AbstractFactory
{

    /**
     * @return \Raven_ErrorHandler
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createSentryErrorHandler(): \Raven_ErrorHandler
    {
        return new \Raven_ErrorHandler(
            $this->createClientProvider()->getClient()
        );
    }

    /**
     * @return \NxsSpryker\Yves\Sentry\Business\Model\Client\ClientProviderInterface
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createClientProvider(): ClientProviderInterface
    {
        return new ClientProvider(
            $this->getSentryClient(),
            $this->getSentryClientPlugins()
        );
    }

    /**
     * @return \Raven_Client
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getSentryClient(): \Raven_Client
    {
        return $this->getProvidedDependency(SentryDependenvyProvider::SENTRY_CLIENT);
    }

    /**
     * @return array
     */
    public function getSentryClientPlugins(): array
    {
        return $this->getProvidedDependency(SentryDependenvyProvider::SENTRY_CLIENT);
    }
}
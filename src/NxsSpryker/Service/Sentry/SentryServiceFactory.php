<?php
declare(strict_types=1);


namespace NxsSpryker\Service\Sentry;


use NxsSpryker\Service\Sentry\Business\Model\Client\ClientProviderInterface;
use Spryker\Service\Kernel\AbstractFactory;
use Spryker\Service\Kernel\AbstractServiceFactory;

class SentryServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \Raven_Client
     * @throws \Spryker\Service\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getSentryClient(): \Raven_Client
    {
        return $this->getProvidedDependency(SentryDependencyProvider::SENTRY_CLIENT);
    }

}
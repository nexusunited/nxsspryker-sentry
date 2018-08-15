<?php

namespace NxsSpryker\Service\Sentry;

interface SentryServiceFactoryInterface
{
    /**
     * @return \Raven_Client
     * @throws \Spryker\Service\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function getSentryClient(): \Raven_Client;
}
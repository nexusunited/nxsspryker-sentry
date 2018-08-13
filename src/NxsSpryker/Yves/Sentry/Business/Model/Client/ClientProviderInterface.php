<?php

namespace NxsSpryker\Zed\Sentry\Business\Model\Client;

interface ClientProviderInterface
{
    /**
     * @return \Raven_Client
     */
    public function getClient(): \Raven_Client;
}
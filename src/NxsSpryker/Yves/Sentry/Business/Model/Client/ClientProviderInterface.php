<?php
declare(strict_types=1);

namespace NxsSpryker\Yves\Sentry\Business\Model\Client;

interface ClientProviderInterface
{
    /**
     * @return \Raven_Client
     */
    public function getClient(): \Raven_Client;
}
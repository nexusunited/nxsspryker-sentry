<?php
declare(strict_types=1);


namespace NxsSpryker\Service\Sentry\Dependency\Plugin;


interface SentryClientPluginInterface
{
    /**
     * @param \Raven_Client $client
     */
    public function register(\Raven_Client $client): void;
}
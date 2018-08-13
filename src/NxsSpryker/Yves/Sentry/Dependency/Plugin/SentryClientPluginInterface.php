<?php


namespace NxsSpryker\Shared\Sentry\Dependency\Plugin;


interface SentryClientPluginInterface
{
    /**
     * @param \Raven_Client $client
     *
     * @return \Raven_Client
     */
    public function register(\Raven_Client $client): \Raven_Client;
}
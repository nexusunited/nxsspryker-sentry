<?php
declare(strict_types=1);


namespace NxsSpryker\Yves\Sentry\Business\Model\Client;


class ClientProvider implements ClientProviderInterface
{
    /**
     * @var \Raven_Client
     */
    private $client;

    /**
     * @var array
     */
    private $clientPluginCollection;

    /**
     * ClientProvider constructor.
     *
     * @param \Raven_Client $client
     * @param array $clientPluginCollection
     */
    public function __construct(\Raven_Client $client, array $clientPluginCollection)
    {
        $this->client = $client;
        $this->clientPluginCollection = $clientPluginCollection;
    }

    /**
     * @return \Raven_Client
     */
    public function getClient(): \Raven_Client
    {
        $this->processPlugins();

        return $this->client;
    }

    protected function processPlugins(): void
    {
        foreach ($this->clientPluginCollection as $plugin) {
            $this->client = $plugin->register($this->client);
        }
    }
}
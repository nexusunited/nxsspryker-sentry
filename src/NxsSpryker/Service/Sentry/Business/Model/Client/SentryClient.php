<?php
declare(strict_types=1);


namespace NxsSpryker\Service\Sentry\Business\Model\Client;


class SentryClient extends \Raven_Client
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $options;

    /**
     * @var array
     */
    private $clientPluginCollection;

    /**
     * ClientProvider constructor.
     *
     * @param string $url
     * @param array $options
     * @param array $clientPluginCollection
     */
    public function __construct(string $url, array $options, array $clientPluginCollection)
    {
        $this->url = $url;
        $this->options = $options;
        $this->clientPluginCollection = $clientPluginCollection;

        parent::__construct($url, $options);
    }

    public function processPlugins(): void
    {
        foreach ($this->clientPluginCollection as $plugin) {
            $plugin->register($this);
        }
    }
}
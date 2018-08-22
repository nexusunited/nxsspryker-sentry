<?php
declare(strict_types=1);


namespace NxsSpryker\Service\Sentry\Business\Model\Client;


class SentryClient extends \Raven_Client
{
    /**
     * @var bool
     */
    private $isActive;

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
     * SentryClient constructor.
     *
     * @param bool $isActive
     * @param string $url
     * @param array $options
     * @param array $clientPluginCollection
     */
    public function __construct(
        bool $isActive,
        string $url,
        array $options,
        array $clientPluginCollection
    ) {
        $this->isActive = $isActive;
        $this->url = $url;
        $this->options = $options;
        $this->clientPluginCollection = $clientPluginCollection;

        parent::__construct($url, $options);
    }

    public function processPlugins(): void
    {
        if ($this->isActive) {
            foreach ($this->clientPluginCollection as $plugin) {
                $plugin->register($this);
            }
        }
    }

    /**
     * Log a message to sentry
     *
     * @param string $message The message (primary description) for the event.
     * @param array $params params to use when formatting the message.
     * @param array $data Additional attributes to pass with this event (see Sentry docs).
     * @param bool|array $stack
     * @param mixed $vars
     *
     * @return string|null
     */
    public function captureMessage(
        $message,
        $params = array(),
        $data = array(),
        $stack = false,
        $vars = null
    ) {
        $result = null;

        if ($this->isActive) {
            $result = parent::captureMessage(
                $message,
                $params,
                $data,
                $stack,
                $vars
            );
        }

        return $result;
    }

    /**
     * Log an exception to sentry
     *
     * @param \Throwable|\Exception $exception The Throwable/Exception object.
     * @param array $data Additional attributes to pass with this event (see Sentry docs).
     * @param mixed $logger
     * @param mixed $vars
     *
     * @return string|null
     */
    public function captureException(
        $exception,
        $data = null,
        $logger = null,
        $vars = null
    ) {
        $result = null;

        if ($this->isActive) {
            $result = parent::captureException($exception, $data, $logger, $vars);
        }

        return $result;
    }

    /**
     * Capture the most recent error (obtained with ``error_get_last``).
     * @return string|null
     */
    public function captureLastError()
    {
        $result = null;

        if ($this->isActive) {
            $result = parent::captureLastError();
        }

        return $result;
    }


}
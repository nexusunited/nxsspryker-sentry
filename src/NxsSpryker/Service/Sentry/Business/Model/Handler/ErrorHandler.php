<?php


namespace NxsSpryker\Service\Sentry\Business\Model\Handler;


use NxsSpryker\Service\NxsErrorHandler\Dependency\Plugin\NxsErrorHandlerPlugin;
use NxsSpryker\Service\Sentry\SentryConfig;
use Spryker\Service\Kernel\AbstractPlugin;
use Spryker\Shared\Config\Config;

/**
 * @method \NxsSpryker\Service\Sentry\SentryConfig getConfig()
 * @method \NxsSpryker\Service\Sentry\SentryService getService()
 */
class ErrorHandler extends AbstractPlugin implements NxsErrorHandlerPlugin
{
    /**
     * @var mixed
     */
    private $oldErrorHandler;

    /**
     * @param bool $isDebug
     */
    public function register(bool $isDebug): void
    {
        if ($isDebug) {
            $this->oldErrorHandler = set_error_handler(
                [
                    $this,
                    'handleError'
                ]
            );
        }
    }

    /**
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @param array $errcontext
     *
     * @return bool
     */
    public function handleError(
        int $errno,
        string $errstr,
        string $errfile,
        int $errline,
        array $errcontext
    ): bool {
        if (($errno & $this->getConfig()->getIgnoredErrorTypes()) === 0) {
            $exception = new \ErrorException($errstr, 0, $errno, $errfile, $errline);
            $this->getService()->captureException(
                $exception,
                [
                    'tags' =>
                        [
                            'handler' => __CLASS__
                        ]
                ]
            );
        }

        if ($this->oldErrorHandler && $this->getConfig()->isRunPreviousHandler()) {
            \call_user_func(
                $this->oldErrorHandler,
                $errno,
                $errstr,
                $errfile,
                $errline,
                $errcontext
            );
        }

        return true;
    }

}
<?php


namespace NxsSpryker\Service\Sentry\Business\Model\Handler;


use NxsSpryker\Service\NxsErrorHandler\Dependency\Plugin\NxsErrorHandlerPlugin;
use NxsSpryker\Service\NxsErrorHandler\Dependency\Plugin\NxsExceptionHandlerPlugin;
use Spryker\Service\Kernel\AbstractPlugin;

/**
 * @method \NxsSpryker\Service\Sentry\SentryServiceFactory getFactory()
 */
class ShutdownHandler extends AbstractPlugin implements NxsExceptionHandlerPlugin
{
    /**
     * @param bool $isDebug
     */
    public function register(bool $isDebug): void
    {
        if ($isDebug) {
            register_shutdown_function(
                [
                    $this,
                    'handleShutdown'
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
    public function handleShutdown(): void
    {
        $error = error_get_last();

        if ($error === null) {
            return;
        }

        $exception = new \ErrorException(
            @$error['message'],
            0,
            @$error['type'],
            @$error['file'],
            @$error['line']
        );

        $this->getFactory()->getSentryClient()->captureException($exception);
    }

}
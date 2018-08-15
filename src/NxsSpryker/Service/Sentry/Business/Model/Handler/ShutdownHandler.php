<?php


namespace NxsSpryker\Service\Sentry\Business\Model\Handler;


use NxsSpryker\Service\NxsErrorHandler\Dependency\Plugin\NxsErrorHandlerPlugin;
use NxsSpryker\Service\NxsErrorHandler\Dependency\Plugin\NxsExceptionHandlerPlugin;
use Spryker\Service\Kernel\AbstractPlugin;

/**
 * @method \NxsSpryker\Service\Sentry\SentryServiceFactory getFactory()
 * @method \NxsSpryker\Service\Sentry\SentryService getService()
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

    public function handleShutdown(): void
    {
        $error = error_get_last();

        if ($error === null || ($error['type'] & $this->getConfig()->getIgnoredErrorTypes()) !== 0) {
            return;
        }

        $exception = new \ErrorException(
            @$error['message'],
            0,
            @$error['type'],
            @$error['file'],
            @$error['line']
        );

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

}
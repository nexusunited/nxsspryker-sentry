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
     * @var array
     */
    private $includeErrorTypes = [
        E_ERROR,
        E_WARNING,
        E_PARSE,
        E_NOTICE,
        E_CORE_ERROR,
        E_CORE_WARNING,
        E_COMPILE_ERROR,
        E_COMPILE_WARNING,
        E_USER_ERROR,
        E_USER_WARNING,
        E_USER_NOTICE,
        E_STRICT,
        E_RECOVERABLE_ERROR
    ];

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

        if (!\in_array($error['type'], $this->includeErrorTypes, true)) {
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
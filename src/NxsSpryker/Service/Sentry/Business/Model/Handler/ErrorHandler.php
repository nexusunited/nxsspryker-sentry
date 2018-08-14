<?php


namespace NxsSpryker\Service\Sentry\Business\Model\Handler;


use NxsSpryker\Service\NxsErrorHandler\Dependency\Plugin\NxsErrorHandlerPlugin;
use Spryker\Service\Kernel\AbstractPlugin;

/**
 * @method \NxsSpryker\Service\Sentry\SentryServiceFactory getFactory()
 */
class ErrorHandler extends AbstractPlugin implements NxsErrorHandlerPlugin
{
    /**
     * @var mixed
     */
    private $oldErrorHandler;

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
        if (in_array($errno, $this->includeErrorTypes)) {
            $exception = new \ErrorException($errstr, 0, $errno, $errfile, $errline);
            $this->getFactory()->getSentryClient()->captureException($exception);
        }

        if ($this->oldErrorHandler) {
            return \call_user_func(
                $this->oldErrorHandler,
                $errno,
                $errstr,
                $errfile,
                $errline,
                $errcontext
            );
        }
    }

}
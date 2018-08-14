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
        $exception = new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        $this->getFactory()->getSentryClient()->captureException($exception);

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
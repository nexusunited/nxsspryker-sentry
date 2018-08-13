<?php
declare(strict_types=1);


namespace NxsSpryker\Yves\Sentry\Plugin;


use Silex\Application;
use Silex\ServiceProviderInterface;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @method \NxsSpryker\Yves\Sentry\Business\SentryFactory getFactory()
 */
class SentryServiceProvider extends AbstractPlugin implements ServiceProviderInterface
{
    /**
     * @param \Silex\Application $app
     *
     * @throws \Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function register(Application $app)
    {
        $errorHandler = $this->getFactory()->createSentryErrorHandler();
        $errorHandler->registerExceptionHandler();
        $errorHandler->registerErrorHandler();
        $errorHandler->registerShutdownFunction();
    }

    /**
     * @param \Silex\Application $app
     */
    public function boot(Application $app)
    {
    }
}
<?php


namespace NxsSpryker\Shared\Sentry\Plugin;


use Silex\Application;
use Silex\ServiceProviderInterface;

class SentryServiceProvider extends AbstractPlugin implements ServiceProviderInterface
{
    public function register(Application $app)
    {
    }

    public function boot(Application $app)
    {
        // TODO: Implement boot() method.
    }
}
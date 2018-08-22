NxsSpryker/Sentry
===================

Spryker module to add Sentry as error monitoring.


Installation
------------------
```
composer require nxsspryker/sentry
```

For ***PHP Tracking*** you need to register the handler in the NxsErrorHandlerDependencyProvider.
```php
<?php

namespace Pyz\Service\NxsErrorHandler;

use NxsSpryker\Service\NxsErrorHandler\NxsErrorHandlerDependencyProvider as NxsSpyNxsErrorHandlerDependencyProvider;
use NxsSpryker\Service\Sentry\Business\Model\Handler\ErrorHandler;
use NxsSpryker\Service\Sentry\Business\Model\Handler\ExceptionHandler;
use NxsSpryker\Service\Sentry\Business\Model\Handler\ShutdownHandler;

class NxsErrorHandlerDependencyProvider extends NxsSpyNxsErrorHandlerDependencyProvider
{
    /**
     * @return array
     */
    protected function getErrorHandlerPlugins(): array
    {
        return [
            new ErrorHandler()
        ];
    }

    /**
     * @return array
     */
    protected function getExceptionHandlerPlugins(): array
    {
        return [
            new ExceptionHandler()
        ];
    }

    /**
     * @return array
     */
    protected function getShutdownHandlerPlugins(): array
    {
        return [
            new ShutdownHandler()
        ];
    }

}
```

For ***JS Tracking*** you must activate the widget in your ShopApplicationDependencyProvider
```php
<?php

namespace Pyz\Yves\ShopApplication;

use NxsSpryker\Yves\SentryWidget\Plugin\Provider\SentryWidgetPlugin;
use SprykerShop\Yves\ShopApplication\ShopApplicationDependencyProvider as SprykerShopApplicationDependencyProvider;

class ShopApplicationDependencyProvider extends SprykerShopApplicationDependencyProvider
{
 /**
  * @return string[]
  */
 protected function getGlobalWidgetPlugins(): array
 {
     return [
         // ...
         SentryWidgetPlugin::class
     ];
 }
}

```

Also you have to add the widget in your template:
```
{{ widgetGlobal('SentryWidgetPlugin') }}
```


Configuration
------------------

You can extend the client with an own plugin which implemements \NxsSpryker\Yves\Sentry\Dependency\Plugin\SentryClientPluginInterface.
You can add them to the SentryDependencyProvider.

Also you have to add "NxsSpryker" as a project namespace in your config_default.php.

You have to configure an Sentry-Project for PHP in your configs:
```php
use NxsSpryker\Service\Sentry\SentryConfig;

$config[SentryConfig::URL_KEY] = 'abc';
$config[SentryConfig::URL_DOMAIN] = 'sentry.io';
$config[SentryConfig::URL_PROJECT] = 'myproject';

$config[SentryConfig::IS_ACTIVE] = true;
$config[SentryConfig::CLIENT_URL] = sprintf(
    'https://%s@%s/%s',
    $config[SentryConfig::URL_KEY],
    $config[SentryConfig::URL_DOMAIN],
    $config[SentryConfig::URL_PROJECT]
);
```


You have to configure an Sentry-Project for JS in your configs:
```php
use NxsSpryker\Yves\SentryWidget\SentryWidgetConfig;

$config[SentryWidgetConfig::URL_KEY] = 'abc';
$config[SentryWidgetConfig::URL_DOMAIN] = 'sentry.io';
$config[SentryWidgetConfig::URL_PROJECT] = 'myproject';

$config[SentryWidgetConfig::JS_IS_ACTIVE] = true;
$config[SentryWidgetConfig::JS_CLIENT_URL] = sprintf(
    'https://%s@%s/%s',
    $config[SentryWidgetConfig::URL_KEY],
    $config[SentryWidgetConfig::URL_DOMAIN],
    $config[SentryWidgetConfig::URL_PROJECT]
);

```

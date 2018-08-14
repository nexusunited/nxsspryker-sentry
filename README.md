NxsSpryker/Sentry
===================

Spryker module to add Sentry as error monitoring.


Installation
------------------
```
composer require nxsspryker/sentry
```

You need to register the handler in the NxsErrorHandlerDependencyProvider.


Configuration
------------------

You can extend the client with an own plugin which implemements \NxsSpryker\Yves\Sentry\Dependency\Plugin\SentryClientPluginInterface.
You can add them to the SentryDependencyProvider.

Also you have to add "NxsSpryker" as a project namespace in your config_default.php.

You have to configure an Sentry-Project in your configs:
```php
use NxsSpryker\Yves\Sentry\SentryConfig;

$config[SentryConfig::URL_KEY] = 'abc';
$config[SentryConfig::URL_DOMAIN] = 'sentry.io';
$config[SentryConfig::URL_PROJECT] = 'myproject';

$config[SentryConfig::CLIENT_URL] = sprintf(
    'https://%s@%s/%s',
    $config[SentryConfig::URL_KEY],
    $config[SentryConfig::URL_DOMAIN],
    $config[SentryConfig::URL_PROJECT]
);
```
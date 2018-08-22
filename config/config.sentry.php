<?php


use NxsSpryker\Service\Sentry\SentryConfig;
use NxsSpryker\Yves\SentryWidget\SentryWidgetConfig;

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

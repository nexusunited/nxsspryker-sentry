<?php

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

<?php

namespace NxsSpryker\Service\Sentry;


/**
 * @method \NxsSpryker\Service\Sentry\SentryServiceFactory getFactory()
 */
interface SentryServiceInterface
{
    /**
     * @param \Throwable $exception
     * @param array|null $data
     *
     * @return null|string
     * @throws \Spryker\Service\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function captureException(\Throwable $exception, array $data = null): ?string;

    /**
     * @param string $message
     * @param array $params
     * @param array $data
     *
     * @return null|string
     * @throws \Spryker\Service\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function captureMessafe(string $message, array $params, array $data): ?string;
}
<?php


namespace NxsSpryker\Service\Sentry;


use Spryker\Service\Kernel\AbstractService;

/**
 * @method \NxsSpryker\Service\Sentry\SentryServiceFactory getFactory()
 */
class SentryService extends AbstractService implements SentryServiceInterface
{
    /**
     * @param \Throwable $exception
     * @param array|null $data
     *
     * @return null|string
     * @throws \Spryker\Service\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function captureException(\Throwable $exception, array $data = null): ?string
    {
        return $this->getFactory()->getSentryClient()->captureException(
            $exception,
            $data
        );
    }

    /**
     * @param string $message
     * @param array $params
     * @param array $data
     *
     * @return null|string
     * @throws \Spryker\Service\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function captureMessafe(string $message, array $params, array $data): ?string
    {
        return $this->getFactory()->getSentryClient()->captureMessage(
            $message,
            $params,
            $data
        );
    }
}
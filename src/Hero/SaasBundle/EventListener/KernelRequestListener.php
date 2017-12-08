<?php

namespace Hero\SaasBundle\EventListener;


use Doctrine\ORM\EntityManagerInterface;
use Hero\SaasBundle\DBAL\Connection\ConnectionWrapper;
use Hero\SaasBundle\Entity\Tenant;
use Hero\SaasBundle\Provider\TenantProviderInterface;
use Hero\SaasBundle\Repository\TenantRepository;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class KernelRequestListener
{
    /**
     * @var ConnectionWrapper
     */
    private $connection;

    /**
     * @var TenantProviderInterface
     */
    private $tenantProvider;

    public function __construct(ConnectionWrapper $connection, TenantProviderInterface $tenantProvider)
    {
        $this->connection = $connection;
        $this->tenantProvider = $tenantProvider;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $exp = explode('.', $event->getRequest()->getHttpHost());
        $tenantName = reset($exp);

        $tenant = $this->tenantProvider->get($tenantName);
        if ($tenant) {
            $this->connection->switchConnection(
                $tenant->getServer(),
                $tenant->getDbName(),
                $tenant->getSchema()
            );
        }
    }
}
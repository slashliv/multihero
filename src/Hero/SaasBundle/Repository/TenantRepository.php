<?php

namespace Hero\SaasBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Hero\SaasBundle\Entity\Tenant;
use Hero\SaasBundle\Provider\TenantProviderInterface;

class TenantRepository extends EntityRepository implements TenantProviderInterface
{
    /**
     * @param string $id
     *
     * @return Tenant|null
     */
    public function get(string $id): ?Tenant
    {
        return $this->find($id);
    }
}
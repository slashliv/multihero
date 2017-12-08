<?php

namespace Hero\SaasBundle\Provider;

use Hero\SaasBundle\Entity\Tenant;

interface TenantProviderInterface
{
    public function get(string $id): ?Tenant;
}
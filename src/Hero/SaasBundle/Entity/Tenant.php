<?php

namespace Hero\SaasBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tenant
 * @package Hero\SaasBundle\Entity
 *
 * @ORM\Entity(
 *      repositoryClass="Hero\SaasBundle\Repository\TenantRepository"
 * )
 * @ORM\Table(name="hero_tenant")
 */
class Tenant
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="string", length=15)
     *
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(name="db_name", type="string", length=31)
     *
     * @var string
     */
    private $dbName;

    /**
     * @var string
     *
     * @ORM\Column(name="schema", type="string", length=15)
     */
    private $schema;

    /**
     * @var  string
     *
     * @ORM\Column(name="server", type="string", length=255)
     */
    protected $server;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Tenant
     */
    public function setId($id): Tenant
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getDbName(): string
    {
        return $this->dbName;
    }

    /**
     * @param string $dbName
     *
     * @return Tenant
     */
    public function setDbName(string $dbName): Tenant
    {
        $this->dbName = $dbName;

        return $this;
    }

    /**
     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * @param string $server
     *
     * @return Tenant
     */
    public function setServer($server): Tenant
    {
        $this->server = $server;

        return $this;
    }

    /**
     * @return string
     */
    public function getSchema(): ?string
    {
        return $this->schema;
    }

    /**
     * @param string $schema
     *
     * @return Tenant
     */
    public function setSchema(string $schema): Tenant
    {
        $this->schema = $schema;

        return $this;
    }
}

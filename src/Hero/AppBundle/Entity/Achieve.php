<?php

namespace Hero\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Achieve
 * @package Hero\AppBundle\Entity
 *
 * @ORM\Entity(
 *      repositoryClass="Hero\AppBundle\Repository\AchieveRepository"
 * )
 * @ORM\Table(name="hero_achieve")
 */
class Achieve
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Achieve
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Achieve
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}
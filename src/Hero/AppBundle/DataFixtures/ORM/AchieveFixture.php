<?php

namespace Hero\AppBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Hero\AppBundle\Entity\Achieve;

class AchieveFixture extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $achieve = (new Achieve())
                ->setName("Name $i")
                ->setDescription("Description $i")
            ;

            $manager->persist($achieve);
        }
        $manager->flush();
    }
}

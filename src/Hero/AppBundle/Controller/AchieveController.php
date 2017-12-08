<?php

namespace Hero\AppBundle\Controller;


use Hero\AppBundle\Entity\Achieve;
use Hero\AppBundle\Repository\AchieveRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AchieveController extends Controller
{
    /**
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function listAction(Request $request)
    {
        /** @var Achieve[] $entries */
        $entries = $this->getRepository()->findAll();

        return [
            'entries' => $entries,
        ];
    }

    /**
     * @return AchieveRepository
     */
    private function getRepository(): AchieveRepository
    {
        return $this->container->get('doctrine.orm.tenant_entity_manager')->getRepository(Achieve::class);
    }
}

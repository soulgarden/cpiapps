<?php

namespace App\Controller;

use App\Entity\Offer;
use FOS\RestBundle\Controller\Annotations\View as RestView;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/offers")
 */
class OfferController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @RestView()
     * @return array
     */
    public function getAll(): array
    {
        return ['success' => true];
    }

    /**
     * @Route("/{id}", methods={"GET"})
     * @RestView()
     * @return array
     */
    public function getOne($id): array
    {
        return ['success' => true];
    }

    /**
     * @Route("/", methods={"POST"})
     * @RestView()
     * @return array
     */
    public function create(): array
    {
//        $this->createForm();
        return ['success' => true];
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     * @ParamConverter(name="offer", class="App\Entity\Offer")
     * @RestView(statusCode=204)
     * @return array
     */
    public function update(Offer $offer): array
    {
        return ['success' => true];
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @ParamConverter(name="offer", class="App\Entity\Offer")
     * @RestView(statusCode=204)
     * @param Offer $offer
     * @return array
     */
    public function delete(Offer $offer): array
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($offer);
        $manager->flush();

        return ['success' => true];
    }
}

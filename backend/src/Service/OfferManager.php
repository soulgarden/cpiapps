<?php

namespace App\Service;

use App\Entity\Offer;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class OfferService
 * @package App\Service
 */
class OfferManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * OfferService constructor.
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->objectManager = $managerRegistry->getManager();
    }

    /**
     * @return Offer[]
     */
    public function getOffers(): array
    {
        return $this->objectManager->getRepository(Offer::class)->findAll();
    }

    /**
     * @param Offer $offer
     */
    public function updateOffer(Offer $offer)
    {
        $this->objectManager->persist($offer);
        $this->objectManager->flush();
    }

    /**
     * @param Offer $offer
     */
    public function removeOffer(Offer $offer)
    {
        $this->objectManager->remove($offer);
        $this->objectManager->flush();
    }
}

<?php

namespace App\Entity\Common;

use App\Entity\Offer;

/**
 * Trait OfferTrait
 * @package App\Entity\Common
 */
trait OfferTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="streams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offer;

    /**
     * @return Offer|null
     */
    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    /**
     * @param Offer|null $offer
     * @return $this
     */
    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }
}

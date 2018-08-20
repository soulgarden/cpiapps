<?php

namespace App\Entity;

use App\Entity\Common\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 */
class Offer
{
    use IdTrait;
    use TimestampableEntity;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stream", mappedBy="offer")
     */
    private $streams;

    /**
     * Offer constructor.
     */
    public function __construct()
    {
        $this->streams = new ArrayCollection();
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Offer
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Offer
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @param Lead $lead
     * @return Offer
     */
    public function removeLead(Lead $lead): self
    {
        if ($this->leads->contains($lead)) {
            $this->leads->removeElement($lead);
            // set the owning side to null (unless already changed)
            if ($lead->getOffer() === $this) {
                $lead->setOffer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Stream[]
     */
    public function getStreams(): Collection
    {
        return $this->streams;
    }

    /**
     * @param Stream $stream
     * @return Offer
     */
    public function addStream(Stream $stream): self
    {
        if (!$this->streams->contains($stream)) {
            $this->streams[] = $stream;
            $stream->setOffer($this);
        }

        return $this;
    }

    /**
     * @param Stream $stream
     * @return Offer
     */
    public function removeStream(Stream $stream): self
    {
        if ($this->streams->contains($stream)) {
            $this->streams->removeElement($stream);
            // set the owning side to null (unless already changed)
            if ($stream->getOffer() === $this) {
                $stream->setOffer(null);
            }
        }

        return $this;
    }
}

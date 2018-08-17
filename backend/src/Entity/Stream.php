<?php

namespace App\Entity;

use App\Entity\Common\AgentTrait;
use App\Entity\Common\IdTrait;
use App\Entity\Common\OfferTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StreamRepository")
 */
class Stream
{
    use IdTrait;
    use AgentTrait;
    use OfferTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="streams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Host", mappedBy="stream")
     */
    private $hosts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hit", mappedBy="stream")
     */
    private $hits;

    /**
     * Stream constructor.
     */
    public function __construct()
    {
        $this->hosts = new ArrayCollection();
        $this->hits = new ArrayCollection();
    }

    /**
     * @return User|null
     */
    public function getOwner(): ?User
    {
        return $this->owner;
    }

    /**
     * @param User|null $owner
     * @return Stream
     */
    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

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
     * @return Stream
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return Collection|Host[]
     */
    public function getHosts(): Collection
    {
        return $this->hosts;
    }

    /**
     * @param Host $host
     * @return Stream
     */
    public function addHost(Host $host): self
    {
        if (!$this->hosts->contains($host)) {
            $this->hosts[] = $host;
            $host->setStream($this);
        }

        return $this;
    }

    /**
     * @param Host $host
     * @return Stream
     */
    public function removeHost(Host $host): self
    {
        if ($this->hosts->contains($host)) {
            $this->hosts->removeElement($host);
            // set the owning side to null (unless already changed)
            if ($host->getStream() === $this) {
                $host->setStream(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hit[]
     */
    public function getHits(): Collection
    {
        return $this->hits;
    }

    /**
     * @param Hit $hit
     * @return Stream
     */
    public function addHit(Hit $hit): self
    {
        if (!$this->hits->contains($hit)) {
            $this->hits[] = $hit;
            $hit->setStream($this);
        }

        return $this;
    }

    /**
     * @param Hit $hit
     * @return Stream
     */
    public function removeHit(Hit $hit): self
    {
        if ($this->hits->contains($hit)) {
            $this->hits->removeElement($hit);
            // set the owning side to null (unless already changed)
            if ($hit->getStream() === $this) {
                $hit->setStream(null);
            }
        }

        return $this;
    }
}

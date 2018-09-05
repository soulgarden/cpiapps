<?php

namespace App\Entity;

use App\Dictionary\ActivityStatusDictionary;
use App\Entity\Common\ActivityStatusTrait;
use App\Entity\Common\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StreamRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @UniqueEntity("uuid")
 */
class Stream
{
    use IdTrait;
    use ActivityStatusTrait;
    use TimestampableEntity;
    use SoftDeleteableEntity;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="streams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="streams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offer;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @var string
     * @Assert\Length(max="37")
     * @ORM\Column(type="string", length=37)
     */
    private $uuid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Host", mappedBy="stream")
     */
    private $hosts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hit", mappedBy="stream")
     */
    private $hits;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lead", mappedBy="stream")
     */
    private $leads;

    /**
     * Stream constructor.
     */
    public function __construct()
    {
        $this->hosts = new ArrayCollection();
        $this->hits = new ArrayCollection();
        $this->leads = new ArrayCollection();
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Stream
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Offer|null
     */
    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    /**
     * @param Offer $offer
     * @return $this
     */
    public function setOffer(Offer $offer): self
    {
        $this->offer = $offer;

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

    /**
     * @return Collection|Lead[]
     */
    public function getLeads(): Collection
    {
        return $this->leads;
    }

    /**
     * @param Lead $lead
     * @return Stream
     */
    public function addLead(Lead $lead): self
    {
        if (!$this->leads->contains($lead)) {
            $this->leads[] = $lead;
            $lead->setStream($this);
        }

        return $this;
    }

    /**
     * @param Lead $lead
     * @return Stream
     */
    public function removeLead(Lead $lead): self
    {
        if ($this->leads->contains($lead)) {
            $this->leads->removeElement($lead);
            // set the owning side to null (unless already changed)
            if ($lead->getStream() === $this) {
                $lead->setStream(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}

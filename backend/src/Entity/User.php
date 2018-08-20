<?php

namespace App\Entity;

use App\Entity\Common\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    use IdTrait;
    use TimestampableEntity;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stream", mappedBy="user")
     */
    private $streams;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->streams = new ArrayCollection();
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
     * @return User
     */
    public function addStream(Stream $stream): self
    {
        if (!$this->streams->contains($stream)) {
            $this->streams[] = $stream;
            $stream->setOwner($this);
        }

        return $this;
    }

    /**
     * @param Stream $stream
     * @return User
     */
    public function removeStream(Stream $stream): self
    {
        if ($this->streams->contains($stream)) {
            $this->streams->removeElement($stream);
            // set the owning side to null (unless already changed)
            if ($stream->getUser() === $this) {
                $stream->setOwner(null);
            }
        }

        return $this;
    }
}

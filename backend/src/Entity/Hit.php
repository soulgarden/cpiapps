<?php

namespace App\Entity;

use App\Entity\Common\AgentTrait;
use App\Entity\Common\BigIdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HitRepository")
 */
class Hit
{
    use BigIdTrait;
    use AgentTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stream", inversedBy="hits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stream;

    /**
     * @return Stream|null
     */
    public function getStream(): ?Stream
    {
        return $this->stream;
    }

    /**
     * @param Stream|null $stream
     * @return Hit
     */
    public function setStream(?Stream $stream): self
    {
        $this->stream = $stream;

        return $this;
    }
}

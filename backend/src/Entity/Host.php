<?php

namespace App\Entity;

use App\Entity\Common\AgentTrait;
use App\Entity\Common\BigIdTrait;
use App\Entity\Common\OfferTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HostRepository")
 */
class Host
{
    use BigIdTrait;
    use AgentTrait;
    use OfferTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stream", inversedBy="hosts")
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
     * @return Host
     */
    public function setStream(?Stream $stream): self
    {
        $this->stream = $stream;

        return $this;
    }
}
<?php

namespace App\Entity;

use App\Entity\Common\AgentTrait;
use App\Entity\Common\UuidTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HostRepository")
 */
class Host
{
    use UuidTrait;
    use AgentTrait;
    use TimestampableEntity;

    /**
     * @var Stream
     * @ORM\ManyToOne(targetEntity="App\Entity\Stream", inversedBy="hosts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stream;

    /**
     * Lead constructor.
     * @param Stream $stream
     * @param string $agent
     */
    public function __construct(Stream $stream, string $agent)
    {
        $this->stream = $stream;
        $this->agent = $agent;
    }

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

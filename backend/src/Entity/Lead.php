<?php

namespace App\Entity;

use App\Entity\Common\AgentTrait;
use App\Entity\Common\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeadRepository")
 */
class Lead
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Stream", inversedBy="leads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stream;

    use IdTrait;
    use AgentTrait;
    use TimestampableEntity;

    /**
     * @return Stream|null
     */
    public function getStream(): ?Stream
    {
        return $this->stream;
    }

    /**
     * @param Stream|null $stream
     * @return Lead
     */
    public function setStream(?Stream $stream): self
    {
        $this->stream = $stream;

        return $this;
    }
}

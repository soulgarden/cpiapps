<?php

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait AgentTrait
 * @package App\Entity\Common
 */
trait AgentTrait
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $agent;

    /**
     * @return null|string
     */
    public function getAgent(): ?string
    {
        return $this->agent;
    }

    /**
     * @param null|string $agent
     * @return $this
     */
    public function setAgent(?string $agent): self
    {
        $this->agent = $agent;

        return $this;
    }
}
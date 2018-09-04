<?php

namespace App\Entity\Common;

use App\Dictionary\ActivityStatusDictionary;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait ActivityStatusTrait
 * @package App\Entity\Common
 */
trait ActivityStatusTrait
{
    /**
     * @var string
     * @Assert\Choice({ActivityStatusDictionary::STATUS_ACTIVE, ActivityStatusDictionary::STATUS_INACTIVE})
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}

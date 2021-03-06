<?php
declare(strict_types=1);

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait UuidTrait
 */
trait UuidTrait
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="guid")
     * @Assert\Uuid(strict=true)
     */
    private $uuid;

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     *
     * @return $this
     */
    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}

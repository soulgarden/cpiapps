<?php

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait IdTrait
 * @package App\Entity\Common
 */
trait IdTrait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}

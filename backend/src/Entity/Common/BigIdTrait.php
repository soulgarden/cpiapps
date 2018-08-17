<?php

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait BigIdTrait
 * @package App\Entity\Common
 */
trait BigIdTrait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint")
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

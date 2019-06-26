<?php
declare(strict_types=1);

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait IdTrait
 */
trait IdTrait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", unique=true)
     */
    private $id;

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}

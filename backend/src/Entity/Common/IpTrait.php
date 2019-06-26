<?php
declare(strict_types=1);

namespace App\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait IpTrait
 */
trait IpTrait
{
    /**
     * @var null|string
     * @ORM\Column(type="string")
     */
    private $ip;

    /**
     * @return null|string
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param null|string $ip
     */
    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }
}

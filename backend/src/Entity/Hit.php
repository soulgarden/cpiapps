<?php
declare(strict_types=1);

namespace App\Entity;

use App\Entity\Common\AgentTrait;
use App\Entity\Common\IpTrait;
use App\Entity\Common\UuidTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HitRepository")
 */
class Hit
{
    use UuidTrait;
    use AgentTrait;
    use IpTrait;
    use TimestampableEntity;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\Stream", inversedBy="hits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stream;

    /**
     * Hit constructor.
     *
     * @param Stream      $stream
     * @param string      $agent
     * @param string      $uuid
     * @param null|string $ip
     */
    public function __construct(Stream $stream, string $agent, string $uuid, ?string $ip = null)
    {
        $this->stream = $stream;
        $this->agent = $agent;
        $this->uuid = $uuid;
        $this->ip = $ip;
    }

    /**
     * @return Stream
     */
    public function getStream(): Stream
    {
        return $this->stream;
    }

    /**
     * @param Stream $stream
     *
     * @return Hit
     */
    public function setStream(Stream $stream): self
    {
        $this->stream = $stream;

        return $this;
    }
}

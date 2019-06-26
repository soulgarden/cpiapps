<?php
declare(strict_types=1);

namespace App\Entity;

use App\Dictionary\LeadStatusDictionary;
use App\Entity\Common\AgentTrait;
use App\Entity\Common\IdTrait;
use App\Entity\Common\LeadStatusTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeadRepository")
 */
class Lead
{
    use IdTrait;
    use AgentTrait;
    use LeadStatusTrait;
    use TimestampableEntity;

    /**
     * @var Stream
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\Stream", inversedBy="leads")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stream;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(type="guid")
     * @Assert\Uuid(strict=true)
     */
    private $hostUuid;

    /**
     * Lead constructor.
     *
     * @param Stream $stream
     * @param string $agent
     * @param string $hostUuid
     */
    public function __construct(Stream $stream, string $agent, string $hostUuid)
    {
        $this->stream = $stream;
        $this->agent = $agent;
        $this->hostUuid = $hostUuid;
        $this->status = LeadStatusDictionary::STATUS_APPROVED;
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
     * @return Lead
     */
    public function setStream(Stream $stream): self
    {
        $this->stream = $stream;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getHostUuid(): string
    {
        return $this->hostUuid;
    }

    /**
     * @param string $hostUuid
     */
    public function setHostUuid(string $hostUuid): void
    {
        $this->hostUuid = $hostUuid;
    }
}

<?php
declare(strict_types=1);

namespace App\Entity\Common;

use App\Dictionary\LeadStatusDictionary;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait StatusTrait
 */
trait LeadStatusTrait
{
    /**
     * @var string
     * @Assert\Choice({LeadStatusDictionary::STATUS_APPROVED, LeadStatusDictionary::STATUS_CANCELLED})
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
     *
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}

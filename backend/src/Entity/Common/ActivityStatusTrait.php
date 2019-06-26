<?php
declare(strict_types=1);

namespace App\Entity\Common;

use App\Dictionary\ActivityStatusDictionary;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait ActivityStatusTrait
 */
trait ActivityStatusTrait
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Choice(choices={ActivityStatusDictionary::STATUS_ACTIVE, ActivityStatusDictionary::STATUS_INACTIVE})
     * @ORM\Column(type="string")
     */
    private $status = ActivityStatusDictionary::STATUS_ACTIVE;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param null|string $status
     *
     * @return self
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}

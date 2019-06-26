<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Stream;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class StreamManager
 */
class StreamManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * StreamService constructor.
     *
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->objectManager = $managerRegistry->getManager();
    }

    /**
     * @return Stream[]
     */
    public function getStreams(): array
    {
        return $this->objectManager->getRepository(Stream::class)->findAll();
    }

    /**
     * @param Stream $offer
     */
    public function updateStream(Stream $offer): void
    {
        $this->objectManager->persist($offer);
        $this->objectManager->flush();
    }

    /**
     * @param Stream $offer
     */
    public function removeStream(Stream $offer): void
    {
        $this->objectManager->remove($offer);
        $this->objectManager->flush();
    }
}

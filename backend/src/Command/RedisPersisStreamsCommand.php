<?php

namespace App\Command;

use App\Repository\StreamRepository;
use Predis\ClientInterface;
use Psr\Log\LoggerInterface;
use Snc\RedisBundle\Client\Phpredis\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RedisPersisStreamsCommand
 * @package App\Command
 */
class RedisPersisStreamsCommand extends Command
{
    /**
     * @var StreamRepository
     */
    private $streamRepository;

    /**
     * @var Client
     */
    private $redisClient;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * RedisPersisStreamsCommand constructor.
     * @param null|string      $name
     * @param StreamRepository $streamRepository
     * @param ClientInterface  $redisClient
     * @param LoggerInterface  $logger
     */
    public function __construct(
        ?string $name = null,
        StreamRepository $streamRepository,
        ClientInterface $redisClient,
        LoggerInterface $logger
    ) {
        parent::__construct($name);

        $this->streamRepository = $streamRepository;
        $this->redisClient = $redisClient;
        $this->logger = $logger;
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setName('app:redis-persis-streams')
            ->setDescription('Persist streams into redis');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $streams = $this->streamRepository->findAllByActive();
        foreach ($streams as $stream) {
            $this->redisClient->set('stream:' . $stream->getUuid(), $stream->getLink());
        }

        $processedCount = \count($streams);

        $this->logger->info("Processed {$processedCount} streams");
    }
}

<?php
declare(strict_types=1);

namespace App\Consumer;

use App\Entity\Lead;
use App\Entity\Stream;
use App\Exception\InvalidFormatException;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use OldSound\RabbitMqBundle\RabbitMq\BatchConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

/**
 * Class LeadConsumer
 */
class LeadConsumer implements BatchConsumerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * LeadConsumer constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param LoggerInterface        $logger
     */
    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @param AMQPMessage[] $messages
     *
     * @throws ConnectionException
     *
     * @return bool
     */
    public function batchExecute(array $messages): bool
    {
        $this->entityManager->getConnection()->beginTransaction();

        try {
            foreach ($messages as $message) {
                try {
                    $lead = $this->extractLeadFromMessage($message);
                    $this->entityManager->persist($lead);
                } catch (InvalidFormatException $e) {
                    $this->logger->critical($e->getMessage(), ['rawMessage' => $message->getBody()]);
                }
            }
            $this->entityManager->flush();
        } catch (Exception $e) {
            $this->logger->critical('Error with processing leads: '.$e->getMessage());
            $this->entityManager->getConnection()->rollBack();

            return false;
        }

        $this->entityManager->getConnection()->commit();

        return true;
    }

    /**
     * @param AMQPMessage $message
     *
     * @return Lead
     */
    private function extractLeadFromMessage(AMQPMessage $message): Lead
    {
        $decodedMessage = json_decode($message->getBody(), true);

        if ($decodedMessage && $this->validateMessage($decodedMessage)) {
            $stream = $this->entityManager->getRepository(Stream::class)->findOneBy(
                ['uuid' => $decodedMessage['streamUuid']]
            );

            return new Lead($stream, $decodedMessage['agent'], $decodedMessage['hostUuid']);
        }

        throw new InvalidFormatException('Invalid message format');
    }

    /**
     * @param array $decodedMessage
     *
     * @return bool
     */
    private function validateMessage(array $decodedMessage): bool
    {
        return isset($decodedMessage['streamUuid'], $decodedMessage['hostUuid'])
            && \is_string($decodedMessage['agent']);
    }
}

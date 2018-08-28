<?php

namespace App\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\BatchConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class LeadConsumer
 * @package App\Consumer
 */
class LeadConsumer implements BatchConsumerInterface
{
    /**
     * @param AMQPMessage[] $messages
     * @return array|bool
     */
    public function batchExecute(array $messages)
    {
        foreach ($messages as $message) {
            var_dump($message);
        }

        // you ack all messages got in batch
        return true;
    }
}

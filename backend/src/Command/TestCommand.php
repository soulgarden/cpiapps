<?php

namespace App\Command;

use App\Entity\Offer;
use App\Entity\Stream;
use App\Message\Lead;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'app:test';
    /**
     * @var MessageBus
     */
    private $messageBus;

    /**
     * TestCommand constructor.
     * @param null|string         $name
     * @param MessageBusInterface $messageBus
     */
    public function __construct(?string $name = null, MessageBusInterface $messageBus)
    {
        parent::__construct($name);

        $this->messageBus = $messageBus;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $offer = new Offer();
        $offer->setName('name');
        $offer->setLink('dd');

        $stream = new Stream();
        $stream->setLink('link');

        $lead = new Lead();
        $lead->setAgent('agent');
        $lead->setIp('127.0.0.1');
        $lead->setReferrer('referrer');
        $lead->setStream('stream');

//        $this->messageBus->dispatch($offer);
//        $this->messageBus->dispatch($stream);
        $this->messageBus->dispatch($lead);
    }
}

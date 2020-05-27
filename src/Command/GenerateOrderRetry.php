<?php


namespace App\Command;

use App\Service\OrderManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderRetry extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:order-retry';
    /**
     * @var OrderManager
     */
    private $orderManager;


    public function __construct(OrderManager $orderManager)
    {
        parent::__construct();

        $this->orderManager = $orderManager;
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Process new request');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->orderManager->consumeFailedOrder();

        return 0;
    }
}

<?php


namespace App\Command;


use App\Service\OrderManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateOrderRequest extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:generate-order-request';

    private $orderManager;

    public function __construct(OrderManager $orderManager)
    {
        $this->orderManager = $orderManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Process waiting orders');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

       $this->orderManager->consumeWaitingOrder();

        return 0;
    }
}

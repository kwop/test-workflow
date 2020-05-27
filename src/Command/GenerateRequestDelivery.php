<?php


namespace App\Command;

use App\Service\RequestManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateRequestDelivery extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:generate-request-delivery';
    /**
     * @var RequestManager
     */
    private $requestManager;



    public function __construct(RequestManager $requestManager)
    {
        parent::__construct();
        $this->requestManager = $requestManager;
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Process new request');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->requestManager->consumeNewRequest();

        return 0;
    }
}

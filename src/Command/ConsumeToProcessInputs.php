<?php


namespace App\Command;


use App\Service\InputManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsumeToProcessInputs extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:generate-order-from-input';

    private $inputManager;

    public function __construct(InputManager $inputManager)
    {
        $this->inputManager = $inputManager;

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

        $this->inputManager->consumeToProcessInputs();

        return 0;
    }
}

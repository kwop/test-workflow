<?php


namespace App\Command;


use App\Service\NotificationManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsumeNewNotifications extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:consume-new-notifications';
    /**
     * @var NotificationManager
     */
    private $notificationManager;


    public function __construct(NotificationManager $notificationManager)
    {

        parent::__construct();
        $this->notificationManager = $notificationManager;
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('update order status');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->notificationManager->consumeNewNotifications();

        return 0;
    }
}

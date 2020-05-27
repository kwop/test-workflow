<?php


namespace App\Service;


use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\StateMachine;

class NotificationManager
{
    private $stateMachine;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(StateMachine $stateMachine, EntityManagerInterface $em)
    {
        $this->stateMachine = $stateMachine;
        $this->em = $em;
    }

    public function consumeNewNotifications()
    {
        $notificationsList = [];

        foreach ($notificationsList as $notification) {
            // async ?
            $this->inProgress($notification);
        }

    }

    public function new(Notification $notification)
    {
        $this->stateMachine->apply($notification, 'new', [
            'log_comment' => 'notification created',
        ]);
    }


    public function inProgress(Notification $notification)
    {
        try {
            $this->stateMachine->apply($notification, 'in_progress', [
                'log_comment' => 'Processing notification',
            ]);

            // traitement
            // done peut aussi etre trigger depuis les events

            $this->done($notification);
        } catch (\Exception $exception) {
            $this->error($notification, $exception);
        }

    }

    public function done(Notification $notification)
    {
        $this->stateMachine->apply($notification, 'done', [
            'log_comment' => 'notification done',
        ]);
    }

    public function error(Notification $notification, \Exception $exception)
    {
        $this->stateMachine->apply($notification, 'error', [
            'log_comment' => sprintf('notification processing error %s', $exception->getMessage()),
        ]);
    }

}


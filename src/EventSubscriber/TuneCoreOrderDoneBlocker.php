<?php


namespace App\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\GuardEvent;


class TuneCoreOrderDoneBlocker implements EventSubscriberInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function beforeDone(GuardEvent $event)
    {
        if ($event->getSubject()->getOrigin() === 'tunecore') {

            // check if all request are done for a tunecore order
            // if not, block the done transition
            $isAllRequestPassed = false;

            // Block the transition "publish" if it is more than 8 PM
            // with the message for end user
            // $explanation = $event->getMetadata('explanation', $eventTransition);
            $event->setBlocked(true);
            //$event->addTransitionBlocker(new TransitionBlocker('tunecore offer processing blocked' , 0));
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.order.to_process.enter' => 'beforeDone',
        ];
    }
}

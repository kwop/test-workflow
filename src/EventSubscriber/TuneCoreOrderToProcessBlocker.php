<?php


namespace App\EventSubscriber;

use App\Service\OrderManager;
use \Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\Event\GuardEvent;

class TuneCoreOrderToProcessBlocker implements EventSubscriberInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var OrderManager
     */
    private $orderManager;

    public function __construct(EntityManagerInterface $em, OrderManager $orderManager)
    {
        $this->em = $em;
        $this->orderManager = $orderManager;
    }


    public function beforeToProcess(GuardEvent $event)
    {
        if ($event->getSubject()->getOrigin() === 'tunecore') {

            // get older versions IF not in database
            // create orders
            $missingOrderList = [];

            foreach ($missingOrderList as $missingOrder) {
                $this->orderManager->waiting($missingOrder);
            }

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
            'workflow.order.to_process.enter' => 'beforeToProcess',
        ];
    }
}

<?php

namespace App\Service;


use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\StateMachine;

class OrderManager
{
    private $stateMachine;
    /**
     * @var RequestManager
     */
    private $requestManager;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(StateMachine $stateMachine, EntityManagerInterface $em)
    {
        $this->stateMachine = $stateMachine;

        $this->em = $em;
    }

    public function consumeWaitingOrders()
    {
        $orderList = [];

        foreach ($orderList as $order) {
            // async ?
            $this->toProcess($order);
        }

    }

    public function waiting(Order $order)
    {
        $this->stateMachine->apply($order, 'waiting', [
            'log_comment' => 'request waiting',
        ]);
    }


    public function toProcess(Order $order)
    {
        try {

            $this->stateMachine->apply($order, 'in_progress', [
                'log_comment' => 'Processing offer',
            ]);

            // traitement
            // done peut aussi etre trigger depuis les events

            $this->done($order);

        } catch (\Exception $exception) {
            $this->error($order, $exception);
        }
    }


    public function done(Order $order)
    {

        $this->stateMachine->apply($order, 'done', [
            'log_comment' => 'request done',
        ]);


    }

    public function error(Order $order, \Exception $exception)
    {
        $this->stateMachine->apply($order, 'error', [
            'log_comment' => sprintf('order processing error %s', $exception->getMessage()),
        ]);
    }

    public function consumeFailedOrder()
    {
        $failedOrderList = [];
        foreach ($failedOrderList as $order) {
            // async ?
            $this->waiting($order);
        }
    }

}


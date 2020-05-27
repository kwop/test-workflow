<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\StateMachine;

class InputManager
{
    private $stateMachine;

    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var OrderManager
     */
    private $orderManager;

    public function __construct(StateMachine $stateMachine, EntityManagerInterface $em, OrderManager $orderManager)
    {
        $this->stateMachine = $stateMachine;
        $this->em = $em;
        $this->orderManager = $orderManager;
    }

    public function consumeInputs()
    {
        $inputList = [];

        foreach ($inputList as $input) {

            $orderList = [];
            foreach ($orderList as $order) {
                // async ?
                $this->orderManager->waiting($order);
            }
        }

    }

}


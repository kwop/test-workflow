<?php

namespace App\Service;

use App\Entity\Input;
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

    public function __construct(StateMachine $stateMachine, OrderManager $orderManager, EntityManagerInterface $em)
    {
        $this->stateMachine = $stateMachine;
        $this->em = $em;
        $this->orderManager = $orderManager;
    }

    public function toProcess(Input $input)
    {

        try {
            $this->stateMachine->apply($input, 'to_process', [
                'log_comment' => 'input going to be processed',
            ]);

            // traitement
            // done peut aussi etre trigger depuis les events

            $this->done($input);
        } catch (\Exception $exception) {
            $this->error($input, $exception);
        }

    }

    public function done(Input $input)
    {
        $this->stateMachine->apply($input, 'done', [
            'log_comment' => 'input create order ok',
        ]);
    }


    public function error(Input $input)
    {
        $this->stateMachine->apply($input, 'error', [
            'log_comment' => 'input cant create order',
        ]);
    }

    public function consumeToProcessInputs()
    {
        // Select input to process
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


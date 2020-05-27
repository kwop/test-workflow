<?php


namespace App\Service;


use App\Entity\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\StateMachine;

class RequestManager
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

    public function consumeNewRequest()
    {
        $requestList = [];

        foreach ($requestList as $request) {
            // async ?
            $this->inProgress($request);
        }

    }

    public function new(Request $request)
    {
        $this->stateMachine->apply($request, 'new', [
            'log_comment' => 'Create a request',
        ]);
    }


    public function inProgress(Request $request)
    {
        try {
            $this->stateMachine->apply($request, 'in_progress', [
                'log_comment' => 'Processing request',
            ]);

            // traitement
            // done peut aussi etre trigger depuis les events

            $this->done($request);

        } catch (\Exception $exception) {
            $this->error($request, $exception);
        }

    }

    public function done(Request $request)
    {
        $this->stateMachine->apply($request, 'done', [
            'log_comment' => 'request done',
        ]);
    }

    public function error(Request $request, \Exception $exception)
    {
        $this->stateMachine->apply($request, 'error', [
            'log_comment' => sprintf('request processing error %s', $exception->getMessage()),
        ]);
    }

    public function consumeFailedRequest()
    {
        $failedRequestList = [];
        foreach ($failedRequestList as $request) {
            // async ?
            $this->new($request);
        }
    }
}


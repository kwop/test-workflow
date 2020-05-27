<?php

namespace App\Controller;

use App\Entity\Request;
use App\Service\RequestManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestController extends AbstractController
{
    /**
     * @Route("/delivery/request/notify", name="delivery_request_notify")
     * @param RequestManager $requestManager
     */
    public function deliveryRequestNotify(RequestManager $requestManager)
    {
        // Creation de l'order mise en Place waiting
        $request = new Request();
        $requestManager->done($request);

        return new Response();
    }
}

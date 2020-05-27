<?php

namespace App\Controller;

use App\Entity\Order;
use App\Service\OrderManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/delivery/order/create", name="delivery_order_create")
     * @param OrderManager $orderManager
     */
    public function deliveryOrderCreate(OrderManager $orderManager)
    {
        // Creation de l'order mise en Place waiting
        $order = new Order();
        $orderManager->waiting($order);

        return new Response();
    }
}

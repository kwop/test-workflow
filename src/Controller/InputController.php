<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InputController extends AbstractController
{
    /**
     * @Route("/delivery/input/create", name="delivery_input_create")
     */
    public function deliveryInputCreate(EntityManager $entityManager)
    {
        // CREATE INPUT


        return new Response();
    }
}

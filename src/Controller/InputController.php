<?php

namespace App\Controller;

use App\Entity\Input;
use App\Service\InputManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InputController extends AbstractController
{
    /**
     * @Route("/delivery/input/create", name="delivery_input_create")
     * @param EntityManager $entityManager
     * @param InputManager $inputManager
     * @return Response
     */
    public function deliveryInputCreate(EntityManager $entityManager, InputManager $inputManager)
    {
        // CREATE INPUT in database

        $input = Input();
        $inputManager->toProcess($input);

        return new Response();
    }
}

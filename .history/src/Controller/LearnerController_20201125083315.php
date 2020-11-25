<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LearnerController extends AbstractController
{
    /**
     * @Route("/learner", name="learner")
     */
    public function index(): Response
    {
        return $this->render('learner/index.html.twig', [
            'controller_name' => 'LearnerController',
        ]);
    }
}

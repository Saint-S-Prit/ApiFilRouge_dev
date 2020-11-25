<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LearnerController extends AbstractController
{
    /**
     * @Route(
     *     path={"/api/admin/Learner"},
     *     methods={"POST"},
     * )
     */

    public function addUser(Request $request)
    {
        $learner = $this->userSrv->addUserService($request, "App\Entity\Learner", "LEARNER");
        $this->manager->persist($learner);
        $this->manager->flush();
        return new JsonResponse('CM create.', Response::HTTP_OK, [], true);
    }
}

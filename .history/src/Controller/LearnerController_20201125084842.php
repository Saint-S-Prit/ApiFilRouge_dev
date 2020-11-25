<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
        $cm = $this->userSrv->addUserService($request, "App\Entity\Learner", "CM");
        $this->manager->persist($cm);
        $this->manager->flush();
        return new JsonResponse('CM create.', Response::HTTP_OK, [], true);
    }
}

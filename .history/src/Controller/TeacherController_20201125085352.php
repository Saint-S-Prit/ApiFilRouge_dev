<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeacherController extends AbstractController
{
    /**
     * @Route(
     *     path={"/api/admin/Teacher"},
     *     methods={"POST"},
     * )
     */

    public function addUser(Request $request)
    {
        $learner = $this->userSrv->addUserService($request, "App\Entity\Teacher", "TEACHER");
        $this->manager->persist($learner);
        $this->manager->flush();
        return new JsonResponse('TEACHER create.', Response::HTTP_OK, [], true);
    }
}

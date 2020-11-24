<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route(
     *     path={"/api/admin/apprenants"},
     *     methods={"POST"},
     * )
     */
    public function addUser(Request $request)
    {
        $user = $this->userSrv->addUserSrv($request, "App\Entity\Apprenant", "APPRENANT");
        $this->manager->persist($user);
        $this->manager->flush();
        return new JsonResponse('Un apprenant a été crée.', Response::HTTP_OK, [], true);
    }
}

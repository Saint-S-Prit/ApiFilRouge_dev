<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route(
     *     path={"/api/admin/Admin"},
     *     methods={"POST"},
     * )
     */
    public function addUser(Request $request)
    {
        $admin = $this->userSrv->addUserSrv($request, "App\Entity\Admin", "ADMIN");
        $this->manager->persist($admin);
        $this->manager->flush();
        return new JsonResponse('Un apprenant a été crée.', Response::HTTP_OK, [], true);
    }
}

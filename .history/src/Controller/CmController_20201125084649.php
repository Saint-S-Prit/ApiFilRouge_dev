<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CmController extends AbstractController
{
    /**
     * @Route(
     *     path={"/api/admin/Admin"},
     *     methods={"POST"},
     * )
     */

    public function addUser(Request $request)
    {
        $admin = $this->userSrv->addUserService($request, "App\Entity\Admin", "ADMIN");
        $this->manager->persist($admin);
        $this->manager->flush();
        return new JsonResponse('Un apprenant a été crée.', Response::HTTP_OK, [], true);
    }
}

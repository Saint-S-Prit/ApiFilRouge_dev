<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CmController extends AbstractController
{
    /**
     * @Route(
     *     path={"/api/admin/Cm"},
     *     methods={"POST"},
     * )
     */

    public function addUser(Request $request)
    {
        $admin = $this->userSrv->addUserService($request, "App\Entity\Cm", "CM");
        $this->manager->persist($admin);
        $this->manager->flush();
        return new JsonResponse('CM create.', Response::HTTP_OK, [], true);
    }
}

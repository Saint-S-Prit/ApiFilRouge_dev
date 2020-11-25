<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $user = $this->userSrv->addUserSrv($request, "App\Entity\Learner", "LEARNER");
        $this->manager->persist($user);
        $this->manager->flush();
        return new JsonResponse('Un apprenant a été crée.', Response::HTTP_OK, [], true);
    }
}

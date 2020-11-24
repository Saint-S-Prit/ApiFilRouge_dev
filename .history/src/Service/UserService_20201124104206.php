<?php


namespace App\Service;


use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserService
{
    private $encoder;
    private $serializer;
    private $validator;
    private $profile_R;



    public function __construct(UserPasswordEncoderInterface $encoder, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $manager, ProfilRepository $profil_R)
    {
        $this->encoder = $encoder;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->manager = $manager;
        $this->profil_R = $profil_R;
        //$this->notifMail = $notifMail;
    }

    public function addUser($request, $type, $entity)
    {

        $user = $request->request->all();
        $profile = $this->profile_R->findBy(["Libelle" => $type]);

        //$avatar = $request->files->get("Avatar");
        //if ($avatar) {
        //   $avatar = fopen($avatar->getRealPath(), "rb");
        //   $user["Avatar"] = $avatar;
        //}


        $user = $this->serializer->denormalize($user, $entity);

        $errors = $this->validator->validate($user);
        if ($errors) {
            $errors = $this->serializer->serialize($errors, "json");
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST, [], true);
        }
        //dd($profil);
        $user->setProfil($profile[0]);

        $password = $user->getPassword();
        $user->setPassword($this->encoder->encodePassword($user, $password));
        //dd($user);
        //fclose($avatar);
        return $user;
    }



    public function EditUser($request, $type, $entity, $id = null)
    {

        $user = $request->request->all();
        $profile = $this->profile_R->findBy(["Libelle" => $type]);
        $avatar = $request->files->get("Avatar");
        //if ($avatar) {
        //    $avatar = fopen($avatar->getRealPath(), "rb");
        //    $user["Avatar"] = $avatar;
        //}
        $user = $this->serializer->denormalize($user, $entity);
        $errors = $this->validator->validate($user);
        if ($errors) {
            $errors = $this->serializer->serialize($errors, "json");
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST, [], true);
        }
        $user->setProfil($profile[0]);

        $password = $user->getPassword();
        $user->setPassword($this->encoder->encodePassword($user, $password));
        return $user;
    }
}

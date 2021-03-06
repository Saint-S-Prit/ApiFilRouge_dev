<?php


namespace App\Service;


use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    private $encoder;
    private $serializer;
    private $validator;
    private $profile;



    public function __construct(UserPasswordEncoderInterface $encoder, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $manager, ProfileRepository $profile)
    {
        $this->encoder = $encoder;
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->manager = $manager;
        $this->profile = $profile;
    }

    public function addUserService($request, $type, $entity)
    {

        $user = $request->request->all();
        $profile = $this->profile->findBy(["Libelle" => $type]);

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

        return $user;
    }



    public function EditUser($request, $type, $entity, $id = null)
    {

        $user = $request->request->all();
        $profile = $this->profile->findBy(["Libelle" => $type]);
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

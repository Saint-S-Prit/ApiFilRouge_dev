<?php

namespace App\DataPersisters;

use App\Entity\Profile;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class ProfileDatapersiste implements ContextAwareDataPersisterInterface
{
    private $manager;

    private $userRepository;

    public function __construct(EntityManagerInterface $manager, UserRepository  $userRepository)
    {
        $this->manager = $manager;
        $this->userRepository = $userRepository;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Profile;
    }

    public function persist($data, array $context = [])
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $data->setIsDeleted(true);
        $id = $data->getId();
        $users = $this->userRepository->findBy(['profile' => $id]);
        if ($users) {
            foreach ($users as $user) {
                $user->setIsDeleted(true);
                $this->manager->flush();
            }
        }
        $this->entityManager->flush();
    }
}

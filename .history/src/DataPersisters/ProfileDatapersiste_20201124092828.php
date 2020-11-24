<?php

namespace App\DataPersisters;

use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Profile;

final class ProfileDatapersiste implements ContextAwareDataPersisterInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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
        $users = $this->userRepository->findBy(['profil' => $id]);
        if ($users) {
            foreach ($users as $user) {
                $user->setArchiver(true);
                $this->manager->flush();
            }
        }
        $this->entityManager->flush();
    }
}

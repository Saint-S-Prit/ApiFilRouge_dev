<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TeacherRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=TeacherRepository::class)
 * @ApiResource(
 *  collectionOperations=
 * {
 *      "get"=
 *      {
 *           "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_TEACHER'))"
 *      }
 * },
 * )
 */
class Teacher extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}

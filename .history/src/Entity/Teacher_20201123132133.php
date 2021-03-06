<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TeacherRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TeacherRepository::class)
 * @ApiResource(
 * 
 *  collectionOperations=
 *      {
 *          "get"={"access_control"="is_granted('ROLE_ADMIN')","security_message"="Only admins can access."},
 *          "post"={"access_control"="is_granted('ROLE_ADMIN')","security_message"="Only admins can access."}
 *      },
 * itemOperations=
 *      {
 *         "get"={"security"="is_granted('ROLE_ADMIN') or is_granted('ROLE_TEACHER') ","security_message"="Only admins  and teachers can access."},
 *         "put"={"security"="is_granted('ROLE_ADMIN') or  is_granted('ROLE_TEACHER')","security_message"="Only admins  and teachers can access."},
 *     },
 * normalizationContext={"groups"={"teacher_read"}}
 * )
 */
class Teacher extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * Groups={"teacher_read"}
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}

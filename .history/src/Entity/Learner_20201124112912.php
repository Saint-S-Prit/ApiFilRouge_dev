<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LearnerRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LearnerRepository::class)
 * @ApiResource(
 *collectionOperations=
 *      {
 *         "post"={"security"="is_granted('ROLE_ADMIN') or  is_granted('ROLE_TEACHER')","security_message"="Only admins  and teachers can access."},
 *          "get"={"security"="is_granted('ROLE_ADMIN') or  is_granted('ROLE_TEACHER') or  is_granted('ROLE_CM') ","security_message"="Only admins , teachers and learner can access."},
 *     },
 *itemOperations=
 *      {
 *         "get"={"security"="is_granted('ROLE_ADMIN') or  is_granted('ROLE_TEACHER') or  is_granted('ROLE_LEARNER')","security_message"="Only admins  and teachers can access."},
 *         "put"={"security"="is_granted('ROLE_ADMIN') or  is_granted('ROLE_TEACHER')","security_message"="Only admins  and teachers can access."},
 *          "delete"={"security"="is_granted('ROLE_ADMIN') or  is_granted('ROLE_TEACHER')","security_message"="Only admins  and teachers can access."},
 *     },
 * normalizationContext={"groups"={"learner_read"}}
 * )
 */
class Learner  extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user_read","learner_read"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read","learner_read"})
     * @Assert\Choice(choices={"deaded", "abandoned", "sick", "suspended"}, message="the status must be  deaded, abandoned, sick, suspended ")
     */
    private $status;



    public function getId(): ?int
    {
        return $this->id;
    }



    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}

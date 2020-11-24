<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LearnerRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LearnerRepository::class)
 * @ApiResource(
 * collectionOperations=
 * {
 *      "get"=
 *      {
 *           "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_TEACHER'))"
 *      }
 * },
 * itemOperations=
 * {
 *      "get"=
 *      {
 *           "access_control"="(is_granted('ROLE_ADMIN') or is_granted('ROLE_TEACHER'))"
 *      }
 * },
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

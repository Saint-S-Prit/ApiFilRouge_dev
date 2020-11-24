<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LearnerRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LearnerRepository::class)
 * @ApiResource(
 * normalizationContext={"groups"={"profile_read"}}
 * )
 */
class Learner  extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read"})
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

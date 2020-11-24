<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LearnerRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=LearnerRepository::class)
 *@ApiResource
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
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

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

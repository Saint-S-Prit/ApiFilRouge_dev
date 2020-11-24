<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Repository\ProfileRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProfileRepository::class)
 * 
 *  @ApiResource(
 *  routePrefix="/admin",
 * attributes={"security"="is_granted('ROLE_ADMIN')",
 *                      "security_message"="Vous n'avez pas accés à cette ressource"
 * },
 * normalizationContext={"groups"={"profile_read"}}
 * )
 */
class Profile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profile_read"})
     * @AssertDoctrine\UniqueEntity("libelle")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="the libelle must be empty")
     * @Groups({"profile_read"})
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profile")
     * @ApiSubresource
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_deleted;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setProfile($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProfile() === $this) {
                $user->setProfile(null);
            }
        }

        return $this;
    }

    public function getIdDeleted(): ?string
    {
        return $this->id_deleted;
    }

    public function setIdDeleted(string $id_deleted): self
    {
        $this->id_deleted = $id_deleted;

        return $this;
    }
}

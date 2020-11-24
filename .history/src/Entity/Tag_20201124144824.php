<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @UniqueEntity(
 *     fields={"libelle"},
 *     message="sorry this libelle exist."
 *     ),
 * @ApiResource(
 * routePrefix="/admin",
 * normalizationContext={"groups"={"tag_read",}},
 * attributes={"security"="is_granted('ROLE_ADMIN')", "security_message"="Only admins can access."},
 * collectionOperations=
 *      {
 *         "post"={"security"="is_granted('ROLE_ADMIN') or  is_granted('ROLE_TEACHER')","security_message"="Only admins  and teachers can access."},
 *         "get"={"security"="is_granted('ROLE_ADMIN') or  is_granted('ROLE_TEACHER')","security_message"="Only admins  and teachers can access."},
 *     },
 * itemOperations={
 *      "get",
 *        "put"={"security"="is_granted('ROLE_ADMIN') or  is_granted('ROLE_TEACHER')","security_message"="Only admins  and teachers can access."},
 *      
 * }
 * )
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="the libelle must be empty")
     * @Groups({"tag_read"})
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=GroupTag::class, inversedBy="tags")
     */
    private $groupe_tags;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    public function __construct()
    {
        $this->groupe_tags = new ArrayCollection();
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
     * @return Collection|GroupTag[]
     */
    public function getGroupeTags(): Collection
    {
        return $this->groupe_tags;
    }

    public function addGroupeTag(GroupTag $groupeTag): self
    {
        if (!$this->groupe_tags->contains($groupeTag)) {
            $this->groupe_tags[] = $groupeTag;
        }

        return $this;
    }

    public function removeGroupeTag(GroupTag $groupeTag): self
    {
        $this->groupe_tags->removeElement($groupeTag);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @ApiResource(
 * outePrefix="/admin",
 * normalizationContext={"groups"={"tag_read",}},
 * attributes={"security"="is_granted('ROLE_ADMIN')", "security_message"="Only admins can access."},
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

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupTagRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GroupTagRepository::class)
 * @ApiResource(
 * routePrefix="/admin",
 * normalizationContext={"groups"={"groupetags_read",}},
 * attributes={"security"="is_granted('ROLE_ADMIN'), is_granted('ROLE_TEACHER')", "security_message"="Only admins can access."},
 * )
 */
class GroupTag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"groupetags_read"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, mappedBy="groupe_tags")
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addGroupeTag($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeGroupeTag($this);
        }

        return $this;
    }
}

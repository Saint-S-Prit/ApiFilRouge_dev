<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, inversedBy="competences")
     */
    private $groupecompretence;

    public function __construct()
    {
        $this->groupecompretence = new ArrayCollection();
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
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupecompretence(): Collection
    {
        return $this->groupecompretence;
    }

    public function addGroupecompretence(GroupeCompetence $groupecompretence): self
    {
        if (!$this->groupecompretence->contains($groupecompretence)) {
            $this->groupecompretence[] = $groupecompretence;
        }

        return $this;
    }

    public function removeGroupecompretence(GroupeCompetence $groupecompretence): self
    {
        $this->groupecompretence->removeElement($groupecompretence);

        return $this;
    }
}

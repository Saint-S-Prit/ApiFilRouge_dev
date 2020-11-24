<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AdminRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 * @ORM\Table(name="`admin`")
 * @ApiResource(
 *  routePrefix="/admins",
 *  CollectionOperations={
 *     "get",
 *     "get_profiles"={
 *         "method"="GET",
 *         "path"="/profiles",
 *         "controller"=CreateBookPublication::class,
 *     }
 * },
 * normalizationContext={"groups"={"user:read"}}
 * )
 */
class Admin extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read"})
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}

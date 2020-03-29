<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypePostRepository")
 */
class TypePost
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libele;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Posts", mappedBy="typePost", orphanRemoval=true)
     */
    private $postes;

    public function __construct()
    {
        $this->postes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibele(): ?string
    {
        return $this->libele;
    }

    public function setLibele(string $libele): self
    {
        $this->libele = $libele;

        return $this;
    }

    /**
     * @return Collection|Posts[]
     */
    public function getPostes(): Collection
    {
        return $this->postes;
    }

    public function addPoste(Posts $poste): self
    {
        if (!$this->postes->contains($poste)) {
            $this->postes[] = $poste;
            $poste->setTypePost($this);
        }

        return $this;
    }

    public function removePoste(Posts $poste): self
    {
        if ($this->postes->contains($poste)) {
            $this->postes->removeElement($poste);
            // set the owning side to null (unless already changed)
            if ($poste->getTypePost() === $this) {
                $poste->setTypePost(null);
            }
        }

        return $this;
    }

}

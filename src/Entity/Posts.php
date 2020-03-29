<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostsRepository")
 */
class Posts
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
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_post;

    /**
     * @ORM\Column(type="text")
     */
    private $contents;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Students", inversedBy="postes")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePost", inversedBy="postes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typePost;


    public function __construct()
    {
        $this->date_post=new \DateTime();
        $this->user = new ArrayCollection();
        $this->typePost = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDatePost(): ?\DateTimeInterface
    {
        return $this->date_post;
    }

    public function setDatePost(\DateTimeInterface $date_post): self
    {
        $this->date_post = $date_post;

        return $this;
    }

    public function getContents(): ?string
    {
        return $this->contents;
    }

    public function setContents(string $contents): self
    {
        $this->contents = $contents;

        return $this;
    }

    public function getUser(): ?Students
    {
        return $this->user;
    }

    public function setUser(?Students $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTypePost(): ?TypePost
    {
        return $this->typePost;
    }

    public function setTypePost(?TypePost $typePost): self
    {
        $this->typePost = $typePost;

        return $this;
    }









}

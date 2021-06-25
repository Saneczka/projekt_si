<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Asserts;

/**
 * @ORM\Entity(repositoryClass=AlbumRepository::class)
 * @ORM\EntityListeners({"App\EntityListener\AlbumListener"})
 * @ORM\HasLifecycleCallbacks()
 */
class Album
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=600)
     */
    private $album_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $album_description;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $album_cover;

    /**
     * @ORM\GeneratedValue
     * @ORM\Column(type="datetime")
     */
    private $album_time_create;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="albums")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="album", orphanRemoval=true)
     */
    private $images;

    public function __construct()
    {
        $this->setAlbumTimeCreate(new \DateTime("now"));
        $this->images = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getAlbumName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlbumName(): ?string
    {
        return $this->album_name;
    }

    public function setAlbumName(string $album_name): self
    {
        $this->album_name = $album_name;

        return $this;
    }

    public function getAlbumDescription(): ?string
    {
        return $this->album_description;
    }

    public function setAlbumDescription(?string $album_description): self
    {
        $this->album_description = $album_description;

        return $this;
    }

    public function getAlbumCover(): ?string
    {
        return $this->album_cover;
    }

    public function setAlbumCover(?string $album_cover): self
    {
        $this->album_cover = $album_cover;

        return $this;
    }

    public function getAlbumTimeCreate(): ?\DateTimeInterface
    {
        return $this->album_time_create;
    }

    public function setAlbumTimeCreate(\DateTimeInterface $album_time_create): self
    {
        $this->album_time_create = $album_time_create;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAlbum($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAlbum() === $this) {
                $image->setAlbum(null);
            }
        }

        return $this;
    }

    public function getPrefixedCoverFileName(): ?string
    {
        return 'images/uploads/'.$this->getAlbumCover();
    }

}

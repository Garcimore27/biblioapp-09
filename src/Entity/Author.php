<?php

namespace App\Entity;

use App\Entity\Book;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        max: 30,
        minMessage: 'Votre prénom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Votre prénom ne doit pas dépasser {{ limit }} caractères',
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 2,
        max: 30,
        minMessage: 'Votre nom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Votre nom ne doit pas dépasser {{ limit }} caractères',
    )]
    private ?string $lastname = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Length(
        min: 4,
        max: 4,
        minMessage: '{{ limit }} chiffres',
        maxMessage: '{{ limit }} chiffres',
    )]
    #[Assert\Positive(
        message: 'Saisissez une année valide !',
    )]
    private ?int $year = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        min: 0,
        max: 1000,
        minMessage: 'Votre bio doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Votre bio ne doit pas dépasser {{ limit }} caractères',
    )]
    private ?string $bio = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Url(
        message: 'Saisissez une URL valide avec https:// !',
    )]
    private ?string $link = null;

    #[ORM\ManyToMany(targetEntity: Book::class, inversedBy: 'authors')]
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
        }

        return $this;
    }

    public function removeBook(Book $book): static
    {
        $this->books->removeElement($book);

        return $this;
    }

        //convertir en string
        public function __toString(): string
        {
            return $this->firstname . ' ' . $this->lastname;
        }

        public function getFullname(): ?string
    {
        return $this->getFirstname() . " " . $this->getLastname();
    }



}

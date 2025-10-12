<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'students')]
#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 16)]
    private string $firstname;

    #[ORM\Column(length: 16)]
    private string $surname;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $middlename;

    #[ORM\Column(name: 'birthday_date', type: 'date')]
    private \DateTime $birthdayDate;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private readonly \DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: 'datetime')]
    private \DateTime $updatedAt;

    public function __construct(
        int $id,
        string $firstname,
        string $surname,
        ?string $middlename,
        \DateTime $birthdayDate,
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->middlename = $middlename;
        $this->birthdayDate = $birthdayDate;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }

    public function setMiddlename(?string $middlename): void
    {
        $this->middlename = $middlename;
    }

    public function getBirthdayDate(): \DateTime
    {
        return $this->birthdayDate;
    }

    public function setBirthdayDate(\DateTime $birthdayDate): void
    {
        $this->birthdayDate = $birthdayDate;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}

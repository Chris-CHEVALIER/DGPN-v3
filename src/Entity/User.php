<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\UserGroup;
use App\Enum\UserType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ApiResource]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private string $firstName;

    #[ORM\Column]
    private string $lastName;

    #[ORM\Column]
    private string $email;

    #[ORM\Column(nullable: true)]
    private string $phoneNumber;

    #[ORM\Column(nullable: true)]
    private string $userGroup;

    #[ORM\Column]
    private string $userType;

    #[ORM\Column]
    private string $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Event::class)]
    private $events;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Log::class)]
    private $logs;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->logs = new ArrayCollection();
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return array($this->userType);
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserType(): string
    {
        return $this->userType;
    }

    public function setUserType($userType): self
    {
        if (!in_array($userType, [UserType::SUPERADMIN, UserType::ADMIN, UserType::FOURNISSEUR, UserType::UTILISATEUR])) {
            throw new \InvalidArgumentException('Invalid user type');
        }
        $this->userType = $userType;
        return $this;
    }

    public function getUserGroup(): string
    {
        return $this->userGroup;
    }

    public function setUserGroup($userGroup): self
    {
        if (!in_array($userGroup, [UserGroup::ZONE1, UserGroup::ZONE2, UserGroup::ZONE3, UserGroup::ZONE4, UserGroup::ZONE5, UserGroup::ZONE6, UserGroup::ZONE7, UserGroup::CRS, UserGroup::EGM])) {
            throw new \InvalidArgumentException('Invalid user group');
        }
        $this->userGroup = $userGroup;
        return $this;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName($lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function setEvents(Event $events): self
    {
        $this->events[] = $events;
        return $this;
    }

    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function setLogs(Log $logs): self
    {
        $this->logs[] = $logs;
        return $this;
    }
}

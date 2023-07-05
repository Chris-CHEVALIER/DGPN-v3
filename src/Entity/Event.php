<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\EventType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private int $id;

    #[ORM\Column]
    private string $type;

    #[ORM\Column(type: "datetime")]
    private \DateTime $startDate;

    #[ORM\Column(type: "datetime")]
    private \DateTime $endDate;

    #[ORM\OneToOne(mappedBy: 'event', targetEntity: Ticket::class)]
    private Ticket $ticket;

    #[ORM\OneToMany(mappedBy: "event", targetEntity: EventUnit::class)]
    private $eventUnits;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "events")]
    private User $user;

    #[ORM\OneToOne(mappedBy: "reassignFrom", targetEntity: EventUnit::class)]
    private EventUnit $eventUnit;

    public function __construct()
    {
        $this->eventUnits = new ArrayCollection();
    }

    public function getTicket(): Ticket
    {
        return $this->ticket;
    }

    public function setTicket($ticket): self
    {
        $this->ticket = $ticket;
        return $this;
    }

    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    public function setEndDate($endDate): self
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    public function setStartDate($startDate): self
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        if (!in_array($type, [EventType::TICKET, EventType::REPOS, EventType::FORMATION])) {
            throw new \InvalidArgumentException('Invalid event type');
        }
        $this->type = $type;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEventUnits(): Collection
    {
        return $this->eventUnits;
    }

    public function setEventUnits($eventUnits): self
    {
        $this->eventUnits[] = $eventUnits;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get the value of eventUnit
     */
    public function getEventUnit()
    {
        return $this->eventUnit;
    }

    /**
     * Set the value of eventUnit
     *
     * @return  self
     */
    public function setEventUnit($eventUnit)
    {
        $this->eventUnit = $eventUnit;

        return $this;
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\EventUnit;
use App\Entity\Log;
use App\Entity\Ticket;
use App\Entity\Unit;
use App\Entity\User;
use App\Enum\EventType;
use App\Enum\MissionType;
use App\Enum\TicketStatut;
use App\Enum\UnitType;
use App\Enum\UserGroup;
use App\Enum\UserType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use GMP;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasher $passwordHasher;

    /**
     * @param UserPasswordHasher $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1
            ->setFirstName("Arthur")
            ->setLastName("Remoussin")
            ->setEmail("superadmin@gmail.com")
            ->setPhoneNumber("0123456789")
            ->setUserGroup(UserGroup::ZONE1)
            ->setUserType(UserType::SUPERADMIN)
            ->setPassword($this->passwordHasher->hashPassword($user1, "superadmin"));

        $manager
            ->persist($user1);

        $user2 = new User();
        $user2
            ->setFirstName("Bilel")
            ->setLastName("Slaim")
            ->setEmail("admin@gmail.com")
            ->setPhoneNumber("0987654321")
            ->setUserGroup(UserGroup::ZONE6)
            ->setUserType(UserType::ADMIN)
            ->setPassword($this->passwordHasher->hashPassword($user2, "admin"));

        $manager
            ->persist($user2);

        $user3 = new User();
        $user3
            ->setFirstName("Jules")
            ->setLastName("Audebert")
            ->setEmail("fournisseur@gmail.com")
            ->setPhoneNumber("0678912345")
            ->setUserGroup(UserGroup::CRS)
            ->setUserType(UserType::FOURNISSEUR)
            ->setPassword($this->passwordHasher->hashPassword($user3, "fournisseur"));

        $manager
            ->persist($user3);

        $user4 = new User();
        $user4
            ->setFirstName("Patrick")
            ->setLastName("Gomes")
            ->setEmail("user@gmail.com")
            ->setPhoneNumber("0789123456")
            ->setUserGroup(UserGroup::ZONE7)
            ->setUserType(UserType::UTILISATEUR)
            ->setPassword($this->passwordHasher->hashPassword($user4, "user"));

        $manager
            ->persist($user4);

        $event1 = new Event();
        $event1
            ->setEndDate(new \DateTime)
            ->setStartDate(new \DateTime)
            ->setType(EventType::TICKET)
            ->setUser($user1);

        $manager
            ->persist($event1);

        $event2 = new Event();
        $event2
            ->setEndDate(new \DateTime)
            ->setStartDate(new \DateTime)
            ->setType(EventType::TICKET)
            ->setUser($user2);

        $manager
            ->persist($event2);

        $event3 = new Event();
        $event3
            ->setEndDate(new \DateTime)
            ->setStartDate(new \DateTime)
            ->setType(EventType::TICKET)
            ->setUser($user4);

        $manager
            ->persist($event3);

        $event4 = new Event();
        $event4
            ->setEndDate(new \DateTime)
            ->setStartDate(new \DateTime)
            ->setType(EventType::REPOS)
            ->setUser($user3);

        $manager
            ->persist($event4);

        $ticket1 = new Ticket();
        $ticket1
            ->setCity("Paris")
            ->setStatus(TicketStatut::ATTENTE)
            ->setMissionType(MissionType::MISSION_1)
            ->setUnitRequested(3)
            ->setCreatedAt(new \DateTime())
            ->setLastUpdate(new \DateTime())
            ->setDepartment("Paris")
            ->setDescription("Emeutes sur Paris.")
            ->setPostalCode(75001)
            ->setEvent($event1);
        $manager
            ->persist($ticket1);

        $ticket2 = new Ticket();
        $ticket2
            ->setCity("Vannes")
            ->setStatus(TicketStatut::AFFECTE)
            ->setMissionType(MissionType::MISSION_3)
            ->setUnitRequested(6)
            ->setCreatedAt(new \DateTime())
            ->setLastUpdate(new \DateTime())
            ->setDepartment("Bretagne")
            ->setDescription("Patrouille dans une fête foraine")
            ->setPostalCode(34000)
            ->setEvent($event2);
        $manager
            ->persist($ticket2);

        $ticket3 = new Ticket();
        $ticket3
            ->setCity("Strasbourg")
            ->setStatus(TicketStatut::REAFFECTE)
            ->setMissionType(MissionType::MISSION_5)
            ->setUnitRequested(10)
            ->setCreatedAt(new \DateTime())
            ->setLastUpdate(new \DateTime())
            ->setDepartment("Bas-Rhin")
            ->setDescription("Evenement sportif")
            ->setPostalCode(67000)
            ->setEvent($event3);
        $manager
            ->persist($ticket3);

        $log1 = new Log();
        $log1
            ->setAction("Modification du ticket")
            ->setDateHour(new \DateTime())
            ->setNewValue("75010")
            ->setOldValue("75011")
            ->setUser($user2);

        $manager
            ->persist($log1);

        $log2 = new Log();
        $log2
            ->setAction("Connexion")
            ->setDateHour(new \DateTime())
            ->setNewValue(NULL)
            ->setOldValue(NULL)
            ->setUser($user1);

        $manager
            ->persist($log2);

        $crs1 = new Unit();
        $crs1
            ->setName("CRS-1")
            ->setUnitType(UnitType::CRS);

        $manager
            ->persist($crs1);

        $crs2 = new Unit();
        $crs2
            ->setName("CRS-2")
            ->setUnitType(UnitType::CRS);

        $manager
            ->persist($crs2);

        $crs3 = new Unit();
        $crs3
            ->setName("CRS-3")
            ->setUnitType(UnitType::CRS);

        $manager
            ->persist($crs3);

        $crs4 = new Unit();
        $crs4
            ->setName("CRS-4")
            ->setUnitType(UnitType::CRS);

        $manager
            ->persist($crs4);

        $egm1 = new Unit();
        $egm1
            ->setName("EGM-1")
            ->setUnitType(UnitType::EGM);

        $manager
            ->persist($egm1);

        $egm2 = new Unit();
        $egm2
            ->setName("EGM-2")
            ->setUnitType(UnitType::EGM);

        $manager
            ->persist($egm2);

        $egm3 = new Unit();
        $egm3
            ->setName("EGM-3")
            ->setUnitType(UnitType::EGM);

        $manager
            ->persist($egm3);

        $egm4 = new Unit();
        $egm4
            ->setName("EGM-4")
            ->setUnitType(UnitType::EGM);

        $manager
            ->persist($egm4);

        $eventUnit1 = new EventUnit();
        $eventUnit1
            ->setEvent($event1)
            ->setUnit($crs1)
            ->setReassign(false);

        $manager
            ->persist($eventUnit1);

        $eventUnit2 = new EventUnit();
        $eventUnit2
            ->setEvent($event3)
            ->setUnit($crs4)
            ->setReassign(false)
            ->setReassignFrom($event2);

        $manager
            ->persist($eventUnit2);

        $eventUnit3 = new EventUnit();
        $eventUnit3
            ->setEvent($event2)
            ->setUnit($crs4)
            ->setReassign(true);

        $manager
            ->persist($eventUnit3);

        $eventUnit4 = new EventUnit();
        $eventUnit4
            ->setEvent($event4)
            ->setUnit($egm2)
            ->setReassign(false);

        $manager
            ->persist($eventUnit4);

        $manager
            ->flush();
    }
}
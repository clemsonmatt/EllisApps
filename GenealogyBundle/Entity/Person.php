<?php

namespace EllisApps\GenealogyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use EllisApps\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="genealogy_person")
 */
class Person
{
    use TimestampableTrait;

    public function __consturct()
    {
        $this->spouses = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="EllisApps\GenealogyBundle\Entity\Family", inversedBy="people")
     * @ORM\JoinColumn(name="family")
     */
    private $family;

    /**
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(name="middle_name", type="string", length=255, nullable=true)
     */
    private $middleName;

    /**
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\Column(name="birth_location", type="string", length=255, nullable=true)
     */
    private $birthLocation;

    /**
     * @ORM\Column(name="death_date", type="date", nullable=true)
     */
    private $deathDate;

    /**
     * @ORM\Column(name="death_location", type="string", length=255, nullable=true)
     */
    private $deathLocation;

    /**
     * @ORM\OneToMany(targetEntity="EllisApps\GenealogyBundle\Entity\Relationship", mappedBy="person")
     */
    private $relationships;

    /**
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(name="picture", type="string", nullable=true)
     */
    private $picture;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set family
     *
     * @param Family $family
     * @return Person
     */
    public function setFamily(\EllisApps\SharedBundle\Entity\Family $family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return Family
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     * @return Person
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Person
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthDate
     *
     * @param date $birthDate
     * @return Person
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return date
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set birthLocation
     *
     * @param string $birthLocation
     * @return Person
     */
    public function setBirthLocation($birthLocation)
    {
        $this->birthLocation = $birthLocation;

        return $this;
    }

    /**
     * Get birthLocation
     *
     * @return string
     */
    public function getBirthLocation()
    {
        return $this->birthLocation;
    }

    /**
     * Set deathDate
     *
     * @param date $deathDate
     * @return Person
     */
    public function setDeathDate($deathDate)
    {
        $this->deathDate = $deathDate;

        return $this;
    }

    /**
     * Get deathDate
     *
     * @return date
     */
    public function getDeathDate()
    {
        return $this->deathDate;
    }

    /**
     * Set deathLocation
     *
     * @param string $deathLocation
     * @return Person
     */
    public function setDeathLocation($deathLocation)
    {
        $this->deathLocation = $deathLocation;

        return $this;
    }

    /**
     * Get deathLocation
     *
     * @return string
     */
    public function getDeathLocation()
    {
        return $this->deathLocation;
    }

    /**
     * Set notes
     *
     * @param text $notes
     * @return Person
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return text
     */
    public function getNotes()
    {
        return $this->notes;
    }
}

<?php

namespace EllisApps\GenealogyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use EllisApps\GenealogyBundle\Entity\Person;
use EllisApps\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="genealogy_relationship")
 */
class Relationship
{
    use TimestampableTrait;

    public static function getRelationships($key = null)
    {
        $list = [
            'spouse'  => 'Spouse',
            'parent'  => 'Parent',
            'sibling' => 'Sibling',
        ];

        if ($key) {
            return $list[$key];
        }

        return $list;
    }


    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="EllisApps\GenealogyBundle\Entity\Person", inversedBy="relationships")
     * @ORM\JoinColumn(name="person_id")
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="EllisApps\GenealogyBundle\Entity\Person")
     * @ORM\JoinColumn(name="relative_id")
     */
    private $relative;

    /**
     * @ORM\Column(name="relationship", type="string", length=255)
     */
    private $relationship;

    /**
     * @ORM\Column(name="marriage_date", type="date")
     */
    private $marriageDate;

    /**
     * @ORM\Column(name="divorce_date", type="date", nullable=true)
     */
    private $divorceDate;

    /**
     * @ORM\Column(name="current_marriage", type="boolean")
     */
    private $currentMarriage;


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
     * Set person
     *
     * @param Person $person
     * @return Relationship
     */
    public function setPerson(Person $person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set relative
     *
     * @param Person $relative
     * @return Relationship
     */
    public function setRelative(Person $relative)
    {
        $this->relative = $relative;

        return $this;
    }

    /**
     * Get relative
     *
     * @return Person
     */
    public function getRelative()
    {
        return $this->relative;
    }

    /**
     * Set marriageDate
     *
     * @param date $marriageDate
     * @return Relationship
     */
    public function setMarriageDate($marriageDate)
    {
        $this->marriageDate = $marriageDate;

        return $this;
    }

    /**
     * Set relationship
     *
     * @param string $relationship
     * @return Relationship
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;

        return $this;
    }

    /**
     * Get relationship
     *
     * @return string
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * Get marriageDate
     *
     * @return date
     */
    public function getMarriageDate()
    {
        return $this->marriageDate;
    }

    /**
     * Set divorceDate
     *
     * @param date $divorceDate
     * @return Relationship
     */
    public function setDivorceDate($divorceDate)
    {
        $this->divorceDate = $divorceDate;

        return $this;
    }

    /**
     * Get divorceDate
     *
     * @return date
     */
    public function getDivorceDate()
    {
        return $this->divorceDate;
    }

    /**
     * Set currentMarriage
     *
     * @param boolean $currentMarriage
     * @return Relationship
     */
    public function setCurrentMarriage($currentMarriage)
    {
        $this->currentMarriage = $currentMarriage;

        return $this;
    }

    /**
     * Get currentMarriage
     *
     * @return boolean
     */
    public function getCurrentMarriage()
    {
        return $this->currentMarriage;
    }
}

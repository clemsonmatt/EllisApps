<?php

namespace EllisApps\HelpDeskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use EllisApps\HelpDeskBundle\Entity\StatusHistory;
use EllisApps\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="helpdesk_ticket")
 */
class Ticket
{
    use TimestampableTrait;

    public function __construct()
    {
        $this->statusHistory = new ArrayCollection();
    }

    public static function getCategoryList($key = null)
    {
        $categories = [
            'unspecified' => 'Unspecified',
        ];

        if ($key !== null) {
            return $categories[$key];
        }

        return $categories;
    }


    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="StatusHistory", mappedBy="ticket")
     */
    private $statusHistory;

    /**
     * @ORM\OneToOne(targetEntity="StatusHistory")
     */
    private $currentStatus;

    /**
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="person_name", type="string", length=255)
     */
    private $personName;

    /**
     * @ORM\Column(name="person_email", type="string", length=255)
     */
    private $personEmail;


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
     * Set statusHistory
     *
     * @param StatusHistory $statusHistory
     * @return Ticket
     */
    public function setStatusHistory($statusHistory)
    {
        $this->statusHistory = $statusHistory;

        return $this;
    }

    /**
     * Get statusHistory
     *
     * @return StatusHistory
     */
    public function getStatusHistory()
    {
        return $this->statusHistory;
    }

    /**
     * Set currentStatus
     *
     * @param StatusHistory $currentStatus
     * @return Ticket
     */
    public function setCurrentStatus(StatusHistory $currentStatus)
    {
        $this->currentStatus = $currentStatus;

        return $this;
    }

    /**
     * Get currentStatus
     *
     * @return StatusHistory
     */
    public function getCurrentStatus()
    {
        return $this->currentStatus;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Ticket
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Ticket
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Ticket
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return text
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set personName
     *
     * @param string $personName
     * @return Ticket
     */
    public function setPersonName($personName)
    {
        $this->personName = $personName;

        return $this;
    }

    /**
     * Get personName
     *
     * @return string
     */
    public function getPersonName()
    {
        return $this->personName;
    }

    /**
     * Set personEmail
     *
     * @param string $personEmail
     * @return Ticket
     */
    public function setPersonEmail($personEmail)
    {
        $this->personEmail = $personEmail;

        return $this;
    }

    /**
     * Get personEmail
     *
     * @return string
     */
    public function getPersonEmail()
    {
        return $this->personEmail;
    }
}

<?php

namespace EllisApps\HelpDeskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use EllisApps\HelpDeskBundle\Entity\Ticket;
use EllisApps\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="helpdesk_status_history")
 */
class StatusHistory
{
    use TimestampableTrait;

    /* check if ticket is open */
    public function isOpen()
    {
        if ($this->status == 'closed' || $this->status == 'complete') {
            return false;
        }

        return true;
    }

    /* get the background color */
    public function getBackgroundColor()
    {
        switch ($this->status) {
            case 'in review':
                return '#f1c40f';
                break;

            case 'complete':
                return '#27ae60';
                break;

            case 'closed':
                return '#c0392b';
                break;
        }

        if ($this->personName == 'Admin') {
            return '#e67e22';
        }

        return '#2980b9';
    }

    /* get label color */
    public function getLabelStatus()
    {
        $label = 'default';

        switch ($this->status) {
            case 'created':
                $label = 'info';
                break;

            case 'fixed':
                $label = 'primary';
                break;

            case 'no issue':
                $label = 'primary';
                break;

            case 'in review':
                $label = 'warning';
                break;

            case 'closed':
                $label = 'danger';
                break;

            case 'complete':
                $label = 'success';
                break;
        }

        return $label;
    }

    /* get person abbreviation */
    public function getPersonAbbr()
    {
        $names = explode(" ", $this->personName);

        $abbr = '';
        foreach ($names as $name) {
            $firstChar = substr($name, 0, 1);
            $abbr      = $abbr.''.$firstChar;
        }

        if ($this->personName == 'Admin') {
            return 'ME';
        }

        return $abbr;
    }


    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ticket", inversedBy="statusHistory")
     * @ORM\JoinColumn(name="ticket_id", referencedColumnName="id")
     */
    private $ticket;

    /**
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(name="status_date", type="datetime", length=255)
     */
    private $statusDate;

    /**
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @ORM\Column(name="person_name", type="string", length=255)
     */
    private $personName;

    /**
     * @ORM\Column(name="person_email", type="string", length=255)
     */
    private $personEmail;

    /**
     * @ORM\Column(name="internal", type="boolean")
     */
    private $internal = false;


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
     * Set ticket
     *
     * @param Ticket $ticket
     * @return StatusHistory
     */
    public function setTicket(Ticket $ticket)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Ticket
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set statusDate
     *
     * @param string $statusDate
     * @return Ticket
     */
    public function setStatusDate($statusDate)
    {
        $this->statusDate = $statusDate;

        return $this;
    }

    /**
     * Get statusDate
     *
     * @return string
     */
    public function getStatusDate()
    {
        return $this->statusDate;
    }

    /**
     * Set message
     *
     * @param text $message
     * @return StatusHistory
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return text
     */
    public function getMessage()
    {
        return $this->message;
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

    /**
     * Set internal
     *
     * @param boolean $internal
     * @return StatusHistory
     */
    public function setInternal($internal)
    {
        $this->internal = $internal;

        return $this;
    }

    /**
     * Get internal
     *
     * @return boolean
     */
    public function isInternal()
    {
        return $this->internal;
    }
}

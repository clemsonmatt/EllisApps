<?php

namespace EllisApps\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use EllisApps\CalendarBundle\Entity\Calendar;
use EllisApps\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="calendar_event")
 */
class Event
{
    use TimestampableTrait;

    public function __toString()
    {
        return $this->name;
    }

    public static function getRecurringList($key = null)
    {
        $recurringList = [
            'monthly' => 'Monthly',
            'weekly'  => 'Weekly',
        ];

        if ($key !== null) {
            return $recurringList[$key];
        }

        return $recurringList;
    }


    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Calendar", inversedBy="events")
     * @ORM\JoinColumn(name="calendar_id", referencedColumnName="id")
     **/
    private $calendar;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(name="location", type="text", nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(name="start_date", type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(name="end_date", type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(name="start_time", type="string", length=255)
     */
    private $startTime;

    /**
     * @ORM\Column(name="end_time", type="string", length=255)
     */
    private $endTime;

    /**
     * @ORM\Column(name="recurring", type="string", length=255, nullable=true)
     */
    private $recurring;

    /**
     * @ORM\Column(name="recurring_number", type="integer", nullable=true)
     */
    private $recurringNumber;


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
     * Set calendar
     *
     * @param Calendar $calendar
     * @return Event
     */
    public function setCalendar(Calendar $calendar)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get calendar
     *
     * @return Calendar
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set comments
     *
     * @param text $comments
     * @return Event
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return text
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set location
     *
     * @param text $location
     * @return Event
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return text
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set startDate
     *
     * @param date $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return date
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param date $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return date
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set startTime
     *
     * @param time $startTime
     * @return Event
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return time
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param time $endTime
     * @return Event
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return time
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set recurring
     *
     * @param string $recurring
     * @return Event
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;

        return $this;
    }

    /**
     * Get recurring
     *
     * @return string
     */
    public function getRecurring()
    {
        return $this->recurring;
    }

    /**
     * Set recurringNumber
     *
     * @param integer $recurringNumber
     * @return Event
     */
    public function setRecurringNumber($recurringNumber)
    {
        $this->recurringNumber = $recurringNumber;

        return $this;
    }

    /**
     * Get recurringNumber
     *
     * @return integer
     */
    public function getRecurringNumber()
    {
        return $this->recurringNumber;
    }
}

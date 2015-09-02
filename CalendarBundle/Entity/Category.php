<?php

namespace EllisApps\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use EllisApps\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="calendar_category")
 */
class Category
{
    use TimestampableTrait;

    public function __construct()
    {
        $this->calendars = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Calendar", mappedBy="category")
     */
    private $calendars;


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
     * Set name
     *
     * @param string $name
     * @return Category
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
     * Set calendars
     *
     * @param string $calendars
     * @return Category
     */
    public function setCalendars($calendars)
    {
        $this->calendars = $calendars;

        return $this;
    }

    /**
     * Get calendars
     *
     * @return string
     */
    public function getCalendars()
    {
        return $this->calendars;
    }
}

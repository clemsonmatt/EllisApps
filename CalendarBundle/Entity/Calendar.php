<?php

namespace EllisApps\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use EllisApps\CalendarBundle\Entity\Category;
use EllisApps\SharedBundle\Traits\TimestampableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="calendar")
 */
class Calendar
{
    use TimestampableTrait;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public static function getColorList($key = null)
    {
        $colorList = [
            '998086' => 'f9f0f6',
            '768099' => 'e6f0f9',
            '769883' => 'e6f8f3',
        ];

        if ($key !== null) {
            return $colorList[$key];
        }

        return $colorList;
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
     * @ORM\Column(name="abbr", type="string", length=255)
     */
    private $abbr;

    /**
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="calendars")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     **/
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="calendar")
     */
    private $events;


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
     * @return Calendar
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
     * Set abbr
     *
     * @param string $abbr
     * @return Calendar
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;

        return $this;
    }

    /**
     * Get abbr
     *
     * @return string
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Calendar
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set category
     *
     * @param Category $category
     * @return Calendar
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set events
     *
     * @param string $events
     * @return Calendar
     */
    public function setEvents($events)
    {
        $this->events = $events;

        return $this;
    }

    /**
     * Get events
     *
     * @return string
     */
    public function getEvents()
    {
        return $this->events;
    }
}

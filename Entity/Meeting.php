<?php

namespace Interne\SeanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Meeting
 *
 * @ORM\Table(name="seancebundle_meeting")
 * @ORM\Entity(repositoryClass="Interne\SeanceBundle\Entity\MeetingRepository")
 */
class Meeting
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="4", max="200")
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     *
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255)
     *
     * @Assert\Length(max="200")
     */
    private $place;

    // TODO : Add nullable=false to enforce storage of meetings in one container
    /**
     * @ORM\ManyToOne(targetEntity="Interne\SeanceBundle\Entity\Container", inversedBy="meetings")
     * @ORM\JoinColumn(name="container_id", referencedColumnName="id")
     */
    private $container;

    /**
     * @ORM\OneToMany(targetEntity="Interne\SeanceBundle\Entity\Item", mappedBy="meeting")
     */
    private $items;



    public function __construct() {
        $this->date = new \DateTime();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }


    // ========================================================
    //                    GETTERS / SETTERS
    // ========================================================

    public function getNewPosition() {
        return $this->getItems()->count() + 1;
    }


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Meeting
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set place
     *
     * @param string $place
     *
     * @return Meeting
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Meeting
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
     * Set container
     *
     * @param \Interne\SeanceBundle\Entity\Container $container
     *
     * @return Meeting
     */
    public function setContainer(\Interne\SeanceBundle\Entity\Container $container = null)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Get container
     *
     * @return \Interne\SeanceBundle\Entity\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Add item
     *
     * @param \Interne\SeanceBundle\Entity\Item $item
     *
     * @return Meeting
     */
    public function addItem(\Interne\SeanceBundle\Entity\Item $item)
    {
        $this->items[] = $item;
        $item->setMeeting($this);

        return $this;
    }

    /**
     * Remove item
     *
     * @param \Interne\SeanceBundle\Entity\Item $item
     */
    public function removeItem(\Interne\SeanceBundle\Entity\Item $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }
}

<?php

namespace Interne\SeanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Container
 *
 * @ORM\Table(name="seancebundle_container")
 * @ORM\Entity(repositoryClass="Interne\SeanceBundle\Entity\ContainerRepository")
 */
class Container
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Interne\SeanceBundle\Entity\Meeting", mappedBy="container")
     */
    private $meetings;

    /**
     * @ORM\OneToMany(targetEntity="Interne\SeanceBundle\Entity\Item", mappedBy="container")
     */
    private $stackOfItems;



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
     * Set title
     *
     * @param string $title
     *
     * @return Container
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Container
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meetings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->stackOfItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add meeting
     *
     * @param \Interne\SeanceBundle\Entity\Meeting $meeting
     *
     * @return Container
     */
    public function addMeeting(\Interne\SeanceBundle\Entity\Meeting $meeting)
    {
        $this->meetings[] = $meeting;

        return $this;
    }

    /**
     * Remove meeting
     *
     * @param \Interne\SeanceBundle\Entity\Meeting $meeting
     */
    public function removeMeeting(\Interne\SeanceBundle\Entity\Meeting $meeting)
    {
        $this->meetings->removeElement($meeting);
    }

    /**
     * Get meetings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetings()
    {
        return $this->meetings;
    }

    /**
     * Add stackOfItem
     *
     * @param \Interne\SeanceBundle\Entity\Item $stackOfItem
     *
     * @return Container
     */
    public function addStackOfItem(\Interne\SeanceBundle\Entity\Item $stackOfItem)
    {
        $this->stackOfItems[] = $stackOfItem;

        return $this;
    }

    /**
     * Remove stackOfItem
     *
     * @param \Interne\SeanceBundle\Entity\Item $stackOfItem
     */
    public function removeStackOfItem(\Interne\SeanceBundle\Entity\Item $stackOfItem)
    {
        $this->stackOfItems->removeElement($stackOfItem);
    }

    /**
     * Get stackOfItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStackOfItems()
    {
        return $this->stackOfItems;
    }
}

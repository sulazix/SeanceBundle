<?php

namespace Interne\SeanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Item représente un point d'un ordre du jour, il peut être contenu dans
 * une réunion ou dans le stack de points d'un conteneur.
 *
 * @see InterneSeanceBundle\Entity\Container
 * @see InterneSeanceBundle\Entity\Meeting
 *
 * @ORM\Table(name="seancebundle_item")
 * @ORM\Entity(repositoryClass="Interne\SeanceBundle\Entity\ItemRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Item
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
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="200")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     *
     * @Assert\GreaterThan(value="0")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Interne\SeanceBundle\Entity\Container", inversedBy="stackOfItems")
     * @ORM\JoinColumn(name="container_id", referencedColumnName="id")
     */
    private $container;

    /**
     * @ORM\ManyToOne(targetEntity="Interne\SeanceBundle\Entity\Meeting", inversedBy="items")
     * @ORM\JoinColumn(name="meeting_id", referencedColumnName="id")
     */
    private $meeting;

    /**
     * @ORM\OneToOne(targetEntity="Interne\SeanceBundle\Entity\Item", cascade={"persist"})
     */
    private $previous;

    /**
    * @ORM\ManyToMany(targetEntity="Interne\SeanceBundle\Entity\Tag", cascade={"persist"})
    * @ORM\JoinTable(name="seancebundle_item_tag")
    */
    private $tags;


    // ========================================================
    //                    DOCTRINE EVENTS
    // ========================================================

    /**
    * Constructor 
    */
    public function __construct() {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Génère une position à partir des positions existantes
     * des différents points d'une réunion.
     *
     * @ORM\PrePersist
     */
    public function generatePosition(LifeCycleEventArgs $event) {
        $this->setPosition($this->getMeeting()->getNewPosition());
    }



    // ========================================================
    //                    GETTERS / SETTERS
    // ========================================================


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
     * @return Item
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
     * @return Item
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
     * Set position
     *
     * @param integer $position
     *
     * @return Item
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set container
     *
     * @param \Interne\SeanceBundle\Entity\Container $container
     *
     * @return Item
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
     * Set meeting
     *
     * @param \Interne\SeanceBundle\Entity\Meeting $meeting
     *
     * @return Item
     */
    public function setMeeting(\Interne\SeanceBundle\Entity\Meeting $meeting = null)
    {
        $this->meeting = $meeting;

        return $this;
    }

    /**
     * Get meeting
     *
     * @return \Interne\SeanceBundle\Entity\Meeting
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * Set previous
     *
     * @param \Interne\SeanceBundle\Entity\Item $previous
     *
     * @return Item
     */
    public function setPrevious(\Interne\SeanceBundle\Entity\Item $previous = null)
    {
        $this->previous = $previous;

        return $this;
    }

    /**
     * Get previous
     *
     * @return \Interne\SeanceBundle\Entity\Item
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    public function getTags()
    {
        return $this->tags;
    }
    
    public function addTag(\Interne\SeanceBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;
        return $this;
    }

    public function removeTag(\InterneSeanceBundle\Entity\Tag $tag) {
        $this->tags->removeElement($tag);
    }
}

<?php

namespace Interne\SeanceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * DO NOT : Inverse relationship with Item entity, this causes serious trouble for object serialization !
 *
 * @ORM\Table(name="seancebundle_tag")
 * @ORM\Entity(repositoryClass="Interne\SeanceBundle\Entity\TagRepository")
 */
class Tag
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
     * @var boolean
     *
     * @ORM\Column(name="moveToStack", type="boolean")
     */
    private $moveToStack;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isTrackable", type="boolean")
     */
    private $isTrackable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="displayHome", type="boolean")
     */
    private $displayHome;


    /**
    * Constructor 
    */
    public function __construct() {
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
     * @return Tag
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
     * @return Tag
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
     * Set moveToStack
     *
     * @param boolean $moveToStack
     *
     * @return Tag
     */
    public function setMoveToStack($moveToStack)
    {
        $this->moveToStack = $moveToStack;

        return $this;
    }

    /**
     * Get moveToStack
     *
     * @return boolean
     */
    public function getMoveToStack()
    {
        return $this->moveToStack;
    }

    /**
     * Set isTrackable
     *
     * @param boolean $isTrackable
     *
     * @return Tag
     */
    public function setIsTrackable($isTrackable)
    {
        $this->isTrackable = $isTrackable;

        return $this;
    }

    /**
     * Get isTrackable
     *
     * @return boolean
     */
    public function getIsTrackable()
    {
        return $this->isTrackable;
    }

    /**
     * Set displayHome
     *
     * @param boolean $displayHome
     *
     * @return Tag
     */
    public function setDisplayHome($displayHome)
    {
        $this->displayHome = $displayHome;

        return $this;
    }

    /**
     * Get displayHome
     *
     * @return boolean
     */
    public function getDisplayHome()
    {
        return $this->displayHome;
    }
}


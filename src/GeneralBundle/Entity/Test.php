<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GeneralBundle\Abstracts\EntityAbstract;

/**
 * Test
 */
class Test extends EntityAbstract
{
    const TYPE_SIMPLE = 'SIMPLE_TEST';
    const TYPE_STANDARD = 'STANDARD_TEST';

    private static $_types = [
        self::TYPE_SIMPLE => 'Простой тест',
        self::TYPE_STANDARD => 'Сложный тест',
    ];

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $owner_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $date_creation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $questions;

    /**
     * @var \GeneralBundle\Entity\User
     */
    private $author;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $passed_users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->passed_users = new \Doctrine\Common\Collections\ArrayCollection();
    }


    // Getters & Setters

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
     * Set type
     *
     * @param string $type
     * @return Test
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set owner_id
     *
     * @param integer $ownerId
     * @return Test
     */
    public function setOwnerId($ownerId)
    {
        $this->owner_id = $ownerId;
    
        return $this;
    }

    /**
     * Get owner_id
     *
     * @return integer 
     */
    public function getOwnerId()
    {
        return $this->owner_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Test
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
     * Set description
     *
     * @param string $description
     * @return Test
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
     * Set date_creation
     *
     * @param \DateTime $dateCreation
     * @return Test
     */
    public function setDateCreation($dateCreation)
    {
        $this->date_creation = $dateCreation;
    
        return $this;
    }

    /**
     * Get date_creation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    // END Getters & Setters


    // Auto event handlers

    /**
     * @ORM\PrePersist
     */
    public function setTypeValue()
    {
        if($this->getType() === null){
            $this->setType(self::TYPE_SIMPLE);
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setDateCreationValue()
    {
        if($this->getDateCreation() === null){
            $this->setDateCreation(new \DateTime());
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setAuthorValue()
    {
        if($this->getAuthor() === null){
            $this->setAuthor();
        }
    }

    // END Auto event handlers


    // Public functions

    /**
     * @return array
     */
    public function getTypesItems()
    {
        return self::$_types;
    }

    public function getOwnerName()
    {
        return $this->author->getUserName();
    }

    // END Public functions



    // Relations

    /**
     * Add questions
     *
     * @param \GeneralBundle\Entity\Question $questions
     * @return Test
     */
    public function addQuestion(\GeneralBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;
    
        return $this;
    }

    /**
     * Remove questions
     *
     * @param \GeneralBundle\Entity\Question $questions
     */
    public function removeQuestion(\GeneralBundle\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Set author
     *
     * @param \GeneralBundle\Entity\User $author
     * @return Test
     */
    public function setAuthor(\GeneralBundle\Entity\User $author = null)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return \GeneralBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add passed_users
     *
     * @param \GeneralBundle\Entity\User $passedUsers
     * @return Test
     */
    public function addPassedUser(\GeneralBundle\Entity\User $passedUsers)
    {
        $this->passed_users[] = $passedUsers;
    
        return $this;
    }

    /**
     * Remove passed_users
     *
     * @param \GeneralBundle\Entity\User $passedUsers
     */
    public function removePassedUser(\GeneralBundle\Entity\User $passedUsers)
    {
        $this->passed_users->removeElement($passedUsers);
    }

    /**
     * Get passed_users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPassedUsers()
    {
        return $this->passed_users;
    }

    // END Relations
}

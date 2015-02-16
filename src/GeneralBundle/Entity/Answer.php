<?php

namespace GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 */
class Answer
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $text;

    /**
     * @var float
     */
    private $rate;

    /**
     * @var string
     */
    private $description;

    /**
     * @var boolean
     */
    private $is_correct;

    /**
     * @var integer
     */
    private $num;

    /**
     * @var \GeneralBundle\Entity\Question
     */
    private $question;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $passed_users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->passed_users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Answer
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
     * Set text
     *
     * @param string $text
     * @return Answer
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set rate
     *
     * @param float $rate
     * @return Answer
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    
        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Answer
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
     * Set is_correct
     *
     * @param boolean $isCorrect
     * @return Answer
     */
    public function setIsCorrect($isCorrect)
    {
        $this->is_correct = $isCorrect;
    
        return $this;
    }

    /**
     * Get is_correct
     *
     * @return boolean 
     */
    public function getIsCorrect()
    {
        return $this->is_correct;
    }

    /**
     * Set num
     *
     * @param integer $num
     * @return Answer
     */
    public function setNum($num)
    {
        $this->num = $num;
    
        return $this;
    }

    /**
     * Get num
     *
     * @return integer 
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set question
     *
     * @param \GeneralBundle\Entity\Question $question
     * @return Answer
     */
    public function setQuestion(\GeneralBundle\Entity\Question $question = null)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return \GeneralBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Add passed_users
     *
     * @param \GeneralBundle\Entity\User $passedUsers
     * @return Answer
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
    /**
     * @ORM\PrePersist
     */
    public function setNumValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setIsCorrectValue()
    {
        // Add your code here
    }
}

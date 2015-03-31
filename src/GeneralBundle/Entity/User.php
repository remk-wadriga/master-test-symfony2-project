<?php

namespace GeneralBundle\Entity;

use GeneralBundle\Abstracts\EntityAbstract;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User extends EntityAbstract implements UserInterface
{
    const ROLE_GUEST = 'ROLE_GUEST';
    const ROLE_USER = 'ROLE_USER';
    const ROLE_MODERATOR = 'ROLE_MODERATOR';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_BANNED = 'ROLE_BANNED';

    private static $_roles = [
        self::ROLE_GUEST => 'Гость',
        self::ROLE_USER => 'Пользователь',
        self::ROLE_MODERATOR => 'Модератор',
        self::ROLE_ADMIN => 'Администратор',
        self::ROLE_BANNED => 'Забаненный',
    ];

    private static $_rolesIds = [
        self::ROLE_GUEST,
        self::ROLE_USER,
        self::ROLE_MODERATOR,
        self::ROLE_ADMIN,
        self::ROLE_BANNED,
    ];

    private static $_salt = 'IUYT786TY89IO09765TYU98IO';


    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $info;

    /**
     * @var string
     */
    private $avatar;

    /**
     * @var string
     */
    private $role;

    /**
     * @var integer
     */
    private $rate;

    /**
     * @var \DateTime
     */
    private $date_registration;

    /**
     * @var \DateTime
     */
    private $date_last_login;


    public $defaultAvatar = '/bundles/general/img/user/user-default-avatar.jpg';


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
     * Set username
     *
     * @param string $name
     * @return User
     */
    public function setUserName($name)
    {
        $this->username = $name;
        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUserName()
    {
        return trim($this->username);
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return trim($this->password);
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return trim($this->email);
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return trim($this->first_name);
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    
        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return trim($this->last_name);
    }

    /**
     * Set info
     *
     * @param string $info
     * @return User
     */
    public function setInfo($info)
    {
        $this->info = $info;
    
        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar !== null ? trim($this->avatar) : $this->defaultAvatar;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return trim($this->role);
    }

    /**
     * Set rate
     *
     * @param integer $rate
     * @return User
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    
        return $this;
    }

    /**
     * Get rate
     *
     * @return integer 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set date_registration
     *
     * @param \DateTime $dateRegistration
     * @return User
     */
    public function setDateRegistration($dateRegistration)
    {
        $this->date_registration = $dateRegistration;
    
        return $this;
    }

    /**
     * Get date_registration
     *
     * @return \DateTime 
     */
    public function getDateRegistration()
    {
        return $this->date_registration;
    }

    /**
     * Set date_last_login
     *
     * @param \DateTime $dateLastLogin
     * @return User
     */
    public function setDateLastLogin($dateLastLogin)
    {
        $this->date_last_login = $dateLastLogin;
    
        return $this;
    }

    /**
     * Get date_last_login
     *
     * @return \DateTime 
     */
    public function getDateLastLogin()
    {
        return $this->date_last_login;
    }

    // END Getters & Setters


    /**
     * @return array|\Symfony\Component\Security\Core\Role\Role[]
     */
    public function getRoles()
    {
        return [$this->getRole()];
    }

    public static function getAllRoles()
    {
        return self::$_roles;
    }

    /**
     * @return null|string
     */
    public function getSalt()
    {
        return self::$_salt;
    }

    /**
     *
     */
    public function eraseCredentials()
    {

    }

    /**
     * @param UserInterface $user
     * @return bool
     */
    public function equals(UserInterface $user)
    {
        return $user->getUsername() == $this->getUsername();
    }

    // Auto event handlers

    /**
     * @ORM\PrePersist
     */
    public function setDateRegistrationValue()
    {
        if($this->getDateRegistration() === null){
            $this->setDateRegistration(new \DateTime());
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setRoleValue()
    {
        if($this->getRole() === ''){
            $this->setRole(self::ROLE_USER);
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setRateValue()
    {
        if($this->getRate() === null){
            $this->setRate(0);
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setLoginValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PrePersist
     */
    public function setPasswordValue()
    {
        if($this->password !== null){
            $this->password = hash('sha512', $this->password.'{'.$this->getSalt().'}');
        }
    }

    /**
     * @ORM\PostPersist
     */
    public function uploadAvatar()
    {
        // Add your code here
    }

    // END Auto event handlers


    // Public functions



    // END Public functions
}

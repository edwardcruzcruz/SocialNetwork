<?php

namespace BackendBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var int
     */
    private $id;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var string|null
     */
    private $role;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $surname;

    /**
     * @var string|null
     */
    private $password;

    /**
     * @var string|null
     */
    private $nick;

    /**
     * @var string|null
     */
    private $bio;

    /**
     * @var string|null
     */
    private $active;

    /**
     * @var string|null
     */
    private $image;

    /*
     * Que propiedad va a ser el username del formulario en login y registrar
     */
    public function getUsername(){
        return $this->email;
    }
    
    public function getSalt(){
        return null;
    }
    
    public function getRoles(){
        return array('ROLE_USER','ROLE_ADMIN');
    }
    
    public function  eraseCredentials(){
        
    }

    public function __toString(){
        return $this->name;
    }
    
    
    public function serialize(){
        return serialize(array(
            $this->id,
            $this->email,
            $this->password
        ));   
    }

    public function unserialize($serialized){
        list(
            $this->id,
            $this->email,
                $this->password,
                )= unserialize($serialized);
    }
    /**
     * Set role.
     *
     * @param string|null $role
     *
     * @return User
     */
    public function setRole($role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role.
     *
     * @return string|null
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return User
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return User
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname.
     *
     * @param string|null $surname
     *
     * @return User
     */
    public function setSurname($surname = null)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname.
     *
     * @return string|null
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set password.
     *
     * @param string|null $password
     *
     * @return User
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nick.
     *
     * @param string|null $nick
     *
     * @return User
     */
    public function setNick($nick = null)
    {
        $this->nick = $nick;

        return $this;
    }

    /**
     * Get nick.
     *
     * @return string|null
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * Set bio.
     *
     * @param string|null $bio
     *
     * @return User
     */
    public function setBio($bio = null)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio.
     *
     * @return string|null
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set active.
     *
     * @param string|null $active
     *
     * @return User
     */
    public function setActive($active = null)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return string|null
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set image.
     *
     * @param string|null $image
     *
     * @return User
     */
    public function setImage($image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }


}

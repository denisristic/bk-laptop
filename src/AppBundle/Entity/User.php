<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


    /**
     * @ORM\Table(name="user")
    @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")

     */

class User implements UserInterface, \Serializable
{
/**
* @ORM\Column(type="integer")
* @ORM\Id
* @ORM\GeneratedValue(strategy="AUTO")
*/
private $id;

/**
* @ORM\Column(type="string", length=25, unique=true)
*/
private $username;

/**
* @ORM\Column(type="string", length=64)
*/
private $password;


    public function getUsername()
    {
        return $this->username;
    }

/**
* @ORM\Column(type="string", length=60, unique=true)
*/
private $email;

/**
* @ORM\Column(name="is_active", type="boolean")
*/
private $isActive;

public function __construct()
{
$this->isActive = true;

}

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
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
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
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
        return $this->password;
    }

    public function getSalt()
    {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }




public function getRoles()
{
return array('ROLE_ADMIN');
}

public function eraseCredentials()
{
}

/** @see \Serializable::serialize() */
public function serialize()
{
return serialize(array(
$this->id,
$this->username,
$this->password,
// see section on salt below
// $this->salt,
));}


/** @see \Serializable::unserialize() */
public function unserialize($serialized)
{
list (
$this->id,
$this->username,
$this->password,
// see section on salt below
// $this->salt
) = unserialize($serialized);
}}



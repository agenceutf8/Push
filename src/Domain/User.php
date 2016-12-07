<?php
/**
 * Created by PhpStorm.
 * User: POL
 * Date: 26/11/2016
 * Time: 16:02
 */

namespace Push\Domain;

use Symfony\Component\Security\Core\User\UserInterface;


class User implements UserInterface{
    /**
     * User id
     * @var integer
     */
    private $id;

    /*
     * User name
     * @var string
     */
    private $username;

    /*
     * User password
     * @var string
     */
    private $password;

    /*
     * User salt
     * @var string
     */
    private $salt;

    /*
     * User mail
     * @var string
     */
    private $mail;

    /*
     * User role
     * values : ROLE_USER or ROLE_ADMIN
     * @var string;
     */
    private $role;

    // GETTERS & SETTERS
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getMail()
    {
        return $this->mail;
    }
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getSalt()
    {
        return $this->salt;
    }
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRoles()
    {
        return array($this->getRole());
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

}
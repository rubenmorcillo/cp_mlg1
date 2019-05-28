<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User")
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $login;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $nickname;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $esAdmin;

    /**
     * @ORM\Column(type="integer")
     * @var String
     */
    private $credits;

    /**
     * @return String
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param String $login
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return String
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param String $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * @return String
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param String $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEsAdmin()
    {
        return $this->esAdmin;
    }

    /**
     * @param bool $esAdmin
     * @return User
     */
    public function setEsAdmin($esAdmin)
    {
        $this->esAdmin = $esAdmin;
        return $this;
    }

    /**
     * @return String
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param String $credits
     * @return User
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;
        return $this;
    }

    /**
     * @return String
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param String $image
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $image;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
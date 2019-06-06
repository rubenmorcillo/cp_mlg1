<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
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
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private $signDate;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $login;

    /**
     * @ORM\Column(type="string", unique=true)
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
     * @ORM\Column(type="string",nullable=true)
     * @var String
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $credits;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $reputation;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Card", mappedBy="cardOwner")
     * @ORM\JoinColumn(nullable=true)
     * @var Card[]
     */
    private $cards;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Deck", mappedBy="deckOwner")
     * @ORM\JoinColumn(nullable=true)
     * @var Deck[]
     */
    private $decks;

    public function __construct()
    {
        $this->decks=new ArrayCollection();
        $this->cards=new ArrayCollection();
    }

    /**
     * @return \DateTime
     */
    public function getSignDate()
    {
        return $this->signDate;
    }

    /**
     * @param \DateTime $signDate
     * @return User
     */
    public function setSignDate(\DateTime $signDate)
    {
        $this->signDate = $signDate;
        return $this;
    }


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
     * @return int
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param int $credits
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Card[]
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @param Card[]|null $cards
     * @return User
     */
    public function setCards($cards)
    {
        $this->cards = $cards;
        return $this;
    }

    /**
     * @return Deck[]
     */
    public function getDecks()
    {
        return $this->decks;
    }

    /**
     * @param Deck[]|null $decks
     * @return User
     */
    public function setDecks($decks)
    {
        $this->decks = $decks;
        return $this;
    }

    /**
     * @param int $reputation
     * @return User
     */
    public function setReputation($reputation)
    {
        $this->reputation = $reputation;
        return $this;
    }

    /**
     * @return int
     */
    public function getReputation()
    {
        return $this->reputation;
    }


}
<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="User")
 */
class User implements UserInterface
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
     * @ORM\Column(type="string", unique=true)
     * @Assert\Length(min=4, minMessage="Debe tener al menos 4 caracteres")
     * @Assert\NotBlank()
     * @var String
     */
    private $login;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Length(min=4, minMessage="Debe tener al menos 4 caracteres")
     * @Assert\NotBlank()
     * @var String
     */
    private $nickname;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(min=6, minMessage="Debe tener al menos 6 caracteres")
     * @Assert\NotBlank()
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

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Battle", mappedBy="Battle")
     * @ORM\JoinColumn(nullable=true)
     * @var Battle[]
     */
    private $ataques;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Battle", mappedBy="Battle")
     * @ORM\JoinColumn(nullable=true)
     * @var Battle[]
     */
    private $defensas;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Battle", mappedBy="Battle")
     * @ORM\JoinColumn(nullable=true)
     * @var Battle[]
     */
    private $win;



    public function __construct()
    {
        $this->decks=new ArrayCollection();
        $this->cards=new ArrayCollection();
        $this->ataques=new ArrayCollection();
        $this->defensas=new ArrayCollection();
        $this->win=new ArrayCollection();
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

    /**
     * @return Battle[]
     */
    public function getAtaques()
    {
        return $this->ataques;
    }

    /**
     * @param Battle[] $ataques
     * @return User
     */
    public function setAtaques($ataques)
    {
        $this->ataques = $ataques;
        return $this;
    }

    /**
     * @return Battle[]
     */
    public function getDefensas()
    {
        return $this->defensas;
    }

    /**
     * @param Battle[] $defensas
     * @return User
     */
    public function setDefensas($defensas)
    {
        $this->defensas = $defensas;
        return $this;
    }

    /**
     * @return Battle[]
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * @param Battle[] $win
     * @return User
     */
    public function setWin($win)
    {
        $this->win = $win;
        return $this;
    }



    public function getRoles()
    {
        $roles = ['ROLE_PLAYER'];

        if ($this->isEsAdmin()){
            $roles[] = 'ROLE_ADMIN';
        }

        return $roles;
    }

    public function getSalt()
    {
       return null;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        return $this->login;
    }

    public function __toString()
    {
        return $this->getNickname();
    }


}
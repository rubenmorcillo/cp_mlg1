<?php


namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="deck")
 */
class Deck
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
     * @var string
     */
    private $deckName;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="decks")
     * @ORM\JoinColumn(unique=true)
     * @var User
     */
    private $deckOwner;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Card")
     * @ORM\JoinTable(name="cardsInDeck")
     * @var Card[]
     */
    private $cardsContained;

    public function __construct()
    {
        $this->cardsContained=new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getDeckOwner()
    {
        return $this->deckOwner;
    }

    /**
     * @param User $deckOwner
     * @return Deck
     */
    public function setDeckOwner($deckOwner)
    {
        $this->deckOwner = $deckOwner;
        return $this;
    }



    /**
     * @return Card[]
     */
    public function getCardsContained()
    {
        return $this->cardsContained;
    }

    /**
     * @param Card[] $cardsContained
     * @return Deck
     */
    public function setCardsContained($cardsContained)
    {
        $this->cardsContained = $cardsContained;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeckName()
    {
        return $this->deckName;
    }

    /**
     * @param string $deckName
     * @return Deck
     */
    public function setDeckName($deckName)
    {
        $this->deckName = $deckName;
        return $this;
    }



}
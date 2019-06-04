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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @var User
     */
    private $deckOwner;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Card")
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



}
<?php


namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;


    /**
     * @ORM\Entity
     * @ORM\Table(name="card")
     */
    class Card
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;


    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $typeCard;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="cards")
     * @var User
     */
    private $cardOwner;




    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTypeCard()
    {
        return $this->typeCard;
    }

    /**
     * @param int $typeCard
     * @return Card
     */
    public function setTypeCard($typeCard)
    {
        $this->typeCard = $typeCard;
        return $this;
    }

    /**
     * @return User
     */
    public function getCardOwner()
    {
        return $this->cardOwner;
    }

    /**
     * @param User $cardOwner
     * @return Card
     */
    public function setCardOwner($cardOwner)
    {
        $this->cardOwner = $cardOwner;
        return $this;
    }




}
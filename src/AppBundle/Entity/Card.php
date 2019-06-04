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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeCard")
     * @var TypeCard
     */
    private $typeCard;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
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
         * @return TypeCard
         */
        public function getTypeCard()
        {
            return $this->typeCard;
        }

        /**
         * @param TypeCard $typeCard
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
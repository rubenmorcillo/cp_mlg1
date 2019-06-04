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
    private $owner;


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
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     * @return Card
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
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


}
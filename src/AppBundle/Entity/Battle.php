<?php


namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="battle")
 */
class Battle
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
    private $battleDate;


    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $damagePlayerOne;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $damagePlayerTwo;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getDamagePlayerOne()
    {
        return $this->damagePlayerOne;
    }

    /**
     * @param String $damagePlayerOne
     * @return Battle
     */
    public function setDamagePlayerOne($damagePlayerOne)
    {
        $this->damagePlayerOne = $damagePlayerOne;
        return $this;
    }

    /**
     * @return String
     */
    public function getDamagePlayerTwo()
    {
        return $this->damagePlayerTwo;
    }

    /**
     * @param String $damagePlayerTwo
     * @return Battle
     */
    public function setDamagePlayerTwo($damagePlayerTwo)
    {
        $this->damagePlayerTwo = $damagePlayerTwo;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBattleDate()
    {
        return $this->battleDate;
    }

    /**
     * @param \DateTime $battleDate
     * @return Battle
     */
    public function setBattleDate(\DateTime $battleDate)
    {
        $this->battleDate = $battleDate;
        return $this;
    }



}
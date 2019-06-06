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
     * @ORM\Column(type="integer")
     * @var int
     */
    private $killedPlayerOne;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $killedPlayerTwo;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return int
     */
    public function getKilledPlayerOne()
    {
        return $this->killedPlayerOne;
    }

    /**
     * @param int $killedPlayerOne
     * @return Battle
     */
    public function setKilledPlayerOne($killedPlayerOne)
    {
        $this->killedPlayerOne = $killedPlayerOne;
        return $this;
    }

    /**
     * @return int
     */
    public function getKilledPlayerTwo()
    {
        return $this->killedPlayerTwo;
    }

    /**
     * @param int $killedPlayerTwo
     * @return Battle
     */
    public function setKilledPlayerTwo($killedPlayerTwo)
    {
        $this->killedPlayerTwo = $killedPlayerTwo;
        return $this;
    }



}
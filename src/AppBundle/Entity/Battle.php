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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="ataques")
     * @var User
     */
    private $playerAttacker;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="defensas")
     * @var User
     */
    private $playerDefender;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="win")
     * @var User
     */
    private $winner;

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
     * @return User
     */
    public function getPlayerAttacker()
    {
        return $this->playerAttacker;
    }

    /**
     * @param User $playerAttacker
     * @return Battle
     */
    public function setPlayerAttacker($playerAttacker)
    {
        $this->playerAttacker = $playerAttacker;
        return $this;
    }

    /**
     * @return User
     */
    public function getPlayerDefender()
    {
        return $this->playerDefender;
    }

    /**
     * @param User $playerDefender
     * @return Battle
     */
    public function setPlayerDefender($playerDefender)
    {
        $this->playerDefender = $playerDefender;
        return $this;
    }

    /**
     * @return User
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @param User $winner
     * @return Battle
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;
        return $this;
    }





}
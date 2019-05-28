<?php


namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="faction")
 */
class Faction
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
     * @var String
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $logo;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $bonus;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $description;

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     * @return Faction
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return String
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param String $logo
     * @return Faction
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return String
     */
    public function getBonus()
    {
        return $this->bonus;
    }

    /**
     * @param String $bonus
     * @return Faction
     */
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;
        return $this;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param String $description
     * @return Faction
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}
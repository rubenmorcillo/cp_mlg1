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
     * @ORM\Column(type="string")
     * @var String
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $power;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $damage;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $image;

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     * @return Card
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * @param int $power
     * @return Card
     */
    public function setPower($power)
    {
        $this->power = $power;
        return $this;
    }

    /**
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param int $damage
     * @return Card
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;
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
     * @return Card
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

}
<?php


namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

class TypeCard
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */private $id;

    /**
     * @ORM\Column(type="string")
     *  @var string
     */
    private $name;


    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $imageRoute;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return TypeCard
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageRoute()
    {
        return $this->imageRoute;
    }

    /**
     * @param string $imageRoute
     * @return TypeCard
     */
    public function setImageRoute($imageRoute)
    {
        $this->imageRoute = $imageRoute;
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
     * @return TypeCard
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
     * @return TypeCard
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;
        return $this;
    }



}
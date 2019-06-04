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


}
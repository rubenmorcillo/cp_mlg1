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
     * @ORM\Column(type="string")
     * @var String
     */
    private $damagePlayerOne;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    private $damagePlayerTwo;


}
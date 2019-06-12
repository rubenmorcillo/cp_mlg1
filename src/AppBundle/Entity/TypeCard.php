<?php


namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="type_card")
 */
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
     * @Assert\NotBlank()
     *  @var string
     */
    private $name;


    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $imageRoute;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @var int
     */
    private $atq_a;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @var int
     */
    private $atq_b;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @var int
     */
    private $atq_c;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @var int
     */
    private $atq_d;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Card", mappedBy="tipoCarta")
     * @ORM\JoinColumn(nullable=true)
     * @var Card[]
     */
    private $copiaCarta;

    public function __construct()
    {
        $this->copiaCarta=new ArrayCollection();

    }

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
    public function setImageRoute($imageRoute = null)
    {
        $this->imageRoute = $imageRoute;
        return $this;
    }

    /**
     * @return int
     */
    public function getAtqA()
    {
        return $this->atq_a;
    }

    /**
     * @param int $atq_a
     * @return TypeCard
     */
    public function setAtqA($atq_a)
    {
        $this->atq_a = $atq_a;
        return $this;
    }

    /**
     * @return int
     */
    public function getAtqB()
    {
        return $this->atq_b;
    }

    /**
     * @param int $atq_b
     * @return TypeCard
     */
    public function setAtqB($atq_b)
    {
        $this->atq_b = $atq_b;
        return $this;
    }

    /**
     * @return int
     */
    public function getAtqC()
    {
        return $this->atq_c;
    }

    /**
     * @param int $atq_c
     * @return TypeCard
     */
    public function setAtqC($atq_c)
    {
        $this->atq_c = $atq_c;
        return $this;
    }

    /**
     * @return int
     */
    public function getAtqD()
    {
        return $this->atq_d;
    }

    /**
     * @param int $atq_d
     * @return TypeCard
     */
    public function setAtqD($atq_d)
    {
        $this->atq_d = $atq_d;
        return $this;
    }

    /**
     * @return Card[]
     */
    public function getCopiaCarta()
    {
        return $this->copiaCarta;
    }

    /**
     * @param Card[]|null $copiaCarta
     * @return TypeCard
     */
    public function setCopiaCarta($copiaCarta)
    {
        $this->copiaCarta = $copiaCarta;
        return $this;
    }




}
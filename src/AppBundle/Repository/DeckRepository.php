<?php
namespace AppBundle\Repository;
use AppBundle\Entity\Card;
use AppBundle\Entity\Deck;
use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
class DeckRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deck::class);
    }

    public function unDeck($id){
        return $this->createQueryBuilder('d')
            ->select('d')
            ->where('d.id = :deck')
            ->setParameter('deck', $id)
            ->getQuery()
            ->getResult();
    }
}
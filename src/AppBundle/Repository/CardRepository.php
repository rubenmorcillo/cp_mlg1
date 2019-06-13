<?php
namespace AppBundle\Repository;
use AppBundle\Entity\Card;
use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
class CardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Card::class);
    }

    public function listarCartasUsuario(User $usuario){
        return $this->createQueryBuilder('c')
            ->select('c')
            ->addSelect('tc')
            ->where('c.cardOwner = :user')
            ->setParameter('user', $usuario)
            ->join('c.typeCard', 'tc ')
            ->getQuery()
            ->getResult();

    }

}
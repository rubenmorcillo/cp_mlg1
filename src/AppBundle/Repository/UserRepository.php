<?php
namespace AppBundle\Repository;
use AppBundle\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function buscarRanking(){
        return $this->createQueryBuilder('u')
            ->select('u')
            ->orderBy('u.reputation', 'desc')
            ->getQuery()
            ->getResult();

    }

    public function buscarTodosMenosLogeado(User $usuario){
        return $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.id <> :user')
            ->setParameter('user', $usuario)
            ->orderBy('u.reputation')
            ->getQuery()
            ->getResult();
    }


}
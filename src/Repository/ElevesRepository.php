<?php

namespace App\Repository;

use App\Entity\Meres;
use App\Entity\Eleves;
use App\Entity\Parents;
use App\Entity\Peres;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Eleves>
 */
class ElevesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eleves::class);
    }

    /**
     * Recherche les éléves par leur maman
     * Summary of findByMere
     * @param \App\Entity\Meres $meres
     * @return array
     */
    public function findByMere(Meres $meres): array
    {
        return $this->createQueryBuilder('e')
            ->select('e', 'p') // Sélection explicite pour éviter les proxys
            ->leftJoin('e.parent', 'p') // Jointure avec parents
            ->andWhere('p.meres = :mere') // Correction : la propriété devrait être `p.mere` et non `p.meres`
            ->setParameter('mere', $meres)
            ->addOrderBy('e.classe', 'ASC') // Utiliser addOrderBy au lieu d'un deuxième orderBy
            ->addOrderBy('e.fullname', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * 
     * Rechercher les élèves par leur pere
     * @param \App\Entity\Peres $peres
     * @return array
     */
    public function findByPere(Peres $peres): array
    {
        return $this->createQueryBuilder('e')
            ->select('e', 'p') // Sélection explicite pour éviter les proxys
            ->leftJoin('e.parent', 'p') // Jointure avec parents
            ->andWhere('p.pere = :pere') // Correction : la propriété devrait être `p.mere` et non `p.meres`
            ->setParameter('pere', $peres)
            ->addOrderBy('e.classe', 'ASC') // Utiliser addOrderBy au lieu d'un deuxième orderBy
            ->addOrderBy('e.fullname', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * 
     * Rechercher les élèves par parents
     * @param \App\Entity\Parents $parents
     * @return array
     */
    public function findByParent(Parents $parents): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.parent = :parent')
            ->setParameter('parent', $parents)
            ->addOrderBy('e.classe', 'ASC') // Utiliser addOrderBy au lieu d'un deuxième orderBy
            ->addOrderBy('e.fullname', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }



    //    /**
    //     * @return Eleves[] Returns an array of Eleves objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Eleves
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

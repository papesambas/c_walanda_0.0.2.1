<?php

namespace App\Repository;

use App\Entity\Meres;
use App\Entity\Peres;
use App\Entity\Parents;
use App\Data\SearchData;
use App\Data\SearchParentData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Parents>
 */
class ParentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parents::class);
    }

    

        public function findOneByPereAndMere(Peres $peres, Meres $meres): ?Parents
        {
            return $this->createQueryBuilder('p')
                ->andWhere('p.pere = :pere')
                ->andWhere('p.meres = :mere')
                ->setParameter('pere', $peres)
                ->setParameter('mere', $meres)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }

        public function findBySearchParentData(SearchParentData $searchParentData)
        {
            $queryBuilder = $this->createQueryBuilder('parent')
                ->leftJoin('parent.pere', 'p') // Jointure avec le père
                ->leftJoin('parent.mere', 'm') // Jointure avec la mère
                ->leftJoin('p.telephone1', 't1') // Jointure avec le téléphone du père
                ->leftJoin('p.telephone2', 't2') // Jointure avec le téléphone du père
                ->leftJoin('p.nina', 'pn') // Jointure avec le NINA du père
                ->leftJoin('m.telephone1', 'mt1') // Jointure avec le téléphone de la mère
                ->leftJoin('m.telephone2', 'mt2') // Jointure avec le téléphone de la mère
                ->leftJoin('m.nina', 'mn') // Jointure avec le NINA de la mère
                ->addSelect('t1', 't2', 'pn', 'mt1', 'mt2', 'mn'); // Sélection des téléphones et NINA
        
            // Recherche par nom complet (ajout de la propriété q)
            if (!empty($searchParentData->q)) {
                $queryBuilder
                    ->andWhere('parent.fullname LIKE :q')
                    ->setParameter('q', '%' . $searchParentData->q . '%');
            }
        
            // Recherche par téléphone du père
            if (!empty($searchParentData->telephonePere)) {
                $normalizedTelephonePere = preg_replace('/\D/', '', $searchParentData->telephonePere);
                $queryBuilder
                    ->andWhere('t1.numero LIKE :telephonePere OR t2.numero LIKE :telephonePere')
                    ->setParameter('telephonePere', '%' . $normalizedTelephonePere . '%');
            }
        
            // Recherche par NINA du père
            if (!empty($searchParentData->ninaPere)) {
                $queryBuilder
                    ->andWhere('pn.designation LIKE :ninaPere')
                    ->setParameter('ninaPere', '%' . $searchParentData->ninaPere . '%');
            }
        
            // Recherche par téléphone de la mère
            if (!empty($searchParentData->telephoneMere)) {
                $normalizedTelephoneMere = preg_replace('/\D/', '', $searchParentData->telephoneMere);
                $queryBuilder
                    ->andWhere('mt1.numero LIKE :telephoneMere OR mt2.numero LIKE :telephoneMere')
                    ->setParameter('telephoneMere', '%' . $normalizedTelephoneMere . '%');
            }
        
            // Recherche par NINA de la mère
            if (!empty($searchParentData->ninaMere)) {
                $queryBuilder
                    ->andWhere('mn.designation LIKE :ninaMere')
                    ->setParameter('ninaMere', '%' . $searchParentData->ninaMere . '%');
            }
        
            return $queryBuilder->getQuery()->getResult();
        }
                    


    //    /**
    //     * @return Parents[] Returns an array of Parents objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Parents
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

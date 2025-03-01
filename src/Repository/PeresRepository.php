<?php

namespace App\Repository;

use App\Entity\Peres;
use App\Data\SearchData;
use App\Data\SearchParentData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Peres>
 */
class PeresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peres::class);
    }

    /**
     * Recherche des entités Peres en fonction des critères de SearchData.
     *
     * @param SearchData $searchData Les critères de recherche.
     * @return Peres[] Les résultats de la recherche.
     */

     public function findBySearchData(SearchParentData $searchParentData)
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
     
         // Recherche par nom complet
         if (!empty($searchParentData->q)) {
             $queryBuilder
                 ->andWhere('parent.fullname LIKE :q')
                 ->setParameter('q', '%' . $searchParentData->q . '%');
         }
     
         // Recherche par téléphone du père
         if (!empty($searchParentData->telephonePere)) {
             $normalizedTelephone = preg_replace('/\D/', '', $searchParentData->telephonePere);
             $queryBuilder
                 ->andWhere('t1.numero LIKE :telephonePere OR t2.numero LIKE :telephonePere')
                 ->setParameter('telephonePere', '%' . $normalizedTelephone . '%');
         }
     
         // Recherche par NINA du père
         if (!empty($searchParentData->ninaPere)) {
             $queryBuilder
                 ->andWhere('pn.designation LIKE :ninaPere')
                 ->setParameter('ninaPere', '%' . $searchParentData->ninaPere . '%');
         }
     
         // Recherche par téléphone de la mère
         if (!empty($searchParentData->telephoneMere)) {
             $normalizedTelephone = preg_replace('/\D/', '', $searchParentData->telephoneMere);
             $queryBuilder
                 ->andWhere('mt1.numero LIKE :telephoneMere OR mt2.numero LIKE :telephoneMere')
                 ->setParameter('telephoneMere', '%' . $normalizedTelephone . '%');
         }
     
         // Recherche par NINA de la mère
         if (!empty($searchParentData->ninaMere)) {
             $queryBuilder
                 ->andWhere('mn.designation LIKE :ninaMere')
                 ->setParameter('ninaMere', '%' . $searchParentData->ninaMere . '%');
         }
     
         return $queryBuilder->getQuery()->getResult();
     }
     
 
 
     public function findBySearchParentData(SearchParentData $searchParentData)
     {
         // Si SearchParentData est null ou que ses propriétés sont vides, retourner une liste vide
         if (
             $searchParentData === null ||
             (empty($searchParentData->telephonePere) && empty($searchParentData->ninaPere))
         ) {
             return [];
         }
         $queryBuilder = $this->createQueryBuilder('p')
             ->select('p', 't1', 't2', 'n') // Sélection explicite pour éviter les proxys
             ->leftJoin('p.telephone1', 't1') // Jointure avec téléphone
             ->leftJoin('p.telephone2', 't2') // Jointure avec téléphone
             ->leftJoin('p.nina', 'n'); // Jointure avec nina
 
         // Recherche par téléphone
         if (!empty($searchParentData->telephonePere)) {
             // Normalisation du numéro (suppression des caractères non numériques)
             $normalizedTelephone = preg_replace('/\D/', '', $searchParentData->telephonePere);
 
             $queryBuilder
             ->andWhere('t1.numero LIKE :telephone OR t2.numero LIKE :telephone')
                 ->setParameter('telephone', $searchParentData->telephonePere);
         }
 
         // Recherche par NINA
         if (!empty($searchParentData->ninaPere)) {
             $queryBuilder
                 ->andWhere('n.designation = :nina')
                 ->setParameter('nina', $searchParentData->ninaPere);
         }
 
         return $queryBuilder->getQuery()->getResult();
     }
     //    /**
    //     * @return Peres[] Returns an array of Peres objects
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

    //    public function findOneBySomeField($value): ?Peres
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

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

    public function findBySearchData(SearchData $searchData)
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->select('p', 'pr', 't1', 't2', 'n')
            ->leftJoin('p.profession', 'pr')
            ->leftJoin('p.telephone1', 't1')
            ->leftJoin('p.telephone2', 't2')
            ->leftJoin('p.nina', 'n');

        // Recherche sur le champ "q"
        if (!empty($searchData->q)) {
            $queryBuilder
                ->andWhere('p.fullname LIKE :q')
                ->setParameter('q', '%' . $searchData->q . '%');
        }

        // Filtre par profession
        if (!empty($searchData->professions)) {
            $queryBuilder
                ->andWhere('p.profession IN (:professions)')
                ->setParameter('professions', $searchData->professions);
        }

        // Recherche par téléphone
        if (!empty($searchData->telephone)) {
            $normalizedTelephone = preg_replace('/\D/', '', $searchData->telephone);

            $queryBuilder
                ->andWhere('t1.numero = :telephone')
                ->orWhere('t2.numero = :telephone')
                ->setParameter('telephone', $normalizedTelephone);
        }

        // Recherche par NINA
        if (!empty($searchData->nina)) {
            $queryBuilder
                ->andWhere('n.designation = :nina')
                ->setParameter('nina', $searchData->nina);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * Recherche des entités Peres en fonction des critères de SearchParentData.
     *
     * @param SearchParentData $searchParentData Les critères de recherche.
     * @return Peres[] Les résultats de la recherche.
     */
    public function findBySearchParentData(SearchParentData $searchParentData)
    {
        if (
            $searchParentData === null ||
            (empty($searchParentData->telephonePere) && empty($searchParentData->ninaPere) && empty($searchParentData->telephoneMere) && empty($searchParentData->ninaMere))
        ) {
            return [];
        }

        $queryBuilder = $this->createQueryBuilder('p')
            ->select('p', 't1', 't2', 'n')
            ->leftJoin('p.telephone1', 't1')
            ->leftJoin('p.telephone2', 't2')
            ->leftJoin('p.nina', 'n');

        // Recherche par téléphone (Père)
        if (!empty($searchParentData->telephonePere)) {
            $normalizedTelephone = preg_replace('/\D/', '', $searchParentData->telephonePere);

            $queryBuilder
                ->andWhere('t1.numero = :telephonePere')
                ->orWhere('t2.numero = :telephonePere')
                ->setParameter('telephonePere', $normalizedTelephone);
        }

        // Recherche par NINA (Père)
        if (!empty($searchParentData->ninaPere)) {
            $queryBuilder
                ->andWhere('n.designation = :ninaPere')
                ->setParameter('ninaPere', $searchParentData->ninaPere);
        }

        // Recherche par téléphone (Mère)
        if (!empty($searchParentData->telephoneMere)) {
            $normalizedTelephone = preg_replace('/\D/', '', $searchParentData->telephoneMere);

            $queryBuilder
                ->andWhere('t1.numero = :telephoneMere')
                ->orWhere('t2.numero = :telephoneMere')
                ->setParameter('telephoneMere', $normalizedTelephone);
        }

        // Recherche par NINA (Mère)
        if (!empty($searchParentData->ninaMere)) {
            $queryBuilder
                ->andWhere('n.designation = :ninaMere')
                ->setParameter('ninaMere', $searchParentData->ninaMere);
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

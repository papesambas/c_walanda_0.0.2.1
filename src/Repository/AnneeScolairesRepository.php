<?php

namespace App\Repository;

use App\Entity\AnneeScolaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnneeScolaires>
 */
class AnneeScolairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnneeScolaires::class);
    }

    /**
     * Récupère tous les enregistrements de l'entité, avec un ordre optionnel.
     *
     * @param array|null $orderBy Un tableau spécifiant l'ordre des résultats.
     *                            Exemple : ['nom' => 'ASC', 'date' => 'DESC']
     * @return array Les enregistrements trouvés.
     * @throws \InvalidArgumentException Si une colonne invalide est spécifiée dans $orderBy.
     */
    public function findAll(array $orderBy = null): array
    {
        try {
            return $this->findBy([], $orderBy);
        } catch (\Exception $e) {
            // Log l'erreur ou relancez une exception personnalisée
            throw new \InvalidArgumentException('Une erreur s\'est produite lors du tri des résultats : ' . $e->getMessage());
        }
    }

    //    /**
    //     * @return AnneeScolaires[] Returns an array of AnneeScolaires objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AnneeScolaires
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

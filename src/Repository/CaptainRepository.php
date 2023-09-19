<?php

namespace App\Repository;

use App\Entity\Captain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Captain>
 *
 * @implements PasswordUpgraderInterface<Captain>
 *
 * @method Captain|null find($id, $lockMode = null, $lockVersion = null)
 * @method Captain|null findOneBy(array $criteria, array $orderBy = null)
 * @method Captain[]    findAll()
 * @method Captain[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaptainRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Captain::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Captain) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function save(Captain $captain, bool $flush = false):void
    {
        $this->getEntityManager()->persist($captain);

        if($flush){
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Captain $captain, bool $flush = false):void
    {
        $this->getEntityManager()->remove($captain);

        if($flush){
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Captain[] Returns an array of Captain objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Captain
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

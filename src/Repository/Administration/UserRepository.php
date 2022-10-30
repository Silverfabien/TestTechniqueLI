<?php

namespace App\Repository\Administration;

use App\Entity\Security\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function update(bool $flush = false): void
    {
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }


    public function userRegisterLastDay()
    {
        $end = ['', '-1 day', '-2 day', '-3 day', '-4 day', '-5 day', '-6 day'];
        $start = ['', '', '-1 day', '-2 day', '-3 day', '-4 day', '-5 day'];
        $count = 0;

        for ($i = 0; $i < 7; $i++) {
            $dateEnd = date_create($end[$i]);
            $dateStart = date_create($start[$i]);

            $builder = $this->createQueryBuilder('u')
                ->select('u')
                ->where('u.createdAt BETWEEN :date_end AND :date_start')
                ->setParameter('date_end', date_format($dateEnd, 'Y-m-d'))
                ->setParameter('date_start',date_format($dateStart, 'Y-m-d'))
                ->orderBy('u.createdAt', 'DESC')
                ->select('u.createdAt')
                ->getQuery()
                ->getResult();

            $result[] = count($builder);
            $count += count($builder);
        }

        return [$result, $count];
    }
}

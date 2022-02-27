<?php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class UserRepository extends ServiceEntityRepository implements UserLoaderInterface{

    /**
     * @var ManagerRegistry
     */
    private ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Switch between username and email
     * @param  string  $identifier
     * @return UserInterface|null
     */
    public function loadUserByIdentifier(string $identifier): ?UserInterface
    {
        return $this->createQueryBuilder("u")
            ->where("u.email =:username")
            ->orWhere("u.username =:username")
            ->setParameter("username", $identifier)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
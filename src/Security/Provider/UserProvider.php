<?php
namespace App\Security\Provider;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /**
     * @param  string        $identifier
     * @return UserInterface
     */
    private UserLoaderInterface $userLoader;

    public function __construct(UserLoaderInterface $userLoader)
    {
        $this->userLoader = $userLoader;
    }
    /**
     * @param  string        $identifier
     * @return UserInterface
     */
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->userLoader->loadUserByIdentifier($identifier);
    }

    /**
     * @param  UserInterface $user
     * @return void
     */
    public function refreshUser(UserInterface $user)
    {
        
    }

    /**
     * @param  string $class
     * @return void
     */
    public function supportsClass(string $class)
    {
        return $class === User::class;
    }


    /**
     * @param  UserInterface $user
     * @param  string        $newEncodedPassword
     * @return void
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        // TODO: when encoded passwords are in use, this method should:
        // 1. persist the new password in the user storage
        // 2. update the $user object with $user->setPassword($newEncodedPassword);
    }


}
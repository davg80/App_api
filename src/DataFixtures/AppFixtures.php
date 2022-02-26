<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Comment;
use App\Entity\PostArticle;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordHasherInterface
     */
    private  UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $users = [];
        //Create 10 user aléatoirement
        for ($i = 0; $i < 10; $i++) {
            $user = User::create(
                (sprintf("email%d@gmail.com", $i)),
                sprintf("name%d", $i)
            );
            $plaintextPassword = "Password";
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $manager->persist($user);

            $users[] = $user;
        }

        // create posts
        foreach($users as $user) {
            for ($j = 0; $j < 5; $j++) {
                $post = PostArticle::create("Content", $user);

                shuffle($users);

                foreach (array_slice($users, 0, 5) as $userCanLike) {
                    $post->LikeBy($userCanLike);
                }

                $manager->persist($post);
                
                // create comments
                for ($k=0; $k < 10; $k++) { 
                    $comment = Comment::create(
                        sprintf("Message%d", $k), 
                        $users[array_rand($users)], 
                        $post
                    );
                }
                $manager->persist($comment);
            }
        }



        $manager->flush();
    }
}

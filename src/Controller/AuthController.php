<?php
namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Namshi\JOSE\JWT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthController{

    /**
     * @param  User                   $user
     * @param  SerializerInterface    $serializer
     * @param  EntityManagerInterface $entityManager
     * @param  ValidatorInterface     $validator
     * @return void
     */
    #[Route('/register', name:'api_register', methods:['POST'])]
    public function register(
        User $user,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
    ){

        // dd($user);
        $errors = $validator->validate($user);

        if($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST,[], true);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(
            $serializer->serialize($user, 'json', ["groups" => "users"]),
            JsonResponse::HTTP_CREATED,
            [],
            true
        );
    }

   public function getTokenUser(UserInterface $user, JWTTokenManagerInterface $jwtManager)
   {
       return new JsonResponse(['token' => $jwtManager->create($user)]);
   }

}
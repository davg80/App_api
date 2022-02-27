<?php
namespace App\Controller;

use App\Entity\Article;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class PostController
 * @package App\Controller
 */
#[Route('/articles')]
class PostController
{
    /**
     * @param  PostRepository $postRepository
     * @param SerializerInterface $serializer 
     * @return JsonResponse
     */
    #[Route(name: 'api_articles', methods:['GET'])]
    public function collection(PostRepository $postRepository, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($postRepository->findAll(), 'json', ["groups" => "articles"]),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     *  @param Article $article
     *  @param SerializerInterface $serializer 
     *  @return JsonResponse
     */
    #[Route('/{id}', name: 'api_article', methods:['GET'])]
    public function article(PostRepository $postRepository, SerializerInterface $serializer, $id): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($postRepository->find($id), 'json', ["groups" => "articles"]),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @param  Request  $request
     * @param Article $article
     * @param  SerializerInterface $serializer
     * @return JsonResponse
     */
    #[Route(name: 'api_article_create', methods:['POST'])]
    public function create(
        Article $article,
        SerializerInterface $serializer, 
        EntityManagerInterface $entityManager, 
        UrlGeneratorInterface $urlGenerator,
        ValidatorInterface $validator
    ): JsonResponse {
        //$article = $serializer->deserialize($request->getContent(), Article::class, 'json');
        // Temp for not error
        // $article->setAuthor($entityManager->getRepository(User::class)->findOneBy([]));
        $errors = $validator->validate($article);

        if($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST,[], true);
        }

        $entityManager->persist($article);
        $entityManager->flush();

        return new JsonResponse(
            $serializer->serialize($article, 'json', ["groups" => "articles"]),
            JsonResponse::HTTP_CREATED,
            ["Location" => $urlGenerator->generate('api_article', ["id" => $article->getId()])],
            true
        );

    }

    /**
     * @param  Article            $article
     * @param  EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'api_article_update', methods:['PUT'])]
    public function update(
        Article $article,
        SerializerInterface $serializer,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $errors = $validator->validate($article);

        if($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), JsonResponse::HTTP_BAD_REQUEST,[], true);
        }
        $entityManager->flush();
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }


    /**
     * @param  Article            $article
     * @param  EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'api_article_delete', methods:['DELETE'])]
    public function delete(
        Article $article, 
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $entityManager->remove($article);
        $entityManager->flush();
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
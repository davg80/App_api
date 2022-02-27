<?php
namespace App\Controller;

use App\Entity\PostArticle;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

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
     *  @param PostArticle $post_article
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
     * @param PostArticle $post_article
     * @param  SerializerInterface $serializer
     * @return JsonResponse
     */
    #[Route(name: 'api_article_create', methods:['POST'])]
    public function create(
        PostArticle $post_article,
        SerializerInterface $serializer, 
        EntityManagerInterface $entityManager, 
        UrlGeneratorInterface $urlGenerator
    ): JsonResponse {
        //$post_article = $serializer->deserialize($request->getContent(), PostArticle::class, 'json');
        // Temp for not error
        // $post_article->setAuthor($entityManager->getRepository(User::class)->findOneBy([]));
        $entityManager->persist($post_article);
        $entityManager->flush();

        return new JsonResponse(
            $serializer->serialize($post_article, 'json', ["groups" => "articles"]),
            JsonResponse::HTTP_CREATED,
            ["Location" => $urlGenerator->generate('api_article', ["id" => $post_article->getId()])],
            true
        );

    }

    /**
     * @param  PostArticle            $post_article
     * @param  EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'api_article_update', methods:['PUT'])]
    public function update(
        PostArticle $post_article,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $entityManager->flush();
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }


    /**
     * @param  PostArticle            $post_article
     * @param  EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'api_article_delete', methods:['DELETE'])]
    public function delete(
        PostArticle $post_article, 
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $entityManager->remove($post_article);
        $entityManager->flush();
        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
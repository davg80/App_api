<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @package App\Controller
 */
#[Route('/articles')]
class PostController
{
    #[Route(name: 'api_articles', methods:['GET'])]
    public function collection(): JsonResponse
    {
        
        return new JsonResponse([]);
    }
}
<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 */
class DefaultController
{
    /**
     * @Route("/")
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(['success' => true]);
    }
}

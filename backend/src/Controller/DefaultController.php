<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->json(['success' => true]);
    }
}

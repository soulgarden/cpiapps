<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations\View as RestView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @RestView()
     * @return array
     */
    public function index(): array
    {
        return ['success' => true];
    }
}

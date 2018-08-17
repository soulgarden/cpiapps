<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations\View as ViewAnnotation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     * @ViewAnnotation()
     * @return array
     */
    public function index(): array
    {
        return ['success' => true];
    }
}

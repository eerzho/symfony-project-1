<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'test', methods:['GET'])]
    public function index(): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return $this->json(['message' => 'success']);
    }
}

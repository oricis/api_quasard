<?php

namespace App\Controller\api\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/v1/users', name: 'all_users')]
    public function findAll(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => [],
        ]);
    }
}

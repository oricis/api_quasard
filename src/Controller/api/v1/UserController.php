<?php

namespace App\Controller\api\v1;

use App\Util\Interfaces\ApiCrudInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController implements ApiCrudInterface
{
    // DELETE | [domain]/api/v1/users/delete/[id]
    // GET    | [domain]/api/v1/users
    // GET    | [domain]/api/v1/users/find/[id]
    // POST   | [domain]/api/v1/users/create
    // PUT    | [domain]/api/v1/users/update

    #[Route('/api/v1/users/find/{id}', name: 'find_user')]
    public function find(int $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => [
                'id' => $id, // TODO:
            ],
        ]);
    }

    #[Route('/api/v1/users', name: 'all_users')]
    public function findAll(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => [], // TODO:
        ]);
    }

    #[Route('/api/v1/users/create', name: 'create_user')]
    public function create(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => [
                'success' => false, // TODO:
                'id' => 1,
            ],
        ]);
    }

    #[Route('/api/v1/users/update', name: 'update_user')]
    public function update(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => [
                'success' => false, // TODO:
                'id' => 1,
            ],
        ]);
    }

    #[Route('/api/v1/users/delete/{id}', name: 'delete_user')]
    public function delete(int $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => [
                'success' => false, // TODO:
            ],
        ]);
    }
}

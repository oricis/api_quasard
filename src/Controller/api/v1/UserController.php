<?php

namespace App\Controller\api\v1;

use App\Repository\UserRepository;
use App\Util\Interfaces\ApiCrudInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController implements ApiCrudInterface
{
    // DELETE | [domain]/api/v1/users/delete/[id]
    // GET    | [domain]/api/v1/users
    // GET    | [domain]/api/v1/users/find-notes/[id]
    // GET    | [domain]/api/v1/users/find-notes/[id]/old
    // GET    | [domain]/api/v1/users/find/[id]
    // POST   | [domain]/api/v1/users/create
    // PUT    | [domain]/api/v1/users/update

    private UserRepository $repository;


    public function __construct(UserRepository $repository)
    {
        $repository->setAttributes([
            'id',
            'name',
            'email',
            'active',
        ]);
        $this->repository = $repository;
    }

    #[Route('/api/v1/users/find/{id}', name: 'find_user', requirements: ['id' => '\d+'])]
    public function find(int $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => $this->repository->find($id),
        ]);
    }

    #[Route('/api/v1/users', name: 'all_users')]
    public function findAll(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => $this->repository->findAll(),
        ]);
    }

    #[Route('/api/v1/users/find-notes/{id}', name: 'find_user_notes', requirements: ['id' => '\d+'])]
    public function findNotes(int $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => $this->repository->findUserNotes($id, true, 'id,text,user_id'),
        ]);
    }

    #[Route('/api/v1/users/find-notes/{id}/old', name: 'find_old_user_notes', requirements: ['id' => '\d+'])]
    public function findOldNotes(int $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => $this->repository->findOldUserNotes($id, true, 'id,text,user_id'),
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

    #[Route('/api/v1/users/delete/{id}', name: 'delete_user', requirements: ['id' => '\d+'])]
    public function delete(int $id, Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => [
                'success' => false, // TODO:
            ],
        ]);
    }
}

<?php

namespace App\Controller\api\v1;

use App\Repository\CategoryRepository;
use App\Util\Interfaces\ApiCrudInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController implements ApiCrudInterface
{
    // DELETE | [domain]/api/v1/categories/delete/[id]
    // GET    | [domain]/api/v1/categories
    // GET    | [domain]/api/v1/categories/find-notes/[id]
    // GET    | [domain]/api/v1/categories/find/[id]
    // POST   | [domain]/api/v1/categories/create
    // PUT    | [domain]/api/v1/categories/update

    private CategoryRepository $repository;


    public function __construct(CategoryRepository $repository)
    {
        $repository->setAttributes([
            'id',
            'name',
            'description',
            'active',
        ]);
        $this->repository = $repository;
    }

    #[Route('/api/v1/categories/find/{id}', name: 'find_category', requirements: ['id' => '\d+'])]
    public function find(int $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => $this->repository->find($id),
        ]);
    }

    #[Route('/api/v1/categories', name: 'all_categories')]
    public function findAll(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => $this->repository->findAll(),
        ]);
    }

    #[Route('/api/v1/categories/create', name: 'create_category')]
    public function create(Request $request): JsonResponse
    {
        if ($request->getMethod() === 'POST') {
            $result = $this->repository->create($request);
            $message = ($result)
                ? 'Category created!'
                : 'Error creating category';
        }

        return new JsonResponse([
            'message' => $message ?? 404,
            'data' => [
                'success' => (bool) ($result ?? false),
            ],
        ]);
    }

    #[Route('/api/v1/categories/update', name: 'update_category')]
    public function update(Request $request): JsonResponse
    {
        if ($request->getMethod() === 'PUT') {
            $result = $this->repository->update($request);
            $message = ($result)
                ? 'Category updated!'
                : 'Error updating category';
        }

        return new JsonResponse([
            'message' => $message ?? 404,
            'data' => [
                'success' => (bool) ($result ?? false),
            ],
        ]);
    }

    #[Route('/api/v1/categories/delete/{id}', name: 'delete_category', requirements: ['id' => '\d+'])]
    public function delete(int $id, Request $request): JsonResponse
    {
        if ($request->getMethod() === 'DELETE') {
            $result = $this->repository->delete($id);
            $message = ($result)
                ? 'Category deleted!'
                : 'Error deleting category';
        }

        return new JsonResponse([
            'message' => $message ?? 404,
            'data' => [
                'success' => (bool) ($result ?? false),
            ],
        ]);
    }
}

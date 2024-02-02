<?php

namespace App\Controller\api\v1;

use App\Repository\NoteRepository;
use App\Util\Interfaces\ApiCrudInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController implements ApiCrudInterface
{
    // DELETE | [domain]/api/v1/notes/delete/[id]/user/[user_id]
    // GET    | [domain]/api/v1/notes/find/[id]
    // POST   | [domain]/api/v1/notes/create
    // PUT    | [domain]/api/v1/notes/remove-category
    // PUT    | [domain]/api/v1/notes/set-category
    // PUT    | [domain]/api/v1/notes/update

    private NoteRepository $repository;


    public function __construct(NoteRepository $repository)
    {
        $repository->setAttributes([
            'id',
            'text',
            'user_id',
        ]);
        $this->repository = $repository;
    }

    #[Route('/api/v1/notes/find/{id}', name: 'find_note', requirements: ['id' => '\d+'])]
    public function find(int $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => $this->repository->find($id),
        ]);
    }

    #[Route('/api/v1/notes/create', name: 'create_note')]
    public function create(Request $request): JsonResponse
    {
        if ($request->getMethod() === 'POST') {
            $result = $this->repository->create($request);
            $message = ($result)
                ? 'Note created!'
                : 'Error creating note';
        }

        return new JsonResponse([
            'message' => $message ?? 404,
            'data' => [
                'success' => (bool) ($result ?? false),
            ],
        ]);
    }

    #[Route('/api/v1/notes/update', name: 'update_note')]
    public function update(Request $request): JsonResponse
    {
        if ($request->getMethod() === 'PUT') {
            $result = $this->repository->update($request);
            $message = ($result)
                ? 'Note updated!'
                : 'Error updating note';
        }

        return new JsonResponse([
            'message' => $message ?? 404,
            'data' => [
                'success' => (bool) ($result ?? false),
            ],
        ]);
    }

    #[Route('/api/v1/notes/remove-category', name: 'remove_note_category')]
    public function removeCategory(Request $request): JsonResponse
    {
        if ($request->getMethod() === 'PUT') {
            $result = $this->repository->removeCategory($request);
            $message = ($result)
                ? 'Note updated!'
                : 'Error updating note';
        }

        return new JsonResponse([
            'message' => $message ?? 404,
            'data' => [
                'success' => (bool) ($result ?? false),
            ],
        ]);
    }

    #[Route('/api/v1/notes/set-category', name: 'set_note_category')]
    public function setCategory(Request $request): JsonResponse
    {
        if ($request->getMethod() === 'PUT') {
            $result = $this->repository->setCategory($request);
            $message = ($result)
                ? 'Note updated!'
                : 'Error updating note';
        }

        return new JsonResponse([
            'message' => $message ?? 404,
            'data' => [
                'success' => (bool) ($result ?? false),
            ],
        ]);
    }

    #[Route('/api/v1/notes/delete/{id}', name: 'delete_note', requirements: ['id' => '\d+'])]
    public function delete(int $id, Request $request): JsonResponse
    {
        if ($request->getMethod() === 'DELETE') {
            $result = $this->repository->delete($id);
            $message = ($result)
                ? 'Note deleted!'
                : 'Error deleting note';
        }

        return new JsonResponse([
            'message' => $message ?? 404,
            'data' => [
                'success' => (bool) ($result ?? false),
            ],
        ]);
    }
}

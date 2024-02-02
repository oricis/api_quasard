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

    #[Route('/api/v1/notes/find-notes/{id}', name: 'find_note_notes', requirements: ['id' => '\d+'])]
    public function findNotes(int $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => $this->repository->findNoteNotes($id, true, 'id,text,note_id'),
        ]);
    }

    #[Route('/api/v1/notes/find-notes/{id}/old', name: 'find_old_note_notes', requirements: ['id' => '\d+'])]
    public function findOldNotes(int $id): JsonResponse
    {
        return new JsonResponse([
            'message' => 'From ' . go(),
            'data' => $this->repository->findOldNoteNotes($id, true, 'id,text,note_id'),
        ]);
    }

    #[Route('/api/v1/notes/create', name: 'create_note')]
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

    #[Route('/api/v1/notes/update', name: 'update_note')]
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

    #[Route('/api/v1/notes/delete/{id}', name: 'delete_note', requirements: ['id' => '\d+'])]
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

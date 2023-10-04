<?php

namespace App\Services;

use App\Repositories\TodoRepository;

class TodoService
{
    protected $repository;

    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($id, $data, $userId)
    {
        return $this->repository->update($id, $data, $userId);
    }

    public function delete($id, $userId)
    {
        $this->repository->delete($id, $userId);
    }

    public function find($id, $userId)
    {
        return $this->repository->find($id, $userId);
    }

    public function all($userId)
    {
        return $this->repository->getAllByUser($userId);
    }
}

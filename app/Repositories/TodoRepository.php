<?php

namespace App\Repositories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodoRepository
{
    protected $model;

    public function __construct(Todo $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data, $userId)
    {
        $todo = $this->find($id, $userId);
        $todo->update($data);
        return $todo;
    }

    public function delete($id, $userId)
    {
        $todo = $this->find($id, $userId);
        $todo->delete();
    }

    public function find($id, $userId)
    {
        try {
            return $this->model->where('_id', $id)->where('user_id', $userId)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // Handle not found exception
            throw new ModelNotFoundException('Todo not found.');
        }
    }

    public function getAllByUser($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }
}

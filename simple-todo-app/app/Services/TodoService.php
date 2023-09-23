<?php

namespace App\Services;

use App\Repositories\TodoRepository;
use Illuminate\Support\Facades\Validator;
use MongoDB\Exception\InvalidArgumentException;

class TodoService
{
    protected $todoRepository;
    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function getAll()
    {
        $todo = $this->todoRepository->getAll();
        return $todo;
    }

    public function store($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required',
        ]);

        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->todoRepository->store($data);
        return $result;
    }
}
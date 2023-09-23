<?php

namespace App\Repositories;

use App\Models\Todo;
use PhpParser\Node\Expr\Cast\Object_;

class TodoRepository
{
    protected $todo;
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function getAll()
    {
        $todo = $this->todo->get();
        return $todo;
    }

    public function store($data)
    {
        $addData = new $this->todo;
        $addData->title = $data['title'];
        $addData->save();
        return $addData->fresh();
    }
}
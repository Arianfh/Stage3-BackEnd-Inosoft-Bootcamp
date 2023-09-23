<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Exception;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected $todoService;
    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function getTodoList()
    {
        try {
            $result = $this->todoService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function addTodo(Request $request)
    {
        $data = $request->only(['title']);

        $result = ['status' => 201];

        try {
            $result['data'] = $this->todoService->store($data);
        } catch (Exception $e) {
            $result = [
                'status' => 422,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}

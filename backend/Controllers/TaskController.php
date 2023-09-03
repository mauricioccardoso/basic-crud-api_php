<?php

namespace App\Controllers;

use App\Core\Abstractions\Repository;
use App\Core\Abstractions\Response;
use App\Core\Request;
use App\Models\Task;

class TaskController
{
    public function __construct()
    {
    }

    // To do - Add body params validation

    public function index()
    {
        $task = new Task();
        $taskRespository = new Repository($task);

        $tasks = $taskRespository->getAll();

        return Response::json($tasks);
    }

    public function store(Request $request)
    {
        $task = new Task();
        $taskRespository = new Repository($task);

        $data = $taskRespository->create($request->body());

        return Response::json($data, 201);
    }

//    To do - Receive route params

//    public function update(Request $request, $id)
//    {
//        $task = new Task();
//        $taskRespository = new Repository($task);
//
//        $data = $taskRespository->update($id, $request->body());
//
//        return Response::json([], 204);
//    }
//
//    public function delete($id)
//    {
//        $task = new Task();
//        $taskRespository = new Repository($task);
//
//        $taskRespository->delete($id);
//
//        return Response::json([], 204);
//    }
}
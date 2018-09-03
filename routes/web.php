<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/todo', function () use ($router) {
    return [
        [
            'id' => 1,
            'title' => '',
            'checked' => false,
        ],
        [
            'id' => 2,
            'title' => '',
            'checked' => false,
        ],
        [
            'id' => 3,
            'title' => '',
            'checked' => false,
        ],
    ];
});

$router->get('/todo-protobuf-json', function () use ($router) {
    $todoList = new \Todo\TodoList;
    $tempTodoList = [];
    foreach (range(1, 3) as $i) {
        $todo = new \Todo\Todo;
        $todo->setId($i);
        $todo->setTitle('ほげ');
        $todo->setChecked(true);
        $tempTodoList[] = $todo;
    }
    $todoList->setTodos($tempTodoList);
    return $todoList->serializeToJsonString();
});

$router->get('/todo-protobuf-binary', function () use ($router) {
    $todoList = new \Todo\TodoList;
    $tempTodoList = [];
    foreach (range(1, 3) as $i) {
        $todo = new \Todo\Todo;
        $todo->setId($i);
        $todo->setTitle('ほげ');
        $todo->setChecked(true);
        $tempTodoList[] = $todo;
    }
    $todoList->setTodos($tempTodoList);
    return $todoList->serializeToString();
});

// 適当な差分

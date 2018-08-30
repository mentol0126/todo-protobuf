<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function testGetTodo()
    {
        $this->get('/todo');

        $expected = json_encode([
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
        ]);
        $this->assertEquals(
            $expected, $this->response->getContent()
        );
    }

    public function testGetTodoProtobufJson()
    {
        $this->get('todo-protobuf-json');

        $expected = json_encode([
            'todos' => [
                [
                    'id' => 1,
                    'title' => 'ほげ',
                    'checked' => true,
                ],
                [
                    'id' => 2,
                    'title' => 'ほげ',
                    'checked' => true,
                ],
                [
                    'id' => 3,
                    'title' => 'ほげ',
                    'checked' => true,
                ],
            ]
        ]);
        $this->assertEquals(
            $expected, $this->response->getContent()
        );
    }

    public function testGetTodoProtobufBinary()
    {
        $this->get('todo-protobuf-binary');

        $expected = json_encode([
            'todos' => [
                [
                    'id' => 1,
                    'title' => 'ほげ',
                    'checked' => true,
                ],
                [
                    'id' => 2,
                    'title' => 'ほげ',
                    'checked' => true,
                ],
                [
                    'id' => 3,
                    'title' => 'ほげ',
                    'checked' => true,
                ],
            ]
        ]);

        $todoList = new \Todo\TodoList;
        $this->assertNotEquals(
            $expected, $todoList->serializeToJsonString()
        );

        $todoList->mergeFromString($this->response->getContent());

        $this->assertEquals(
            $expected, $todoList->serializeToJsonString()
        );
    }
}

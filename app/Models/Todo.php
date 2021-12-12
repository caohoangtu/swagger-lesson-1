<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Todo extends Model
{
    use HasFactory;

    protected $table="todo";

    /**
     * @param array $attributes
     * @return Todo
     */
    public function createTodo(array $attributes){
        $todo = new self();
        $todo->title = $attributes["title"];
        $todo->content = $attributes["content"];
        $todo->save();
        return $todo;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTodo(int $id){
        $todo = $this->where("id",$id)->first();
        return $todo;
    }

    /**
     * @return Todo[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getsTodo(){
        $todos = $this::all();
        return $todos;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function updateTodo(int $id, array $attributes){
        $todo = $this->getTodo($id);
        if($todo == null){
            throw new ModelNotFoundException("Cant find todo");
        }
        $todo->title = $attributes["title"];
        $todo->content = $attributes["content"];
        $todo->save();
        return $todo;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteTodo(int $id){
        $todo = $this->getTodo($id);
        if($todo == null){
            throw new ModelNotFoundException("Todo item not found");
        }
        return $todo->delete();
    }
}

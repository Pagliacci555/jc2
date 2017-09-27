<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToDoController extends Controller
{
    function GetToDo(){

        // $obj1 = new \stdClass; // anonymous class in php
        // $obj1->todo = "To Do 1";
        // $obj1->deleted = false;

        // $obj2 = new \stdClass;
        // $obj2->todo = "To Do 2";
        // $obj2->deleted = true;

        // $obj3 = new \stdClass;
        // $obj3->todo = "To Do 3";
        // $obj3->deleted = false;
        
        // $todoList = array($obj1, $obj2, $obj3);

        $todoList = DB::select('select * from todo where deleted = 0');
        return view('page.todo', ["data" => $todoList]);
    }

    function AddToDo(Request $request){
        $mytodo = $request->mytodo;    
        
        DB::insert('insert into todo (description, deleted) values (?, ?)', [$mytodo, false]);
    
        return redirect('/todo');
    }

    function DeleteToDo($id){
        //DB::delete('delete from todo where id = ?', [$id]);
        DB::update('update todo set deleted = 1 where id = ?', [$id]);
        return redirect('/todo');
    }

}
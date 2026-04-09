<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('index',compact('todos'));
    }

    public function store(TodoRequest $request)
    {
        Todo::create(
            $request->only(['content'])
         );
          return redirect('/')->with('success', 'Todoを作成しました');

    }
    public function update(Request $request)
    {
        $todo = Todo::find($request->id);
        $todo->update([
            'content' =>$request->content
        ]);

        return redirect('/')->with('success','Todoを更新しました');
    }
    public function destroy(Request $request)
    {
       Todo::find($request->id)->delete();
    return redirect('/')->with('success', 'Todoを削除しました'); 
    }
}

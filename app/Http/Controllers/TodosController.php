<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;//madel
use Illuminate\Support\Facades\Session;

class TodosController extends Controller
{
    public function index(){
        $todos = Todo::all();
        return view('todos.index')->with('todos',$todos);
    }

    public function create(){
        return view('todos.create');
    }

    public function store(Request $request){
        //form validation
        $this->validate($request,[
            'title' => 'required|unique:todos|max:20',
            'content' => 'required'
        ]);

        $todo = new Todo;
        $todo ->title = $request->title;
        $todo->content = $request->content;
        $todo->save();

        Session::flash('success','Todo created Successfully');

        //return redirect back to index page
        return redirect()->route('todos.index');

    }

    public function show(Todo $todo){
        //Route Model Binding
        //$todo = Todo::find($id);
        return view('todos.show')->with('todo',$todo);
    }

    public function edit(Todo $todo){
        //$todo = Todo::find($id);
        return view('todos.edit')->with('todo',$todo);
    }

    public function update(Request $request, Todo $todo){
        //form validation
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required'
        ]);

        //update data into database
        //$todo = Todo::find(Todo $todo);
        $todo ->title = $request->title;
        $todo->content = $request->content;
        $todo->save();

        Session::flash('success','Todo Update Successfully');

        //return redirect back to index page
        return redirect()->route('todos.index');

    }

    public function delete(Todo $todo){
        //$todo = Todo::find($id);
        //dd(request()->all());
        $todo->delete();




        Session::flash('success','Todo delete successfully');
        return redirect()->back();
    }

    public function done($id){
        $todo = Todo::find($id);

        $todo->done = 1;
        $todo->save();

        Session::flash('success','Todo finishued successfully');
        return redirect()->route('todos.index');
    }

    public function not_done($id){
        $todo = Todo::find($id);

        $todo->done = 0;
        $todo->save();

        Session::flash('success','Todo pending..');
        return redirect()->route('todos.index');
    }
}

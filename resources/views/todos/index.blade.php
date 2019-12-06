@extends('layouts.app')
@section('content')
​
<div class="card">
    <div class="card-header">Todos</div>
​
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if(count($todos) > 0)
            <ul class="list-group">
                @foreach($todos as $todo)
                    <li class="list-group-item">
                        {{ $todo->title }}
                        @if(Auth::check())
                            <form action="{{ route('todos.delete',['id'=>$todo->id])}}" method="POST">
                                @csrf <!--cross site request forgery -->
                                <!--Form method spoofing-->
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger float-right">Delete</button>
                            </form>
                            <a href="{{ route('todos.edit',['id'=>$todo->id])}}" class="btn btn-secondary float-right mr-2">Edit</a>
                        @endif
                        <a href="{{ route('todos.show',['id'=>$todo->id])}}" class="btn btn-primary btn-sm float-right mr-2"><i class="far fa-eye"></i></a>
                        @if($todo->done)
                            <a href="{{ route('todos.not-done',['id'=>$todo->id])}}" class="btn btn-warning btn-sm float-right mr-2"><i class="fas fa-check"></i></a>
                        @else
                            <a href="{{ route('todos.done',['id'=>$todo->id])}}" class="btn btn-danger btn-sm float-right mr-2"><i class="fas fa-times"></i></a>
                        @endif
                @endforeach
            </ul>
        @endif
    </div>
</div>
​
​
​
@endsection

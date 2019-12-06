@extends('layouts.app')
@section('content')

<div class="card">
        <div class="card-header">{{ $todo->title }}</div>

        <div class="card-body">
            <div>{{ $todo->content }}</div>
            <a href="{{ route('todos.index')}}" class="btn btn-secondary float-right">Go Back</a>
        </div>
</div>


@endsection

@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Todo</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('todos.create') }}"> Create New Todo</a>
            </div>
        </div>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @foreach($todos as $td)

    <form action="{{ route('todos.destroy', $td->title) }}" method="post">
        <a class="btn btn-info" href="{{ route('todos.show', $td->title) }}">Show</a>
        <a class="btn btn-primary" href="{{ route('todos.edit', $td->title) }}">Edit</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    {{ $todos->links() }}
    @endforeach

@endsection

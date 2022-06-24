@extends('layout')

@section('content')
<style>
    .uper{
        margin-top: 40px;
    }
    .delete{
        display: inline;
    }
</style>
<div class="card uper">
    @if(session()->get('success'))
        <div class="alert alert-info">
            {{ session()->get('success') }}
        </div>
    @endif
    <a href="{{ route('shows.create') }}" class="btn btn-primary" type="button">Add Show</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Show name</th>
                <th>Genre</th>
                <th>IMDB rating</th>
                <th>Leader actor</th>
                <th colspan='2'>actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shows as $show)
            <tr>
                <td>{{ $show->id }}</td>
                <td>{{ $show->show_name }}</td>
                <td>{{ $show->genre }}</td>
                <td>{{ $show->imdb_rating }}</td>
                <td>{{ $show->leader_actor }}</td>
                <td>
                    <a href="{{ route('shows.edit', $show->id) }}" class="btn btn-info">edit</a>
                    <form class="delete" action="{{ route('shows.destroy', $show->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
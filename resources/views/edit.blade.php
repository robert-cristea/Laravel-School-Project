@extends('layout')
@section('content')
<style>
    .uper{
        margin-top: 40px;
    }
</style>
<div class="card uper">
    <div class="card-header">
        Update show
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-info">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('shows.update', $show->id) }}" method="post">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label for="show_name">Show name</label>
                <input type="text" class="form-control" name="show_name" value="{{ $show->show_name }}">
            </div>
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" class="form-control" name="genre" value="{{ $show->genre }}">
            </div>
            <div class="form-group">
                <label for="imdb_rating">Imdb rating</label>
                <input type="text" class="form-control" name="imdb_rating" value="{{ $show->imdb_rating }}">
            </div>
            <div class="form-group">
                <label for="leader_actor">Leader Actor</label>
                <input type="text" class="form-control" name="leader_actor" value="{{ $show->leader_actor }}">
            </div>
            <button type="submit" class="btn btn-primary">update</button>
        </form>
    </div>
</div>
@endsection
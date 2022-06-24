@extends('layout')

@section('content')
<style>
    .uper{
        margin-top: 40px;
    }
</style>
<div class="card uper">
    <div class="card-header">
        Add show
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{ route('shows.store') }}" method="post">
                <div class="form-group">
                    @csrf
                    <label for="name">Show name :</label>
                    <input type="text" name="show_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="price">Show genre :</label>
                    <input type="text" name="genre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="price">IMDB rating :</label>
                    <input type="text" name="imdb_rating" class="form-control">
                </div>
                <div class="form-group">
                    <label for="quality">Show leader actor</label>
                    <input type="text" name="leader_actor" class="form-control">
                </div>
                <button type="submit" class="btn btn-danger">Create Show</button>
            </form>
    </div>
</div>
@endsection
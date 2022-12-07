@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <form action="{{route('matches.store')}}" class="form form-control">
            <div class="input-group row">
                <label for="name" class="col-form-label">Wedstijd naam:</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="from-control">
                </div>
            </div>
            <div class="form-group row justify-content-between">
                <label for="player-1" class="col-form-label">Speler 1:</label>
                <select class="col-auto form-control w-25" name="player-1">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group row justify-content-between">
                <label for="player-2" class="col-form-label">Speler 2:</label>
                <select class="col-auto form-control w-25" name="player-2">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group row justify-content-between">
                <label for="coach" class="col-form-label">Schijdsrechter:</label>
                <select class="col-3 mx-2 form-control w-25" name="coach">
                    @foreach ($coaches as $coach)
                    <option value="{{$coach->id}}">{{$coach->name}}</option>
                @endforeach
                </select>
            </div>
            <input type="submit" class="btn btn-success text-white mt-1" value="Match aan maken!">
        </form>
    </div>
</div>
@endsection
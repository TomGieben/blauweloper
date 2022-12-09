@extends('layouts.app')
@section('content')
@if(auth()->user()->hasRight([
    'administrator',
    'secretariaat',
    'scheidsrechter',
    'scholier-begeleider',
]))
<div class="container">
    <div class="card">
        <form action="{{route('matches.store')}}" class="form form-control" method="POST">
            @method('POST')
            @csrf
            <div class="input-group row">
                <label for="name" class="col-form-label">Wedstijd naam:</label>
                <div class="col-lg-3">
                    <input type="text" name="name" class="from-control">
                </div>
            </div>
            <div class="input-group row">
                <label for="date" class="col-form-label">Datum</label>
                <div class="col-lg-3">
                    <input type="datetime-local" name="date" class="from-control">
                </div>
            </div>
            <div class="form-group row justify-content-between">
                <label for="player-1" class="col-form-label">Speler 1:</label>
                <select class="col-auto mx-2 form-control w-25" name="player1" onchange="dNone()">
                    @foreach ($users as $user)
                        <option id="" value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group row justify-content-between">
                <label for="player-2" class="col-form-label">Speler 2:</label>
                <select class="col-auto mx-2 form-control w-25" name="player2">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group row justify-content-between">
                <label for="coach" class="col-form-label">Schijdsrechter:</label>
                <select class="col-auto mx-2 form-control w-25" name="coach">
                    @foreach ($coaches as $coach)
                    <option value="{{$coach->id}}">{{$coach->name}}</option>
                @endforeach
                </select>
            </div>
            <input type="submit" class="btn btn-success text-white mt-2" value="Match aan maken!">
        </form>
    </div>
</div>
<script>
    function dNone(){

    }
</script>
@endif
@endsection
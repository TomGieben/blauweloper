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
            <div class="card-header">
                Wedstrijd maken.
            </div>
            <div class="form form-control">
                <div class="row justify-content-between mt-2">
                    <select class="col-lg-3" name="player-1">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row justify-content-between mt-2">
                    <select class="col-lg-3" name="player-2">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row justify-content-between mt-2">
                    <select class="col-lg-3" name="coach">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
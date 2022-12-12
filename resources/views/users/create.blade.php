    
@extends('layouts.app')

@section('content')
    @if(auth()->user()->hasRight([
        'administrator',
        'secretariaat',
    ]))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <div class="card-title">
                                        Maken gebruiker
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary"> 
                                        Terug
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('users.store') }}" method="post" autocomplete="off">
                                @method('post')
                                @csrf
                                <div class="row justify-content-between">
                                    <div class="col-md-6">
                                        <label for="name">Naam</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="password">Wachtwoord</label>
                                        <input type="password" class="form-control" id="password" name="password" value="{{auth()->user()->generatePassword()}}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="rights">Rechten</label>
                                        <select class="multiple form-control" id="rights" name="rights[]" multiple="multiple">
                                            @foreach ($rights as $right)
                                                <option value="{{$right->id}}">{{$right->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="groups">Groep</label>
                                        <select class="multiple form-control" id="groups" name="groups[]" multiple="multiple">
                                            @foreach ($groups as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-success text-white">
                                        <i class="fas fa-save"></i> Toevoegen
                                    </button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
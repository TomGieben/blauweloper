@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <div class="card-title">
                                    Edit user
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('users.index') }}" class="btn btn-primary"> 
                                    Terug
                                </a>
                            </div> 
                        
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.update', $user) }}" method="post" autocomplete="off">
                            @method('post')
                            @csrf
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <label for="name"><h4>Naam<h4></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <label for="email"><h4>Email<h4></label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <label for="password"><h4>Wachtwoord<h4></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>

                            <div class="row justify-content-between mt-2">
                                    <select class="multiple col-lg-3" name="rights[]" multiple="multiple">
                                    </select>
                            </div>

                            <div class="row justify-content-between mt-3">
                                    <select class="multiple col-lg-3" name="groups[]" multiple="multiple">
                                    </select>
                            </div>

                            <div class="row justify-content-between">
                                <div class="col-auto">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-success">Toevoegen</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
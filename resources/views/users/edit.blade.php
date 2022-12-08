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
                            @method('put')
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
                                    @foreach ($rights as $right) 
                                        <option value="{{$right->id}}" @if($user->hasRight([$right->slug])) selected @endif>{{$right->name}}</option>
                                    @endforeach
                                </select>
                        </div>

                        <div class="row justify-content-between mt-3">
                            <select class="multiple col-lg-3" name="groups[]" multiple="multiple">
                                @foreach ($groups as $group)
                                    <option value="{{$group->id}}" @if($user->inGroup($group->slug)) selected @endif>{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="card-footer">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success text-white">
                                    <i class="fas fa-save"></i> Opslaan
                                </button>
                            </form>
                            </div>
                            <div class="col-auto">
                                <form method="POST" action="{{ route('users.destroy', [$user]) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                            
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger text-white delete-user">
                                            <i class="fas fa-trash"></i> Verwijder
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>





                </div>
            </div>
        </div>
    </div>
@endsection
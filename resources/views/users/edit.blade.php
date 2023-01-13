@extends('layouts.app')

@section('content')

    @if(auth()->user()->hasRight([
        'administrator',
        'secretariaat',
    ]) || auth()->user()->id == $user->id)

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <div class="card-title">
                                        Gebruiker wijzigen
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
                                    <div class="col-md-6">
                                        <label for="name">Naam</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                    </div>
  
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="password">Wachtwoord</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    @if(auth()->user()->hasRight([
                                        'administrator',
                                        'secretariaat',
                                    ]))
                                        <div class="col-md-6">
                                            <label for="rights">Rechten</label>
                                            <select class="multiple form-control" id="rights" name="rights[]" multiple="multiple">
                                                @foreach ($rights as $right) 
                                                    <option value="{{$right->id}}" @if($user->hasRight([$right->slug])) selected @endif>{{$right->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <label for="groups">Groepen</label>
                                        <select class="multiple form-control" id="groups" name="groups[]" multiple="multiple">
                                            @foreach ($groups as $group)
                                                <option value="{{$group->id}}" @if($user->inGroup($group->slug)) selected @endif>{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
    @endif
@endsection
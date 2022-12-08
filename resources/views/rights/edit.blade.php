@extends('layouts.app')

@section('content')
    @if(auth()->user()->hasRight([
        'administrator',
    ]))
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('rights.update', [$right]) }}">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-header">
                    Recht {{ $right->name }} bewerken
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="name">Naam</label>
                        <input class="form-control" type="text" name="name" id="name" autocomplete="off" value="{{ $right->name }}">
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
                            <form method="POST" action="{{ route('rights.destroy', [$right]) }}">
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
    @endif
@endsection
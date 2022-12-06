@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <form method="POST" action="{{ route('rights.store') }}">
        @method('POST')
        @csrf
        <div class="card">
            <div class="card-header">
                Recht aanmaken
            </div>
            <div class="card-body">
                <div class="form-group mb-2">
                    <label for="name">Naam</label>
                    <input class="form-control" type="text" name="name" id="name" autocomplete="off" value="{{ old('name') }}">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Opslaan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
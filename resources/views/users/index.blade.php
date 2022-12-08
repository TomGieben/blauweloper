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
                                    Users
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('users.create') }}" class="btn btn-success text-white">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div> 
                        
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Naam</th>
                                    <th scope="col">Opties</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', [$user]) }}" class="btn btn-warning">
                                                <i class="fas fa-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
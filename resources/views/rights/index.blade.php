@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-auto">
                        Rechten
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('rights.create') }}" class="btn btn-success text-white">
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
                            @foreach($rights as $right)
                                <tr>
                                    <td>{{ $right->name }}</td>
                                    <td>
                                        <a href="{{ route('rights.edit', [$right]) }}" class="btn btn-warning">
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
@endsection
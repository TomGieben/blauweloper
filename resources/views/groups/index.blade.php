@extends('layouts.app')
@section('content')
    @if(auth()->user()->hasRight([
        'administrator',
        'secretariaat',
        'scholier-begeleider',
    ]))
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            groepen
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('groups.create') }}" class="btn btn-success text-white">
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
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{ $group->name }}</td>
                                        <td>
                                            <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-warning">
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
    @endif
@endsection

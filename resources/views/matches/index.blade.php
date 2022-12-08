@extends('layouts.app')

@section('content')
@if(auth()->user()->hasRight([
    'administrator',
    'secretariaat',
    'scheidsrechter',
    'scholier-begeleider',
]))
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <div class="col-auto">
                        Wedstrijden
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
                            <th scope="col">Speeler Een</th>
                            <th scope="col">Speeler Twee</th>
                            <th scope="col">Scheidsrechter</th>
                            <th scope="col">Opties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($matches as $match)
                            {{-- @dd($match->users[1]) --}}
                                <tr>
                                    <td>{{ $match->name }}</td>
                                    @foreach($match->users as $user)
                                        @if($user->pivot->is_player)
                                            <td>
                                                <a href="{{route("users.edit, []")}}"></a>
                                                {{ $user->name }}
                                            </td>
                                        @else
                                            @php
                                                $coach = $user 
                                            @endphp
                                        @endif
                                    @endforeach
                                    <td><i class="fas fa-solid fa-check"></i> {{ $coach->name }}</td>
                                    <td>
                                        <a href="{{--route('rights.edit', [$right])--}}" class="btn btn-warning">
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
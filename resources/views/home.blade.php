@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between my-4">
        <div class="col-auto">
            <h1>{{ __('Dashboard') }}</h1>
        </div>
    </div>

    <div class="row justify-content-between">
        @if (session('status'))
            <div class="col-md-12">
                <div class="alert alert-success my-2" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        @endif

        @if($currentRights->isNotEmpty())
            <div class="col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-gavel"></i>
                            Rechten
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-light">
                            @foreach ($currentRights as $right)
                                <li class="list-group-item">
                                    {{ $right->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if($currentMatches->isNotEmpty())
            <div class="col-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-chess"></i>
                            Wedstrijden
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-light">
                            @foreach ($currentMatches as $match)
                                <li class="list-group-item">
                                    {{ $match->name }} | {{ $match->start_date }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-trophy"></i>
                        Gewonnen
                    </div>
                </div>
                <div class="card-body">
                    {{ $matchesWon }}
                </div>
            </div>
        </div>

        <div class="col-auto">
            <iframe style="width: 400px; height: 560px;" src="https://www.chess.com/daily_puzzle" frameborder="0"></iframe>
        <div>
    </div>
</div>
@endsection

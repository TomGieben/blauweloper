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

      
            <div class="col-md-4">
                <div class="card bg-primary">
                    <div class="card-body text-white">
                        <h4>
                            <i class="fas fa-gavel"></i>
                            Rechten
                        </h4>
                        @if($currentRights->isNotEmpty())
                            <ul class="list-group list-group-light">
                                @foreach ($currentRights as $right)
                                    <li class="list-group-item">
                                        {{ $right->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Je hebt nog geen rechten.</p>
                        @endif
                    </div>
                </div>
            </div>

       
        <div class="col-md-4">
            <div class="card bg-secondary">
                <div class="card-body text-white">
                    <h4>
                        <i class="fas fa-chess"></i>
                        Wedstrijden
                    </h4>
                    @if($currentMatches->isNotEmpty())
                        <ul class="list-group list-group-light">
                            @foreach ($currentMatches as $match)
                                <li class="list-group-item">
                                    {{ $match->name }} | {{ $match->getStartDate() }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Er zijn geen wedstrijden gepland.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info">
                <div class="card-body text-white">
                    <h4>
                        <i class="fas fa-trophy"></i>
                        Gewonnen
                    </h4>
                    <ul class="list-group list-group-light">
                        <li class="list-group-item">
                            {{ $matchesWon }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

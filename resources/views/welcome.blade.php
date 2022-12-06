@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-6">
                <img src="{{ asset('img/thumbnail.jpg') }}" class="img-fluid rounded w-100">
            </div>
            <div class="col-md-6 p-4">
                Het moet ergens in 1980 geweest zijn dat een aantal schaakliefhebbers elkaar vonden en besloten een echte schaakvereniging op te richten. Er werd een voorlopig bestuur gekozen en het plaatselijke café wilde graag de nieuwe vereniging onderdak verlenen. Zij waren zelfs zo enthousiast dat zij een donatie deden om de vereniging ook financieel op poten te zetten. In het begin brachten de leden hun eigen schaakbord en schaakstukken mee naar de wekelijkse schaakavond. Al snel konden er, door de donaties en contributie, borden en spellen op naam van de club gekocht worden. In 1981 was het zover; de officiële oprichting van Schaakvereniging De Blauwe Loper.
                <br>
                <a href="{{ route('register') }}" class="btn btn-primary mt-2">Register</a>
            </div>
        </div>
    </div>
@endsection
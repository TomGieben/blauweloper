@extends('layouts.app')

@section('content')
    @if(auth()->user()->hasRight([
        'administrator',
        'secretariaat',
        'scheidsrechter',
        'scholier-begeleider',
    ]))
    
    @endif
@endsection

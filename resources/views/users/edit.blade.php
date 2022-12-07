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
                                    Edit User
                                </div>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('users.index') }}" class="btn btn-default"> 
                                    Terug
                                </a>
                            </div> 
                        
                        </div>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
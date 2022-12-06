@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <td>ID</td>
                <td>group Name</td>
                <td>Action</td>
                <td><a href="{{ route('group.create',)}}" class="btn btn-success">Create</a></td>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                <tr>
                    <td>{{$group->id}}</td>
                    <td>{{$group->name}}</td>
                    <td><a href="{{ route('group.edit', $group->id)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('group.destroy', $group->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<div>
@endsection

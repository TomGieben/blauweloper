@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card uper">
            <div class="card-header">
                Add Group Data
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('groups.update', $group->id) }}">
                    <div class="form-group">
                        @csrf
                        <label for="name">Group name</label>
                        <input type="text" class="form-control" name="name" />
                    </div>
                    <div>
                        <label for="rechtenselect">Selecteer Rechten </label>
                        <select class="multiple col-lg-3" name="selectright[]" id="rechtenselect" onchange="getselectedright()">
                            @foreach($rights  as  $right)
                            <option value='{{ $right->id }}'>{{ $right->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select class="multiple col-lg-3" name="naamselect[]" multiple="multiple" id="naamselect">
                            @foreach ($users as $user)
                            <option value="{{$user->id}}" selected>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success my-1">Add Group</button>
                </form>
            </div>
        </div>
        <div>
            @if ($errors->any())
                <div class="mt-4 alert alert-danger">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
    </div>
    <script>
        function getselectedright(){
            var selector = document.getElementById('rechtenselect').value;

            $.ajax({
            url : "{{ route('ajax') }}",
            type : 'POST',
            data : {
                '_token' : "{{ csrf_token() }}",
                'selectedright' : selector
            },
            dataType:'json',
            success : function(data) {
                data.forEach(user => {
                    $('#naamselect').append($('<option>').val(user.id).text(user.name));
                });
            },
            });

        }
    </script>
@endsection

@extends('layouts.app')
@section('content')
@if(auth()->user()->hasRight([
    'administrator',
    'secretariaat',
    'scholier-begeleider',
]))
    <div class="container">
        <div class="card uper">
            <div class="card-header">
                Add Group Data
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('groups.store') }}">
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

                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success text-white">
                            <i class="fas fa-save"></i> Opslaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div>
    </div>
    @endif
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

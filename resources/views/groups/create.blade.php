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
                Voer u groep data hier in!
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('groups.store') }}">
                    <div class="form-group">
                        @csrf
                        <label for="name">Groeps naam</label>
                        <input type="text" class="form-control" name="name" />
                    </div>
                    <div>
                        <div class="form-group row mt-2">
                            <label for="rechtenselect">Selecteer gebruiker op club-rechten</label>
                            <select class="multiple col-lg-3" name="selectright[]" id="rechtenselect" onchange="getselectedright()">
                                @foreach($rights  as  $right)
                                <option value='{{ $right->id }}'>{{ $right->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
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
            success : function(users) {
                $('#naamselect').find('option').not(':selected').remove();

                users.forEach((user) => {
                    $("#naamselect").append(
                        new Option(user.name, user.id)
                    );
                });
            },
            });
        }
    </script>
@endsection

@extends('layouts.app')
@section('content')
    @if(auth()->user()->hasRight([
        'administrator',
        'secretariaat',
        'scholier-begeleider',
    ]))
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('groups.update', $group->id) }}">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-header">
                     {{ $group->id }} informatie bewerken
                </div>
                <div class="card-body">
                    <div class="form-group">
                        @csrf
                        <label for="name">Groeps naam</label>
                        <input value="{{ $group->name }}" type="text" class="form-control" name="name" />
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
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" @if($user->inGroup($group->slug)) selected @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success text-white">
                                <i class="fas fa-save"></i> Opslaan
                            </button>
                        </form>
                        </div>
                        <div class="col-auto">
                            <form method="POST" action="{{ route('groups.destroy', $group->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <div class="form-group">
                                    <button type="button" class="btn btn-danger text-white delete-user">
                                        <i class="fas fa-trash"></i> Verwijder
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

@extends('layouts.app')

@section('content')
    @if(auth()->user()->hasRight([
        'administrator',
        'secretariaat',
        'scheidsrechter',
        'scholier-begeleider',
    ]))
    
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('matches.update', [$match]) }}">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-header">
                    Wedstrijd {{ $match->name }} bewerken
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="name">Wedstijd naam:</label>
                        <input class="form-control" type="text" name="name" id="name" autocomplete="off" value="{{ $match->name }}">
                    </div>
                    <div class="input-group row">
                        <label for="date" class="col-form-label">Datum</label>
                        <div class="col-lg-3">
                            <input type="datetime-local" name="date" class="from-control" value="{{ $match->start_date }}">
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="player-1" class="col-form-label">Speler 1: </label>
                        <select class="col-auto mx-2 form-control w-25" name="player1" id="player1box" onchange="update()">
                            <option value="0">Selecteer...</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="player-2" class="col-form-label">Speler 2:</label>
                        <select class="col-auto mx-2 form-control w-25" name="player2" onchange="update()">
                            <option value="0">Selecteer...</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="coach" class="col-form-label">Schijdsrechter:</label>
                        <select class="col-auto mx-2 form-control w-25" name="coach" onchange="update()">
                            <option value="0">Selecteer...</option>
                            @foreach ($coaches as $coach)
                                <option value="{{$coach->id}}">{{$coach->name}}</option>
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
                            <form method="POST" action="{{ route('matches.destroy', [$match]) }}">
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

    function update() {
        const clickedElement = $(event.target);
        const selectName = clickedElement.attr('name');
        const selectedVal = clickedElement.val();
        const selects = [
            'player1',
            'player2',
            'coach'
        ];
    
        selects.forEach(select => {
            if(select !== selectName) {
                var options = $("select[name='"+ select +"'] > option");
                
                options.each(function() {
                    if(this.value == selectedVal) {
                        this.style.display = 'none';
                    } else {
                        this.style.display = 'block';
                    }
                });
            }
        });
    }
</script>
@endsection

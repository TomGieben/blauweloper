@extends('layouts.app')
@section('content')
    @if(auth()->user()->hasRight([
        'administrator',
        'secretariaat',
        'scheidsrechter',
        'scholier-begeleider',
    ]))
    <div class="row justify-content-center">
        <form action="{{route('matches.store')}}" method="POST">
            @method('POST')
            @csrf
            <div class="card">
                <div class="card-header">
                    Wedstrijd Maken
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="name">Wedstijd naam:</label>
                        <div class="col-lg-3">
                            <input class="form-control" type="text" name="name" id="name" autocomplete="off">
                        </div>
                    </div>
                    <div class="input-group row">
                        <label for="date" class="col-form-label">Datum</label>
                        <div class="col-lg-3">
                            <input type="datetime-local" name="date" class="from-control">
                        </div>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="player1" class="col-form-label">Speler 1:</label>
                        <select class="col-auto mx-2 form-control w-25" name="player1" onchange="update()">
                            <option value="0">Selecteer...</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row justify-content-between">
                        <label for="player2" class="col-form-label">Speler 2:</label>
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
                            <a href="{{ route('matches.index') }}" class="btn btn-dark text-white delete-user"><i class="fas fa-arrow-left"></i> Terug</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <script>
        function update() {
            const clickedElement = $(event.target);
            const selectName = clickedElement.attr('name');
            const selects = [
                'player1',
                'player2',
                'coach',
            ];
            
            var values = $('select').map(function(){
                return this.value
            }).get();

            selects.forEach(select => {
                var options = $("select[name='"+ select +"'] > option");
                
                options.each(function() {
                    if(this.value !== '0') {
                        if(values.includes(this.value)) {
                            this.style.display = 'none';
                        } else {
                            this.style.display = 'block';
                        }
                    }
                });
            });
        }
    </script>
    @endif
@endsection
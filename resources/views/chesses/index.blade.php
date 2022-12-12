@extends('layouts.app')

@section('content')

    @if(auth()->user()->hasRight([
        'administrator',
        'lid',
    ]))

        <div class="container d-flex justify-content-center">
            {{ $board }}
        </div>

        <script>

                $(".tile").click(function(){
                    console.log("Y: " + $(this).attr('data-y'));
                    console.log("X: " + $(this).attr('data-x'));
                    console.log("Color: " + $(this).attr('data-color'));
                    var color = $(this).attr('data-color');

                    var colorPiece;

                    if (color == 'black') {
                        colorPiece = 'white';
                    }else {
                        colorPiece = 'black';
                    }

                    var rN = Math.floor((Math.random() * 10) + 1);
                    
                    if(rN == 1) {
                        $(this).html('<i class="fa-solid fa-chess-pawn-piece fa-2x" style="color: blue"></i>');
                    }else if(rN == 2) {
                        $(this).html('<i class="fa-solid fa-chess-knight-piece fa-2x" style="color: '+ colorPiece +'"></i>');
                    }else if(rN == 3) {
                        $(this).html('<i class="fa-solid fa-chess-rook-piece fa-2x" style="color: '+ colorPiece +'"></i>');
                    }else if(rN == 4) {
                        $(this).html('<i class="fa-solid fa-chess-king-piece fa-2x" style="color: '+ colorPiece +'"></i>');
                    }else if(rN == 5) {
                        $(this).html('<i class="fa-solid fa-chess-bishop-piece fa-2x" style="color: '+ colorPiece +'"></i>');
                    }else if(rN == 6) {
                        $(this).html('<i class="fa-solid fa-chess-queen-piece fa-2x" style="color: '+ colorPiece +'"></i>');
                    }else {
                        $(this).html('<i class="fa-solid fa-chess-pawn-piece fa-2x" style="color: '+ colorPiece +'"></i>');
                    }

                });
            
        </script>
    @endif
@endsection
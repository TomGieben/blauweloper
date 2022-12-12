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

                    $(this).html('<i class="fa-solid fa-chess-pawn fa-2x" style="color: '+ colorPiece +'"></i>');
                });
            
        </script>
    @endif
@endsection
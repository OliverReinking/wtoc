@extends('layouts.mainlayout')
@section('content')

<section class="bg-blue-200 rounded-lg p-4 my-4">
  <div class="container mx-auto max-w-6xl text-center flex flex-col justify-center my-4">
    <form action="/ticker.Ligalivetickerdaten_ermitteln/{{$liganr}}/{{$saisonnr}}/{{$spieltag}}/{{$heimnr}}/{{$gastnr}}" method="POST">
      @method('PUT')
      @csrf
      {!! Form::submit('LIVE-TICKER STARTEN', ['class' => 'inline-block min-w-full my-2 p-2 rounded-lg bg-blue-300 hover:bg-green-500']) !!}
  </form>

  </div>

  @if($meldung)
    <div class="bg-red-500 p-4 rounded-lg shadow-md">{{ $meldung }}</div>
  @else

    <div>
      <ligaliveticker 
        saisonname="{{$saisonname}}" 
        liganame="{{$liganame}}" 
        spieltagname="{{$spieltagname}}"
        heimname="{{$heimname}}" 
        gastname="{{$gastname}}">
      </ligaliveticker>
    </div>
  @endif

</section>

@stop
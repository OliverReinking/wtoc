@extends('layouts.mainlayout')
@section('content')

<section class="bg-blue-200 rounded-lg p-4 my-4">
  <div class="container mx-auto text-center flex flex-col my-4">
    <h1>{{ $saisonname }} {{ $liganame }}</h1>
    <h2>{{ $spieltagname }} </h2>
  </div>

  <div class="py-4 px-2 my-2 bg-blue-300 rounded-lg shadow-md">
    <div class="w-full flex flex-row flex-wrap justify-between text-center -mx-1">
      {!! $spieltagliste_url !!}
    </div>
  </div>

  <div class="py-4 px-2 my-2 bg-blue-300 rounded-lg shadow-md">
    <h2 class="text-center">Liga-Liveticker</h2>
    <div class="w-full flex flex-row flex-wrap items-center justify-between text-center -mx-1">
      {!! $teamliste !!}
    </div>
  </div>

  <div class="py-4 px-2 my-2 bg-blue-300 rounded-lg shadow-md">
    <h3>Paarungen</h3>
    {!! $spielpaarungen !!}
  </div>

  <div class="py-4 px-2 my-2 bg-blue-300 rounded-lg shadow-md">
    <h3>Tabelle</h3>
    {!! $spieltagtabelle !!}
  </div>

  <div class="py-4 px-2 my-2 bg-blue-300 rounded-lg shadow-md">
    <h3>Torjäger</h3>
    {!! $torjägerliste !!}
  </div>

  <div class="py-4 px-2 my-2 bg-blue-300 rounded-lg shadow-md">
    <h3>Spielberichte</h3>
    {!! $spielberichte !!}
  </div>
<section>

@stop

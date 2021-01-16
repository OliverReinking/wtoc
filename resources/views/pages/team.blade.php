@extends('layouts.mainlayout')
@section('content')

<section class="bg-blue-200 rounded-lg p-4 my-4">
  <div class="container mx-auto text-center flex flex-col my-4">

  @if ($fehlerkz)
  <div class="flex">
    <div class="flex-1 p-4 rounded-lg shadow border-2 border-red-500 bg-blue-300">
      <div class="text-3xl text-gray-900 font-bold">Fehler</div>
      <div class="text-gray-800 text-md">{!! $fehlermeldung !!}<div>
    </div>
  </div>
  @endif

  @if (!$fehlerkz)
  <div class="py-4 px-2 my-2 bg-blue-400 rounded-lg shadow-md">
    <div class="flex items-center">
      <div class="flex-1 text-center">
        <h1>{{ $teamname }}</h1>
      </div>
    </div>
  </div>
  
  <div class="py-4 px-2 my-2 bg-blue-400 rounded-lg shadow-md">
    <h3>Saison</h3>
    <div class="flex flex-row justify-start flex-wrap">
      {!! $saisonliste_url !!}
    </div>
  </div>

  <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
    <h3>Titel</h3>
    {!! $titellistetabelle !!}
  </div>

  <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
    <h3>Platzierungen</h3>
    {!! $platzierungen !!}
  </div>

  <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
    <h3>Spiele</h3>
    {!! $spielliste !!}
  </div>

  <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
    <table class="table table-striped table-bordered">
      <tr>
        <th>Spieler</th>
        <th>Nr</th>
        <th>Tore</th>
      </tr>
      @foreach ($playerliste as $single_player)
        <tr>
          <td>
            {{$single_player->PlayerName}}
          </td>
          <td>
            {{$single_player->PlayerTrikotNr}}
          </td>
          <td>
            {{$single_player->Tore}}
          </td>
        </tr>
      @endforeach
    </table>
  </div>
  @endif

</section>

@stop

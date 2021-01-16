@extends('layouts.mainlayout')
@section('content')

<section class="bg-blue-200 rounded-lg p-2 my-4">
  <div class="container mx-auto text-center flex flex-col my-4">
    <h1>{{ $teamname }}</h1>
  </div>

  @if ($fehlerkz)
  <div class="flex">
    <div class="flex-1 p-4 rounded-lg shadow border-2 border-red-500 bg-blue-300">
      <div class="text-3xl text-gray-900 font-bold">Fehler</div>
      <div class="text-gray-800 text-md">{!! $fehlermeldung !!}<div>
    </div>
  </div>
  @endif

  @if (!$fehlerkz)
  <div class="mt-2 p-2">
    @foreach ($saisondaten as $single_saison)
    <div class="shadow rounded-lg my-4 p-2 bg-purple-400">
      <h3>Team</h3>
      {!! $teaminfo !!}
    </div>
    <div class="shadow rounded-lg my-4 p-2 bg-blue-400">
      <h3>Mannschaft</h3>
      {!! $mannschaft !!}
    </div>
    <div class="shadow rounded-lg my-4 p-2 bg-blue-400">
      <h3>Spielergebnisse</h3>
      {!! $spielliste !!}
    </div>
    <div class="shadow rounded-lg my-4 p-2 bg-blue-400">
      <h3>Torjäger (Liga)</h3>
      {!! $single_saison['ligatorjägerliste'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-2 bg-blue-400">
      <h3>Tabelle</h3>
      {!! $single_saison['saisontabelle'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-2 bg-blue-400">
      <h3>Liga-Heimspiele</h3>
      {!! $single_saison['ligaheimspiele'] !!}
    </div>
    <div class="shadow rounded-lg my-4 my-2 p-2 bg-blue-400">
      <h3>Liga-Auswärtsspiele</h3>
      {!! $single_saison['ligagastspiele'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-2 bg-blue-400">
      <h3>Pokal-Heimspiele</h3>
      {!! $single_saison['pokalheimspiele'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-2 bg-blue-400">
      <h3>Pokal-Auswärtsspiele</h3>
      {!! $single_saison['pokalgastspiele'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-2 bg-blue-400">
      <h3>Torjäger (Pokal)</h3>
      {!! $single_saison['pokaltorjägerliste'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-2 bg-blue-400">
      <h3>Torjäger (Gesamt)</h3>
      <table>
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
    @endforeach
  </div>
  @endif
</section>

@stop

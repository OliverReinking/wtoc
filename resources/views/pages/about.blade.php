@extends('layouts.mainlayout')
@section('content')

<section class="bg-blue-200 rounded-lg shadow-md p-4 my-4">
  <div class="container mx-auto text-center flex flex-col my-4">
    <div class="text-4xl font-bold">Willkommen in der WTOC-Welt</div>
    <div class="text-2xl">2.816 Spieler<br />256 Teams<br />16 Länder<br />1 Sieger</div>
</section>

<section class="bg-blue-300 rounded-lg shadow-md p-4 my-4">
  <div class="container mx-auto text-center flex flex-col my-4">
    <h2>WTOC</h2>
    <p>World Teamplayer Organization Championship</p>
    <h2>256</h2>
    <h6>Teams</h6>
    <h2>16</h2>
    <h6>Länder</h6>
    <h2>2816</h2>
    <h6>Spieler</h6>
    <h2>1</h2>
    <h6>Weltmeister</h6>
  </div>
</section>

<section class="bg-blue-200 rounded-lg shadow-md p-4 my-4">
  <div class="container mx-auto text-center flex flex-col my-4">
    <h2>Spielregeln</h2>
    <p>Die WTOC-Spielregeln</p>
  </div>
  <div class="flex items-stretch -mx-2">
    <div class="w-1/3 px-2 mx-2 bg-blue-400 rounded-lg shadow-md">
      <h6>Landesmeisterschaft</h6>
      <p>Werde Landesmeister</p>
      <div>
        <p>In jedem der 16 teilnehmenden Länder findet die Landesmeisterschaft statt.</p>
        <p>Modus: Jeder gegen jeden mit Hin- und Rückspiel.</p>
        <p>D.h. es gibt in jeder Saison 30 Spieltage.</p>
        <p>Der Sieger erhält eine Prämie in Höhe von 1.000.000 TC.</p>
        <p>Für jeden Punkt erhält ein Team 20.000 TC.</p>
      </div>
    </div>
    <div class="w-1/3 px-2 mx-2 bg-blue-500 rounded-lg shadow-md">
      <h6>WTC-Cup</h6>
      <p>Hol das Ding</p>
      <div>
        <p>An diesem Wettbewerb nehmen alle 256 Teams teil.</p>
        <p>Modus: K.O. Runde mit Hin- und Rückspiel</p>
        <p>Der Sieger erhält eine Prämie in Höhe von 1.000.000 TC.</p>
        <p>Für jeden Punkt erhält ein Team 40.000 TC.</p>
        <p>Insgesamt werden 8 Ko.-Runden gespielt.</p>
      </div>
    </div>
    <div class="w-1/3 px-2 mx-2 bg-blue-600 rounded-lg shadow-md">
      <h6>Weltmeisterschaft</h6>
      <p>1 Sieger</p>
      <div class="modal-body">
        <p>An diesem Wettbewerb nehmen alle 16 Landesmeister teil.</p>
        <p>Modus: K.O. Runde mit Hin- und Rückspiel</p>
        <p>Der Sieger erhält eine Prämie in Höhe von 3.000.000 TC.</p>
        <p>Für jeden Punkt erhält ein Team 60.000 TC.</p>
        <p>Insgesamt werden 4 Ko.-Runden gespielt.</p>
      </div>
  </div>
</section>

<section class="bg-blue-200 rounded-lg shadow-md p-4 my-4 overflow-x-auto">
  <div class="container mx-auto text-center flex flex-col mb-8">
    <h2>WTOC-Teams</h2>
  </div>
  <div class="inline-flex flex-row items-stretch -mx-2">
    @foreach($teams as $team)
    <div class="w-48 h-40 py-4 px-2 mx-2 bg-green-600 rounded-lg shadow-md">
      <div class="flex flex-col items-center text-center text-white">
        <div class="flex-1 my-1 text-base">
          <a href="/team/{{$team->country->LandNr}}/{{$team->TeamNr}}" class="block p-2 rounded-lg hover:bg-green-300">
            {{ $team->TeamName }}<br>
          </a>
        </div>
        <div class="flex-1 my-1 text-sm">
          {{ $team->country->LandName }}
        </div>
        <div class="flex-1 my-1 text-xs">
          Teamwert: {{ number_format($team->TeamWert,0,',','.') }}
        </div>
        <div class="flex-1 my-1 text-xs">
          Kontostand: {{ number_format($team->TeamKontostand,0,',','.') }} TC
        </div>
      </div>
    </div>
    @endforeach
  </div>
</section>

@stop
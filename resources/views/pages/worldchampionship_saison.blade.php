@extends('layouts.mainlayout')
@section('content')

<section id="section_content">

  @if ($fehlerkz)
  <div class="flex">
    <div class="flex-1 p-4 rounded-lg shadow border-2 border-red-500 bg-blue-300">
      <div class="text-3xl text-gray-900 font-bold">Fehler</div>
      <div class="text-gray-800 text-md">{!! $fehlermeldung !!}<div>
    </div>
  </div>
  @endif

  @if (!$fehlerkz)
  <div class="mt-2 p-4">
    <div class="shadow rounded-lg p-4 bg-blue-400">
      <div class="flex items-center">
        <div class="flex-1 text-center">
          <h1>Weltmeisterschaft - {{$saisonnr}}. Saison</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-2 p-4">
    @foreach ($pokaldaten as $single_pokal)
    <div class="shadow rounded-lg p-4 bg-blue-400">
      <h3>Ergebnisse</h3>
      {!! $single_pokal['pokalrunden'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-4 bg-blue-400">
      <h3>WM-Torjägerliste</h3>
      {!! $single_pokal['wmtorjägerliste'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-4 bg-blue-400">
      <h3>Welttorjägerliste</h3>
      {!! $single_pokal['welttorjägerliste'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-4 bg-blue-400">
      <h3>Teameinnahmen-Gesamt</h3>
      {!! $single_pokal['teameinnahmen_gesamt'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-4 bg-blue-400">
      <h3>Teameinnahmen-Einnahmetyp</h3>
      {!! $single_pokal['teameinnahmen'] !!}
    </div>
    @endforeach
  </div>
  @endif

</section>

@stop
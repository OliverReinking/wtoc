@extends('layouts.mainlayout')
@section('content')
<section class="bg-blue-200 rounded-lg p-4 my-4">
  <div class="container mx-auto text-center flex flex-col my-4">
    <h1>WTOC-Weltmeisterschaft</h1>
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

      <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
        <div class="flex flex-row justify-start flex-wrap">
          {!! $saisonliste_url !!}
        </div>
      </div>

      <div class="sm:hidden md:block py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
        {!! $endspielliste !!}
      </div>

      <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
        <h3>WM-Spiele</h3>
        {!! $wmspiele !!}
      </div>

      <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
        <h3>WM-Torjägerliste </h3>
        {!! $wmtorjaegerliste !!}
      </div>

      <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
        <h3>Welttorjägerliste </h3>
        {!! $welttorjaegerliste !!}
      </div>

      @endif

</section>
@stop
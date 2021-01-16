@extends('layouts.mainlayout')
@section('content')

<section>
  <div class="bg-blue-300 rounded-lg shadow-md p-4 my-4">
    <h1 class="text-center">Ligenübersicht</h1>

    <div class="container mx-auto text-center flex flex-row flex-wrap my-4">
      @foreach ($ligen as $single_liga)
      <div class="w-1/2 md:w-1/4 leading-none">
        <a href='ligen/{{ $single_liga->LandNr }}' class="block p-2 mr-2 rounded bg-blue-500 hover:bg-green-300">{{ $single_liga->LandName }}</a><br />
      </div>
      @endforeach
    </div>

    <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
      <h3>aktuelle Tabellen</h3>
      {!! $spieltagtabelle !!}
    </div>

    <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
      <h3>Titel</h3>
      {!! $titellistetabelle !!}
    </div>

  </div>
</section>

@stop
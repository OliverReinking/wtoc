@extends('layouts.mainlayout')
@section('content')

<section class="bg-blue-200 rounded-lg p-4 my-4">
  <div class="container mx-auto text-center flex flex-col my-4">
    <h1>{{ $saisonname }} {{ $liganame }}</h1>
  </div>

  <div class="py-4 px-2 my-2 bg-blue-300 rounded-lg shadow-md">
    <div class="w-full flex flex-row flex-wrap justify-between text-center -mx-1">
      {!! $spieltagliste_url !!}
    </div>
  </div>

</section>

@stop

@extends('layouts.mainlayout')
@section('content')

<section class="bg-blue-200 rounded-lg p-4 my-4">
  <div class="text-center">
    <h1>{!! $liganame !!}</h1>
  </div>

  <div class="flex flex-row items-stretch">
    <div class="w-full md:w-1/2 py-4 px-2 my-2 mx-2 bg-blue-400 rounded-lg shadow-md">
      <div class="leading-none">
        {!! $saisonliste_url !!}
      </div>
    </div>
    <div class="w-full md:w-1/2 py-4 px-2 my-2 mx-2 bg-blue-400 rounded-lg shadow-md">
      <div class="leading-none">
        {!! $teamliste_url !!}
      </div>
    </div>
  </div>

  <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
    <h3>Titel</h3>
    {!! $titellistetabelle !!}
  </div>

</section>

@stop
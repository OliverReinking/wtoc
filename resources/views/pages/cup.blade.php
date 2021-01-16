@extends('layouts.mainlayout')
@section('content')
<section class="bg-blue-200 rounded-lg p-4 my-4">
  <div class="container mx-auto text-center flex flex-col my-4">
    <h1>WTOC-Pokalcup</h1>
  </div>

  <div class="py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
    <div class="flex flex-row justify-start flex-wrap">
      {!! $saisonliste_url !!}
    </div>
  </div>

  <div class="sm:hidden md:block py-4 px-2 my-2 bg-blue-500 rounded-lg shadow-md">
    {!! $endspielliste !!}
  </div>

  <div class="container">
    <h2>Länderwertung</h2>
    <table class="table table-striped table-bordered">
      <tr>
        <th>Platz</th>
        <th>Land</th>
        <th>Punkte</th>
      </tr>
      @foreach ($ligawertung as $single_land)
      <tr>
        <td>
          {{$loop->iteration}}
        </td>
        <td>
          {{$single_land->LandName}}
        </td>
        <td>
          {{$single_land->Punkte}}
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</section>

@stop
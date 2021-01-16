@extends('layouts.mainlayout')
@section('content')

<section>

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
            <h1>Cup - {{$saisonnr}}. Saison</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-2 p-4">
    @foreach ($pokaldaten as $single_pokal)
    <div class="shadow rounded-lg p-4 bg-blue-400">
      <h3>Cup</h3>
      {!! $single_pokal['pokalrunden'] !!}
    </div>
    <div class="shadow rounded-lg my-4 p-4 bg-blue-400">
      <h3>Länderwertung</h3>
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
    @endforeach
  </div>

  @endif

</section>

@stop
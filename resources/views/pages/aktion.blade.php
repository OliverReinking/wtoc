@extends('layouts.mainlayout')
@section('content')

<section class="bg-blue-200 rounded-lg p-4 my-4">
    <div class="container mx-auto text-center flex flex-col my-4">
        <h1>Befehle</h1>
    </div>

    <div class="container mx-auto max-w-md text-center flex flex-col justify-center my-4">


        <form method="POST" action="{{ route('WTOC_Steuerungsdaten_ermitteln') }}">
            @csrf
            <button type="submit" class="inline-block min-w-full max-w-xs my-2 p-2 rounded-lg bg-blue-300 hover:bg-green-500">
                Steuerungsdaten ermitteln
            </button>
        </form>

        <form method="POST" action="{{ route('WTOC_Aktion_starten') }}">
            @csrf
            <button type="submit" class="inline-block min-w-full max-w-xs my-2 p-2 rounded-lg bg-blue-300 hover:bg-green-500">
                Aktion starten
            </button>
        </form>

        @if ($fehlerkz)
        <div class="flex my-2">
            <div class="flex-1 p-4 rounded-lg shadow border-2 border-red-500 bg-blue-300">
                <div class="text-3xl text-gray-900 font-bold">Fehler</div>
                <div class="text-gray-800 text-md">{!! $fehlermeldung !!}<div>
                    </div>
                </div>
                @endif

                @if ($steuerung_kz)
                <div class="flex my-2">
                    <div class="flex-1 p-4 rounded-lg shadow border-2 border-blue-600 bg-blue-300">
                        <h2>Steuerungsdaten</h2>
                        <div>
                            {!! $steuerungsbericht !!}
                        </div>
                    </div>
                </div>
                @endif

                @if ($aktion_kz)
                <div class="flex my-2">
                    <div class="flex-1 p-4 rounded-lg shadow border-2 border-blue-600 bg-blue-300">
                        <h2>Aktionsbericht</h2>
                        <div>
                            {!! $aktionsbericht !!}
                        </div>
                    </div>
                </div>
                @endif

            </div>

</section>
@stop

<!-- Breadcrumb -->
<section class="w-full bg-blue-400">
  <div class="container mx-auto max-w-6xl py-2 px-4">
    <div class="">
      <ol class="flex flex-row">
        <li class="mr-2"><a href="/about" class="py-1 px-2 hover:text-blue-100">Home</a></li>
        @if ($seitenname == 'aktion')
        <li class="mr-2 font-bold text-gray-800">Aktion</li>
        @endif
        @if ($seitenname == 'news')
        <li class="mr-2 font-bold text-gray-800">News</li>
        @endif
        @if ($seitenname == 'saison')
        <li class="mr-2"><a href="/country" class="py-1 px-2 hover:text-blue-100">Ligen</a></li>
        <li class="mr-2"><a href="/ligen/{{$liganr}}" class="py-1 px-2 hover:text-blue-100">{!! $liganame !!}</a></li>
        <li class="mr-2 font-bold text-gray-800">{!! $saisonname !!}</li>
        @endif
        @if ($seitenname == 'spieltag')
        <li class="mr-2"><a href="/country" class="py-1 px-2 hover:text-blue-100">Ligen</a></li>
        <li class="mr-2"><a href="/ligen/{{$liganr}}" class="py-1 px-2 hover:text-blue-100">{!! $liganame !!}</a></li>
        <li class="mr-2"><a href="/saison/{{$liganr}}/{{$saisonnr}}" class="py-1 px-2 hover:text-blue-100">{!! $saisonname !!}</a></li>
        <li class="mr-2 font-bold text-gray-800">{!! $spieltag !!}. Spieltag</li>
        @endif
        @if ($seitenname == 'team')
        <li class="mr-2"><a href="/country" class="py-1 px-2 hover:text-blue-100">Ligen</a></li>
        <li class="mr-2"><a href="/ligen/{{$liganr}}" class="py-1 px-2 hover:text-blue-100">{!! $liganame !!}</a></li>
        <li class="mr-2 text-gray-800">{!! $teamname !!}</li>
        @endif
        @if ($seitenname == 'team_saison')
        <li class="mr-2"><a href="/country" class="py-1 px-2 hover:text-blue-100">Ligen</a></li>
        <li class="mr-2"><a href="/ligen/{{$liganr}}" class="py-1 px-2 hover:text-blue-100">{!! $liganame !!}</a></li>
        <li class="mr-2"><a href="/team/{{$liganr}}/{{$teamnr}}" class="py-1 px-2 hover:text-blue-100">{!! $teamname !!}</a></li>
        <li class="mr-2 font-bold text-gray-800">{!! $saisonnr !!}. Saison</li>
        @endif
        @if ($seitenname == 'country')
        <li class="mr-2 font-bold text-gray-800">Ligen</li>
        @endif
        @if ($seitenname == 'liga')
        <li class="mr-2"><a href="/country" class="py-1 px-2 hover:text-blue-100">Ligen</a></li>
        <li class="mr-2 font-bold text-gray-800">{!! $liganame !!}</li>
        @endif
        @if ($seitenname == 'cup')
        <li class="mr-2 font-bold text-gray-800">Pokal</li>
        @endif
        @if ($seitenname == 'cup_saison')
        <li class="mr-2"><a href="/cup" class="py-1 px-2 hover:text-blue-100">Pokal</a></li>
        <li class="mr-2 font-bold text-gray-800">{!! $saisonnr !!}. Saison</li>
        @endif
        @if ($seitenname == 'worldchampionship')
        <li class="mr-2 font-bold text-gray-800">WM</li>
        @endif
        @if ($seitenname == 'worldchampionship_saison')
        <li class="mr-2"><a href="/worldchampionship" class="py-1 px-2 hover:text-blue-100">WM</a></li>
        <li class="mr-2 font-bold text-gray-800">{!! $saisonnr !!}. Saison</li>
        @endif
      </ol>
    </div>
  </div>
</section>
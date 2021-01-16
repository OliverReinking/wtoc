<?php

namespace App\Http\Controllers;

use App\Land;
use App\Team;
use App\Spiel;
use App\Player;
use App\Saison;
use App\SpielPlan;
use App\Steuerung;
use App\TeamTitel;
use App\WMTabelle;
use App\PokalTabelle;
use App\Events\LigaLiveTicker;
use Illuminate\Support\Facades\DB;

class LigenController extends Controller
{
  //
  public function worldchampionship()
  {
    // ermittle notwendige Werte aus der Tabelle Steuerung
    $maxSaisonNr = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    //
    $saisonliste = Saison::select('SaisonName', 'SaisonNr')
      ->where('SaisonNr', '<=', $maxSaisonNr)
      ->orderBy('SaisonNr')
      ->get();
    //
    $saisonliste_url = '';
    //
    foreach ($saisonliste as $single_saison) {
      $saisonliste_url .= '<a href="/worldchampionship_saison/' . $single_saison->SaisonNr . '" class="block p-1 m-1 rounded-lg bg-blue-500 hover:bg-green-300" role="button">' . $single_saison->SaisonName . '</a>';
    }
    // endspielliste
    $endspielliste = '<table>';
    $endspielliste .= '<thead>';
    $endspielliste .= '<tr>';
    $endspielliste .= '<th>Saison</th>';
    $endspielliste .= '<th>Team A</th>';
    $endspielliste .= '<th>Team B</th>';
    $endspielliste .= '<th>Hinspiel</th>';
    $endspielliste .= '<th>Rückspiel</th>';
    $endspielliste .= '<th>Weltmeister</th>';
    $endspielliste .= '<th>Land</th>';
    $endspielliste .= '</tr>';
    $endspielliste .= '</thead>';
    //
    $final_liste = DB::table('wmtabelle')
      ->select('wmtabelle.*', 'Heim.TeamName as HeimTeam', 'Gast.TeamName as GastTeam', 'Sieger.TeamName as SiegerTeam', 'Siegerland.LandName as SiegerLand')
      ->join('team as Heim', 'Heim.TeamNr', '=', 'wmtabelle.WMTeamANr')
      ->join('team as Gast', 'Gast.TeamNr', '=', 'wmtabelle.WMTeamBNr')
      ->join('team as Sieger', 'Sieger.TeamNr', '=', 'wmtabelle.WMTeamSiegerNr')
      ->join('land as Siegerland', 'Siegerland.LandNr', '=', 'Sieger.TzugLandNr')
      ->where('WMRunde', '=', 4)
      ->orderBy('WMzugSaisonNr')
      ->get();
    //
    foreach($final_liste as $single_finale)
    {
      $endspielliste .= '<tr>';
      $endspielliste .= '<td>' . $single_finale->WMzugSaisonNr . '</td>';
      $endspielliste .= '<td>' . $single_finale->HeimTeam . '</td>';
      $endspielliste .= '<td>' . $single_finale->GastTeam . '</td>';
      $endspielliste .= '<td>' . $single_finale->WMTAHTor . ' : ' . $single_finale->WMTBHTor . '</td>';
      $endspielliste .= '<td>' . $single_finale->WMTARTor . ' : ' . $single_finale->WMTBRTor . '</td>';
      $endspielliste .= '<td>' . $single_finale->SiegerTeam . '</td>';
      $endspielliste .= '<td>' . $single_finale->SiegerLand . '</td>';
      $endspielliste .= '</tr>';
    }
    $endspielliste .= '</table>';
    // ermittle die Welt-Torjägerliste
    $torjäger = DB::table('spieltore')
      ->select('PlayerName', 'PlayerTrikotNr', 'TeamName', DB::raw('COUNT(SpielToreNr) as Tore'))
      ->join('player', 'player.PlayerNr', '=', 'spieltore.SpielTorezugPlayerNr')
      ->join('team', 'team.TeamNr', '=', 'spieltore.SpielTorezugTeamNr')
      ->groupBy('SpielTorezugPlayerNr', 'PlayerName', 'PlayerTrikotNr', 'TeamName')
      ->where('SpielToreTyp', '=', 0)
      ->limit(50)
      ->orderBy('Tore', 'desc')
      ->orderBy('TeamName')
      ->get();
    //
    $welttorjaegerliste = '';
    $welttorjaegerliste = '<table>';
    //
    $welttorjaegerliste .= '<thead>';
    $welttorjaegerliste .= '<tr>';
    $welttorjaegerliste .= '<th>Torschütze</th>';
    $welttorjaegerliste .= '<th>Verein</th>';
    $welttorjaegerliste .= '<th>Tore</th>';
    $welttorjaegerliste .= '</thead>';
    foreach($torjäger as $torschütze)
    {
        $welttorjaegerliste .= '<tr>';
        $welttorjaegerliste .= '<td>' . $torschütze->PlayerName . ' ('. $torschütze->PlayerTrikotNr . ')</td>';
        $welttorjaegerliste.= '<td>' . $torschütze->TeamName . '</td>';
        $welttorjaegerliste.= '<td>' . $torschütze->Tore . '</td>';
        $welttorjaegerliste.= '</tr>';
    }
    $welttorjaegerliste.= '</table>';
    // ermittle die Welt-Torjägerliste
    $wmtorjäger = DB::table('spieltore')
      ->select('PlayerName', 'PlayerTrikotNr', 'TeamName', DB::raw('COUNT(SpielToreNr) as Tore'))
      ->join('player', 'player.PlayerNr', '=', 'spieltore.SpielTorezugPlayerNr')
      ->join('team', 'team.TeamNr', '=', 'spieltore.SpielTorezugTeamNr')
      ->groupBy('SpielTorezugPlayerNr', 'PlayerName', 'PlayerTrikotNr', 'TeamName')
      ->where('SpielTorezugSpieltypNr', '>=', 200)
      ->where('SpielToreTyp', '=', 0)
      ->limit(50)
      ->orderBy('Tore', 'desc')
      ->orderBy('TeamName')
      ->get();
    //
    $wmtorjaegerliste = '';
    $wmtorjaegerliste = '<table>';
    //
    $wmtorjaegerliste .= '<thead>';
    $wmtorjaegerliste .= '<tr>';
    $wmtorjaegerliste .= '<th>Torschütze</th>';
    $wmtorjaegerliste .= '<th>Verein</th>';
    $wmtorjaegerliste .= '<th>Tore</th>';
    $wmtorjaegerliste .= '</thead>';
    foreach($wmtorjäger as $torschütze)
    {
        $wmtorjaegerliste .= '<tr>';
        $wmtorjaegerliste .= '<td>' . $torschütze->PlayerName . ' ('. $torschütze->PlayerTrikotNr . ')</td>';
        $wmtorjaegerliste.= '<td>' . $torschütze->TeamName . '</td>';
        $wmtorjaegerliste.= '<td>' . $torschütze->Tore . '</td>';
        $wmtorjaegerliste.= '</tr>';
    }
    $wmtorjaegerliste.= '</table>';
    // WM-Spiele
    $wmspiele = '<div class="table-responsive-sm">';
    $wmspiele .= '<table class="table table-sm table-bordered table-striped">';
    //
    $wmspiele .= '<thead>';
    $wmspiele .= '<tr>';
    $wmspiele .= '<th class="hidden md:table-cell">Saison</th>';
    $wmspiele .= '<th class="hidden md:table-cell">Runde</th>';
    $wmspiele .= '<th>Hinspiel</th>';
    $wmspiele .= '<th>Rückspiel</th>';
    $wmspiele .= '<th class="hidden md:table-cell">Sieger</th>';
    $wmspiele .= '</tr>';
    $wmspiele .= '</thead>';
    //
    $pokaltabelle = WMTabelle::orderBy('WMNr')
      ->get();
    //
    foreach($pokaltabelle as $spiel)
    {
      $wmspiele .= '<tr>';
      //
      $wmspiele .= '<td class="hidden md:table-cell">' . $spiel->WMzugSaisonNr . '</td>';
      //
      $wmspiele .= '<td class="hidden md:table-cell">' . ermittle_Pokalrundenname($spiel->WMRunde, 2) . '</td>';
      // Hinspiel
      $wmspiele .= '<td>';
      if ($spiel->WMHSpNr>0)
      {
        $wmspiele .= ermittle_Teamnamen_Land($spiel->WMTeamANr);
        $wmspiele .= ' ' . $spiel->WMTAHTor . ' : ' . $spiel->WMTBHTor . ' ';
        $wmspiele .= ermittle_Teamnamen_Land($spiel->WMTeamBNr);
      } else {
        $wmspiele .= ermittle_Teamnamen_Land($spiel->WMTeamANr);
        $wmspiele .= ' : ';
        $wmspiele .= ermittle_Teamnamen_Land($spiel->WMTeamBNr);
      }
      $wmspiele .= '</td>';
      // Rückspiel
      $wmspiele .= '<td>';
      if ($spiel->WMRSpNr>0)
      {
        $wmspiele .= ermittle_Teamnamen_Land($spiel->WMTeamBNr);
        $wmspiele .= ' ' . $spiel->WMTBRTor . ' : ' . $spiel->WMTARTor . ' ';
        $wmspiele .= ermittle_Teamnamen_Land($spiel->WMTeamANr);
      } else {
        $wmspiele .= ermittle_Teamnamen_Land($spiel->WMTeamBNr);
        $wmspiele .= ' : ';
        $wmspiele .= ermittle_Teamnamen_Land($spiel->WMTeamANr);
      }
      //Sieger
      $wmspiele .= '<td class="hidden md:table-cell">';
      if ($spiel->WMTeamSiegerNr>0)
      {
        $wmspiele .= ermittle_Teamnamen_Land($spiel->WMTeamSiegerNr);
      }
      $wmspiele .= '</td>';
      //
      $wmspiele .= '</tr>';
    }
    //
    $wmspiele .= '</table>';
    $wmspiele .= '</div>';
    //
    return view('pages.worldchampionship', [
      'seitenname'          => 'worldchampionship',
      'welttorjaegerliste'  => $welttorjaegerliste,
      'wmtorjaegerliste'    => $wmtorjaegerliste,
      'wmspiele'            => $wmspiele,
      'saisonliste_url'     => $saisonliste_url,
      'endspielliste'       => $endspielliste,
      'fehlerkz'            => false,
      'fehlermeldung'       => '',
    ]);
  }
  //
  public function worldchampionship_saison($input_saisonnr)
  {
    //
    $pokaldaten = [];
    //
    $maxSaisonNr = 0;
    $maxSzugWMRunde = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    $maxSzugWMRunde = $steuerung->SzugWMRunde;
    // prüfe $input_saisonnr
    if ($input_saisonnr > $maxSaisonNr || $input_saisonnr < 0)
    {
      $fehlerkz = true;
      $fehlermeldung = 'Die vorgegebene Saison ist nicht gültig.';
      return view('pages.worldchampionship_saison', [
        'seitenname'      => 'cup_saison',
        'saisonnr'        => $input_saisonnr,
        'pokaldaten'      => '',
        'fehlerkz'        => $fehlerkz,
        'fehlermeldung'   => $fehlermeldung,
      ]);
    }
    // Berechne die gesamten Einnahmen der Teams
    $teameinnahmen_summe = DB::table('teamkonto')
       ->select('TeamName', DB::raw('SUM(TKWert) as Gesamteinnahme'))
       ->join('team', 'team.TeamNr', '=', 'teamkonto.TKzugTeamNr')
       ->where('TKzugSaisonNr', '=', $input_saisonnr)
       ->where('TKWert', '>', 0)
       ->groupBy('TeamName', 'teamkonto.TKzugTeamNr')
       ->orderBy('Gesamteinnahme', 'DESC')
       ->orderBy('TeamName')
       ->get();
    //
    $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] = '';
    $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] = '<table>';
    //
    $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] .= '<thead>';
    $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] .= '<tr>';
    $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] .= '<th>Team</th>';
    $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] .= '<th>Einnahme</th>';
    $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] .= '</thead>';
    foreach($teameinnahmen_summe as $single_teameinnahmen_summe)
    {
       $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] .= '<tr>';
         $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] .= '<td>' . $single_teameinnahmen_summe->TeamName . '</td>';
         $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] .= '<td>' . number_format($single_teameinnahmen_summe->Gesamteinnahme,2,",",".") . ' TCs</td>';
         $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] .= '</tr>';
     }
     $pokaldaten[$input_saisonnr]['teameinnahmen_gesamt'] .= '</table>';
    // ermittle die Teameinnahmen aller Teams
    $teameinnahmen = DB::table('teamkonto')
      ->select('TeamName', 'TKWert', 'TKName')
      ->join('team', 'team.TeamNr', '=', 'teamkonto.TKzugTeamNr')
      ->where('TKzugSaisonNr', '=', $input_saisonnr)
      ->where('TKWert', '>', 0)
      ->orderBy('TeamNr')
      ->get();
    //
    $pokaldaten[$input_saisonnr]['teameinnahmen'] = '';
    $pokaldaten[$input_saisonnr]['teameinnahmen'] = '<table>';
    //
    $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '<thead>';
    $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '<tr>';
    $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '<th>Team</th>';
    $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '<th>Einnahmetyp</th>';
    $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '<th>Einnahme</th>';
    $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '</thead>';
    foreach($teameinnahmen as $single_teameinnahme)
    {
        $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '<tr>';
        $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '<td>' . $single_teameinnahme->TeamName . '</td>';
        $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '<td>' . $single_teameinnahme->TKName . '</td>';
        $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '<td>' . number_format($single_teameinnahme->TKWert,2,",",".") . ' TCs</td>';
        $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '</tr>';
    }
    $pokaldaten[$input_saisonnr]['teameinnahmen'] .= '</table>';
    // ermittle die WM-Torjägerliste
    $torjäger = DB::table('spieltore')
      ->select('PlayerName', 'PlayerTrikotNr', 'TeamName', DB::raw('COUNT(SpielToreNr) as Tore'))
      ->join('player', 'player.PlayerNr', '=', 'spieltore.SpielTorezugPlayerNr')
      ->join('team', 'team.TeamNr', '=', 'spieltore.SpielTorezugTeamNr')
      ->groupBy('SpielTorezugPlayerNr', 'PlayerName', 'PlayerTrikotNr', 'TeamName')
      ->where('SpielTorezugSaisonNr', '=', $input_saisonnr)
      ->where('SpielTorezugSpieltypNr', '>=', 200)
      ->where('SpielToreTyp', '=', 0)
      ->limit(50)
      ->orderBy('Tore', 'desc')
      ->orderBy('TeamName')
      ->get();
    //
    $pokaldaten[$input_saisonnr]['wmtorjägerliste'] = '<table>';
    //
    $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '<thead>';
    $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '<tr>';
    $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '<th>Torschütze</th>';
    $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '<th>Verein</th>';
    $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '<th>Tore</th>';
    $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '</thead>';
    foreach($torjäger as $torschütze)
    {
        $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '<tr>';
        $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '<td>' . $torschütze->PlayerName . ' ('. $torschütze->PlayerTrikotNr . ')</td>';
        $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '<td>' . $torschütze->TeamName . '</td>';
        $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '<td>' . $torschütze->Tore . '</td>';
        $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '</tr>';
    }
    $pokaldaten[$input_saisonnr]['wmtorjägerliste'] .= '</table>';
    // ermittle die Welt-Torjägerliste
    $torjäger = DB::table('spieltore')
      ->select('PlayerName', 'PlayerTrikotNr', 'TeamName', DB::raw('COUNT(SpielToreNr) as Tore'))
      ->join('player', 'player.PlayerNr', '=', 'spieltore.SpielTorezugPlayerNr')
      ->join('team', 'team.TeamNr', '=', 'spieltore.SpielTorezugTeamNr')
      ->groupBy('SpielTorezugPlayerNr', 'PlayerName', 'PlayerTrikotNr', 'TeamName')
      ->where('SpielTorezugSaisonNr', '=', $input_saisonnr)
      ->where('SpielToreTyp', '=', 0)
      ->limit(50)
      ->orderBy('Tore', 'desc')
      ->orderBy('TeamName')
      ->get();
    //
    $pokaldaten[$input_saisonnr]['welttorjägerliste'] = '';
    $pokaldaten[$input_saisonnr]['welttorjägerliste'] = '<table>';
    //
    $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '<thead>';
    $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '<tr>';
    $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '<th>Torschütze</th>';
    $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '<th>Verein</th>';
    $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '<th>Tore</th>';
    $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '</thead>';
    foreach($torjäger as $torschütze)
    {
        $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '<tr>';
        $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '<td>' . $torschütze->PlayerName . ' ('. $torschütze->PlayerTrikotNr . ')</td>';
        $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '<td>' . $torschütze->TeamName . '</td>';
        $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '<td>' . $torschütze->Tore . '</td>';
        $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '</tr>';
    }
    $pokaldaten[$input_saisonnr]['welttorjägerliste'] .= '</table>';
    // WM-Runden
    for($saisonnr = $input_saisonnr; $saisonnr<=$input_saisonnr; $saisonnr++)
    {
      $pokaldaten[$saisonnr]['saisonnr'] = $saisonnr;
      //
      $pokaldaten[$saisonnr]['pokalrunden'] = '<div>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<table>';
      //
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<thead>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<tr>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<th>Hinspiel</th>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<th>Rückspiel</th>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '</tr>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '</thead>';
      //
      $pokalrunde = 4;
      if ($maxSaisonNr == $saisonnr) {
        $pokalrunde = $maxSzugWMRunde;
      }
      //
      $pokaltabelle = WMTabelle::where('WMzugSaisonNr', '=', $saisonnr)
        ->where('WMRunde', '<=', $pokalrunde+1)
        ->orderBy('WMNr')
        ->get();
      //
      foreach($pokaltabelle as $spiel)
      {
        $pokaldaten[$saisonnr]['pokalrunden'] .= '<tr>';
        //
        $pokaldaten[$saisonnr]['pokalrunden'] .= '<td colspan="2" class="text-center font-extrabold pt-10 pb-4">' . ermittle_Pokalrundenname($spiel->WMRunde, 2) . '</td>';
        //
        $pokaldaten[$saisonnr]['pokalrunden'] .= '</tr>';
        // Hinspiel
        $pokaldaten[$saisonnr]['pokalrunden'] .= '<tr>';
        //
        $pokaldaten[$saisonnr]['pokalrunden'] .= '<td>';
        if ($spiel->WMHSpNr>0)
        {
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Spielbericht($spiel->WMHSpNr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= '<br />';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen_Land($spiel->WMTeamANr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' ' . $spiel->WMTAHTor . ' : ' . $spiel->WMTBHTor . ' ';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen_Land($spiel->WMTeamBNr);
        } else {
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen_Land($spiel->WMTeamANr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' : ';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen_Land($spiel->WMTeamBNr);
        }
        $pokaldaten[$saisonnr]['pokalrunden'] .= '</td>';
        // Rückspiel
        $pokaldaten[$saisonnr]['pokalrunden'] .= '<td>';
        if ($spiel->WMRSpNr>0)
        {
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Spielbericht($spiel->WMRSpNr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= '<br />';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen_Land($spiel->WMTeamBNr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' ' . $spiel->WMTBRTor . ' : ' . $spiel->WMTARTor . ' ';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen_Land($spiel->WMTeamANr);
        } else {
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen_Land($spiel->WMTeamBNr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' : ';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen_Land($spiel->WMTeamANr);
        }
        //
        $pokaldaten[$saisonnr]['pokalrunden'] .= '</tr>';
      }
      //
      $pokaldaten[$saisonnr]['pokalrunden'] .= '</table>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '</div>';
    }
    return view('pages.worldchampionship_saison', [
      'seitenname'      => 'worldchampionship_saison',
      'saisonnr'        => $input_saisonnr,
      'pokaldaten'      => $pokaldaten,
      'fehlerkz'        => false,
      'fehlermeldung'   => '',
    ]);
  }
  //
  public function cup()
  {
    // ermittle notwendige Werte aus der Tabelle Steuerung
    $maxSaisonNr = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    //
    $saisonliste = Saison::select('SaisonName', 'SaisonNr')
      ->where('SaisonNr', '<=', $maxSaisonNr)
      ->orderBy('SaisonNr')
      ->get();
    //
    $saisonliste_url = '';
    //
    foreach ($saisonliste as $single_saison) {
      $saisonliste_url .= '<a href="/cup_saison/' . $single_saison->SaisonNr . '" class="block p-1 m-1 rounded-lg bg-blue-500 hover:bg-green-300" role="button">' . $single_saison->SaisonName . '</a>';
    }
    // endspielliste
    $endspielliste = '<table>';
    $endspielliste .= '<thead>';
    $endspielliste .= '<tr>';
    $endspielliste .= '<th>Saison</th>';
    $endspielliste .= '<th>Team A</th>';
    $endspielliste .= '<th>Team B</th>';
    $endspielliste .= '<th>Hinspiel</th>';
    $endspielliste .= '<th>Rückspiel</th>';
    $endspielliste .= '<th>Pokalsieger</th>';
    $endspielliste .= '<th>Land</th>';
    $endspielliste .= '</tr>';
    $endspielliste .= '</thead>';
    //
    $final_liste = DB::table('pokaltabelle')
      ->select('pokaltabelle.*', 'Heim.TeamName as HeimTeam', 'Gast.TeamName as GastTeam', 'Sieger.TeamName as SiegerTeam', 'LandName')
      ->join('team as Heim', 'Heim.TeamNr', '=', 'pokaltabelle.PTTeamANr')
      ->join('team as Gast', 'Gast.TeamNr', '=', 'pokaltabelle.PTTeamBNr')
      ->join('team as Sieger', 'Sieger.TeamNr', '=', 'pokaltabelle.PTTeamSiegerNr')
      ->join('land', 'land.LandNr', '=', 'Sieger.TzugLandNr')
      ->where('PTRunde', '=', 8)
      ->orderBy('PTzugSaisonNr')
      ->get();
    //
    foreach($final_liste as $single_finale)
    {
      $endspielliste .= '<tr>';
      $endspielliste .= '<td>' . $single_finale->PTzugSaisonNr . '</td>';
      $endspielliste .= '<td>' . $single_finale->HeimTeam . '</td>';
      $endspielliste .= '<td>' . $single_finale->GastTeam . '</td>';
      $endspielliste .= '<td>' . $single_finale->PTTAHTor . ' : ' . $single_finale->PTTBHTor . '</td>';
      $endspielliste .= '<td>' . $single_finale->PTTARTor . ' : ' . $single_finale->PTTBRTor . '</td>';
      $endspielliste .= '<td>' . $single_finale->SiegerTeam . '</td>';
      $endspielliste .= '<td>' . $single_finale->LandName . '</td>';
      $endspielliste .= '</tr>';
    }
    $endspielliste .= '</table>';
    //
    $ligawertung = DB::table('spielteam')
      ->select('LandNr', 'LandName', DB::raw('SUM(STPunkte) as Punkte'))
      ->join('team', 'team.TeamNr', '=', 'spielteam.STzugTeamNr')
      ->join('land', 'land.LandNr', '=', 'team.TzugLandNr')
      ->where('STzugSaisonNr', '<=', $maxSaisonNr)
      ->where('STTypNr', '=', 2)
      ->groupBy('LandNr', 'LandName' )
      ->orderBy(DB::raw('SUM(STPunkte)') , 'desc')
      ->get();
    //
    return view('pages.cup', [
      'seitenname'      => 'cup',
      'saisonliste_url' => $saisonliste_url,
      'endspielliste'   => $endspielliste,
      'ligawertung'     => $ligawertung
    ]);
  }
  //
  public function cup_saison($input_saisonnr)
  {
    //
    $pokaldaten = [];
    //
    $maxSaisonNr = 0;
    $maxSzugPokalRunde = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    $maxSzugPokalRunde = $steuerung->SzugPokalRunde;
    // prüfe $input_saisonnr
    if ($input_saisonnr > $maxSaisonNr || $input_saisonnr < 0)
    {
      $fehlerkz = true;
      $fehlermeldung = 'Die vorgegebene Saison ist nicht gültig.';
      return view('pages.cup_saison', [
        'seitenname'      => 'cup_saison',
        'saisonnr'        => $input_saisonnr,
        'fehlerkz'        => $fehlerkz,
        'fehlermeldung'   => $fehlermeldung,
      ]);
    }
    //
    for($saisonnr = $input_saisonnr; $saisonnr<=$input_saisonnr; $saisonnr++)
    {
      $pokaldaten[$saisonnr]['saisonnr'] = $saisonnr;
      //
      $pokaldaten[$saisonnr]['pokalrunden'] = '<div class="table-responsive-sm">';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<table class="table table-sm table-bordered table-striped">';
      //
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<thead>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<tr>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<th class="hidden md:table-cell">Runde</th>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<th>Hinspiel</th>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<th>Rückspiel</th>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '<th class="hidden md:table-cell">Sieger</th>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '</tr>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '</thead>';
      //
      $pokalrunde = 8;
      if ($maxSaisonNr == $saisonnr) {
        $pokalrunde = $maxSzugPokalRunde;
      }
      //
      $pokaltabelle = PokalTabelle::where('PTzugSaisonNr', '=', $saisonnr)
        ->where('PTRunde', '<=', $pokalrunde+1)
        ->orderBy('PTNr')
        ->get();
      //
      foreach($pokaltabelle as $spiel)
      {
        $pokaldaten[$saisonnr]['pokalrunden'] .= '<tr>';
        //
        $pokaldaten[$saisonnr]['pokalrunden'] .= '<td class="hidden md:table-cell">' . ermittle_Pokalrundenname($spiel->PTRunde, 1) . '</td>';
        // Hinspiel
        $pokaldaten[$saisonnr]['pokalrunden'] .= '<td>';
        if ($spiel->PTHSpNr>0)
        {
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen($spiel->PTTeamANr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' (' . ermittle_Teamnamen_Land($spiel->PTTeamANr) . ')';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' ' . $spiel->PTTAHTor . ' : ' . $spiel->PTTBHTor . ' ';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen($spiel->PTTeamBNr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' (' . ermittle_Teamnamen_Land($spiel->PTTeamBNr) . ')';
          $pokaldaten[$saisonnr]['pokalrunden'] .= '<br />';
          //
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Spielbericht($spiel->PTHSpNr);
        } else {
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen($spiel->PTTeamANr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' (' . ermittle_Teamnamen_Land($spiel->PTTeamANr) . ')';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' : ';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen($spiel->PTTeamBNr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' (' . ermittle_Teamnamen_Land($spiel->PTTeamBNr) . ')';
        }
        $pokaldaten[$saisonnr]['pokalrunden'] .= '</td>';
        // Rückspiel
        $pokaldaten[$saisonnr]['pokalrunden'] .= '<td>';
        if ($spiel->PTRSpNr>0)
        {
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen($spiel->PTTeamBNr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' ' . $spiel->PTTBRTor . ' : ' . $spiel->PTTARTor . ' ';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen($spiel->PTTeamANr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= '<br />';
          //
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Spielbericht($spiel->PTRSpNr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= '<br />';
        } else {
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen($spiel->PTTeamBNr);
          $pokaldaten[$saisonnr]['pokalrunden'] .= ' : ';
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen($spiel->PTTeamANr);
        }
        // Sieger
        $pokaldaten[$saisonnr]['pokalrunden'] .= '<td class="hidden md:table-cell">';
        if ($spiel->PTTeamSiegerNr>0)
        {
          $pokaldaten[$saisonnr]['pokalrunden'] .= ermittle_Teamnamen($spiel->PTTeamSiegerNr);
        }
        $pokaldaten[$saisonnr]['pokalrunden'] .= '</td>';
        //
        $pokaldaten[$saisonnr]['pokalrunden'] .= '</tr>';
      }
      //
      $pokaldaten[$saisonnr]['pokalrunden'] .= '</table>';
      $pokaldaten[$saisonnr]['pokalrunden'] .= '</div>';
    }
    //
    $ligawertung = DB::table('spielteam')
      ->select('LandNr', 'LandName', DB::raw('SUM(STPunkte) as Punkte'))
      ->join('team', 'team.TeamNr', '=', 'spielteam.STzugTeamNr')
      ->join('land', 'land.LandNr', '=', 'team.TzugLandNr')
      ->where('STzugSaisonNr', '=', $input_saisonnr)
      ->where('STTypNr', '=', 2)
      ->groupBy('LandNr', 'LandName' )
      ->orderBy(DB::raw('SUM(STPunkte)') , 'desc')
      ->get();
    //
    return view('pages.cup_saison', [
      'seitenname'      => 'cup_saison',
      'saisonnr'        => $input_saisonnr,
      'pokaldaten'      => $pokaldaten,
      'ligawertung'     => $ligawertung,
      'fehlerkz'        => false,
      'fehlermeldung'   => '',
    ]);
  }
  //
  public function team_saison($liganr, $teamnr, $input_saisonnr)
  {
    //
    $saisondaten = [];
    // ermittle die Teamdaten (teamname, teaminfo)
    $single_team = Team::where('TeamNr', '=', $teamnr)
      ->first();
    //
    if ($single_team) {
      $teamname = $single_team->TeamName;
      //
      $teaminfo = '<div class="py-1">Kontostand: ' . number_format($single_team->TeamKontostand,2,",",".") . ' TC</div>';
      $teaminfo .= '<div class="py-1">Teamwert: ' . number_format($single_team->TeamWert,0,",",".") . '</div>';
      $teaminfo .= '<div class="py-1">Spieler 2: ' . $single_team->T02 . '</div>';
      $teaminfo .= '<div class="py-1">Spieler 3: ' . $single_team->T03 . '</div>';
      $teaminfo .= '<div class="py-1">Spieler 4: ' . $single_team->T04 . '</div>';
      $teaminfo .= '<div class="py-1">Spieler 5: ' . $single_team->T05 . '</div>';
      $teaminfo .= '<div class="py-1">Spieler 6: ' . $single_team->T06 . '</div>';
      $teaminfo .= '<div class="py-1">Spieler 7: ' . $single_team->T07 . '</div>';
      $teaminfo .= '<div class="py-1">Spieler 8: ' . $single_team->T08 . '</div>';
      $teaminfo .= '<div class="py-1">Spieler 9: ' . $single_team->T09 . '</div>';
      $teaminfo .= '<div class="py-1">Spieler 10: ' . $single_team->T10 . '</div>';
      $teaminfo .= '<div class="py-1">Spieler 11: ' . $single_team->T11 . '</div>';
      $teaminfo .= '<div class="py-1">Fitness-Summe: ' . ($single_team->T02 + $single_team->T03 + $single_team->T04 + $single_team->T05 + $single_team->T06 + $single_team->T07 + $single_team->T08 + $single_team->T09 + $single_team->T10 + $single_team->T11) . '</div>';
    } else {
      $fehlerkz = true;
      $fehlermeldung = 'Die vorgegebene Team-Nr ist nicht gültig.';
      return view('pages.team_saison', [
        'seitenname'      => 'team_saison',
        'saisonnr'        => $input_saisonnr,
        'liganr'          => $liganr,
        'liganame'        => '',
        'teamnr'          => $teamnr,
        'teamname'        => '',
        'teaminfo'        => '',
        'mannschaft'      => [],
        'saisondaten'     => [],
        'fehlerkz'        => $fehlerkz,
        'fehlermeldung'   => $fehlermeldung,
      ]);
    }
    // ermittle Liganame
    $liganame = ermittle_Liganamen($liganr);
    //
    $maxSaisonNr = 0;
    $maxSzugSpieltagRunde = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    $maxSzugSpieltagRunde = $steuerung->SzugSpieltagRunde;
    // prüfe $input_saisonnr
    if ($input_saisonnr > $maxSaisonNr || $input_saisonnr < 0)
    {
      $fehlerkz = true;
      $fehlermeldung = 'Die vorgegebene Saison ist nicht gültig.';
      return view('pages.team_saison', [
        'seitenname'      => 'team_saison',
        'saisonnr'        => $input_saisonnr,
        'liganr'          => $liganr,
        'liganame'        => $liganame,
        'teamnr'          => $teamnr,
        'teamname'        => $teamname,
        'teaminfo'        => '',
        'mannschaft'      => [],
        'saisondaten'     => [],
        'fehlerkz'        => $fehlerkz,
        'fehlermeldung'   => $fehlermeldung,
      ]);
    }
    // ermittle die Namen der Mannschaft
    $mannschaft = '<table>';
    $mannschaft .= '<thead>';
    $mannschaft .= '<tr>';
    $mannschaft .= '<th>Name</th>';
    $mannschaft .= '<th>Rückennummer</th>';
    $mannschaft .= '</tr>';
    $mannschaft .= '</thead>';
    //
    $mannschaft_liste = Player::where('PzugTeamNr', '=', $teamnr)->get();
    foreach($mannschaft_liste as $player)
    {
      $mannschaft .= '<tr>';
      $mannschaft .= '<td>' . $player->PlayerName . '</td>';
      $mannschaft .= '<td>' . $player->PlayerTrikotNr . '</td>';
      $mannschaft .= '</tr>';
    }
    $mannschaft .= '</table>';
    // ermittle die bisherigen Saisonspiele
    $spielliste = '<table>';
    $spielliste .= '<thead>';
    $spielliste .= '<tr>';
    $spielliste .= '<th class="hidden md:table-cell">Spiel</th>';
    $spielliste .= '<th>Heim</th>';
    $spielliste .= '<th>Ergebnis</th>';
    $spielliste .= '<th class="text-right">Gast</th>';
    $spielliste .= '</tr>';
    $spielliste .= '</thead>';
    $spielteam_liste = DB::table('spielteam')
      ->select('spieltyp.SpielTypName as Spiel', 'Heim.TeamName as HeimTeam', 'Gast.TeamName as GastTeam', 'spiel.SpielHeimTore as HeimTore', 'spiel.SpielGastTore as GastTore')
      ->join('spiel', 'spiel.SpielNr', '=', 'spielteam.STzugSpielNr')
      ->join('spieltyp', 'spieltyp.SpieltypNr', '=', 'spiel.SpielTypNr')
      ->join('team as Heim', 'Heim.TeamNr', '=', 'spiel.SpielHeimTeamNr')
      ->join('team as Gast', 'Gast.TeamNr', '=', 'spiel.SpielGastTeamNr')
      ->where('STzugTeamNr', '=', $teamnr)
      ->where('STzugSaisonNr', '=', $input_saisonnr)
      ->get();
    //
    $playerliste = DB::table('player')
      ->select('PlayerNr', 'PlayerName', 'PlayerTrikotNr', DB::raw('COUNT(SpielToreNr) as Tore'))
      ->leftJoin('spieltore', 'spieltore.SpielTorezugPlayerNr', '=', 'player.PlayerNr')
      ->where('PzugTeamNr', '=', $teamnr)
      ->where('SpielTorezugSaisonNr', '=', $input_saisonnr)
      ->where('SpielToreTyp', '=', 0)
      ->orderBy('PlayerTrikotNr')
      ->groupBy('PlayerNr', 'PlayerName', 'PlayerTrikotNr')
      ->get();
    //
    foreach($spielteam_liste as $single_spiel)
    {
      $spielliste .= '<tr>';
      $spielliste .= '<td class="hidden md:table-cell">' . $single_spiel->Spiel . '</td>';
      $spielliste .= '<td>' . $single_spiel->HeimTeam  . '</td>';
      $spielliste .= '<td>' . $single_spiel->HeimTore . ' : ' . $single_spiel->GastTore . '</th>';
      $spielliste .= '<td class="text-right">' . $single_spiel->GastTeam . '</td>';
      $spielliste .= '</tr>';
    }
    $spielliste .= '</table>';
    //
    for($saisonnr = $input_saisonnr; $saisonnr<=$input_saisonnr; $saisonnr++)
    {
      $saisondaten[$saisonnr]['saisonnr'] = $saisonnr;
      // ====================
      // ermittle die Tabelle
      // ====================
      $saisondaten[$saisonnr]['saisontabelle'] = '<table width="100%">';
      //
      $saisondaten[$saisonnr]['saisontabelle'] .= '<thead>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '<tr>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '<th class="hidden md:table-cell text-center">Platz</th>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '<th>Team</th>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '<th class="hidden md:table-cell text-center">Spieltag</th>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '<th class="text-center">G</th>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '<th class="text-center">U</th>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '<th class="text-center">V</th>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '<th class="text-center">Tore</th>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '<th class="hidden md:table-cell text-center">Diff.</th>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '<th class="text-center">Pkt.</th>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '</tr>';
      $saisondaten[$saisonnr]['saisontabelle'] .= '</thead>';
      //
      $taballenspieltag = 30;
      if ($maxSaisonNr == $saisonnr) {
        $taballenspieltag = $maxSzugSpieltagRunde;
      }
      //
      $tabelle = DB::table('ligatabelle')
        ->select('ligatabelle.*', 'team.TeamName AS TeamName')
        ->join('team', 'team.TeamNr', '=', 'ligatabelle.LTzugTeamNr')
        ->where('LTzugSaisonNr', '=', $saisonnr)
        ->where('LTzugLandNr', '=', $liganr)
        ->where('LTSpieltag', '=', $taballenspieltag)
        ->orderBy('LTPlusPunkte', 'desc')
        ->orderBy('LTTorDifferenz', 'desc')
        ->orderBy('LTAnzahlSiege', 'desc')
        ->orderBy('LTPlusTore', 'desc')
        ->orderBy('LTzugTeamNr', 'desc')
        ->get();
      //
      foreach($tabelle as $index=>$platz)
      {
        if ($teamnr == $platz->LTzugTeamNr)
        {
          $saisondaten[$saisonnr]['saisontabelle'] .= '<tr class="table-success">';
        } else {
          $saisondaten[$saisonnr]['saisontabelle'] .= '<tr>';
        }

        $saisondaten[$saisonnr]['saisontabelle'] .= '<td class="hidden md:table-cell text-center">' . ($index + 1) . '</td>';
        $saisondaten[$saisonnr]['saisontabelle'] .= '<td>' . $platz->TeamName . '</td>';
        $saisondaten[$saisonnr]['saisontabelle'] .= '<td class="hidden md:table-cell text-center">' . $platz->LTSpieltag . '</td>';
        $saisondaten[$saisonnr]['saisontabelle'] .= '<td class="text-center">' . $platz->LTAnzahlSiege . '</td>';
        $saisondaten[$saisonnr]['saisontabelle'] .= '<td class="text-center">' . $platz->LTAnzahlUnentschieden . '</td>';
        $saisondaten[$saisonnr]['saisontabelle'] .= '<td class="text-center">' . $platz->LTAnzahlNiederlagen . '</td>';
        $saisondaten[$saisonnr]['saisontabelle'] .= '<td class="text-center">' . $platz->LTPlusTore . ':'. $platz->LTMinusTore . '</td>';
        $saisondaten[$saisonnr]['saisontabelle'] .= '<td class="hidden md:table-cell text-center">' . $platz->LTTorDifferenz . '</td>';
        $saisondaten[$saisonnr]['saisontabelle'] .= '<td class="text-center">' . $platz->LTPlusPunkte . '</td>';
        //
        $saisondaten[$saisonnr]['saisontabelle'] .= '</tr>';
      }
      //
      $saisondaten[$saisonnr]['saisontabelle'] .= '</table>';
      //
      $saisondaten[$saisonnr]['ligaheimspiele'] = '';
      //
      $ligaspiele_heim = Spiel::where('SpielzugSaisonNr', '=', $saisonnr)
        ->where('SpielHeimTeamNr', '=', $teamnr)
        ->where('SpielTypNr', '<=', 30)
        ->orderBy('SpielNr')
        ->get();
      //
      foreach($ligaspiele_heim as $single_spiel)
      {
        $saisondaten[$saisonnr]['ligaheimspiele'] .= '<div class="my-4 p-4 bg-green-300 rounded-lg border border-blue-800">';
        $saisondaten[$saisonnr]['ligaheimspiele'] .= $single_spiel->SpielBericht;
        $saisondaten[$saisonnr]['ligaheimspiele'] .= '</div>';
      }
      //
      $ligaspiele_gast = Spiel::where('SpielzugSaisonNr', '=', $saisonnr)
        ->where('SpielGastTeamNr', '=', $teamnr)
        ->where('SpielTypNr', '<=', 30)
        ->orderBy('SpielNr')
        ->get();
      //
      $saisondaten[$saisonnr]['ligagastspiele'] = '';
      //
      foreach($ligaspiele_gast as $single_spiel)
      {
        $saisondaten[$saisonnr]['ligagastspiele'] .= '<div class="my-4 p-4 bg-orange-300 rounded-lg border border-blue-800">';
        $saisondaten[$saisonnr]['ligagastspiele'] .= $single_spiel->SpielBericht;
        $saisondaten[$saisonnr]['ligagastspiele'] .= '</div>';
      }
      // ermittle die Torjägerliste
      $torjäger = DB::table('spieltore')
        ->select('PlayerName', 'PlayerTrikotNr', 'TeamName', DB::raw('COUNT(SpielToreNr) as Tore'))
        ->join('player', 'player.PlayerNr', '=', 'spieltore.SpielTorezugPlayerNr')
        ->join('team', 'team.TeamNr', '=', 'spieltore.SpielTorezugTeamNr')
        ->groupBy('SpielTorezugPlayerNr', 'PlayerName', 'PlayerTrikotNr', 'TeamName')
        ->where('SpielTorezugSaisonNr', '=', $saisonnr)
        ->where('SpielTorezugTeamNr', '=', $teamnr)
        ->where('SpielTorezugSpieltypNr', '<=', 30)
        ->where('SpielToreTyp', '=', 0)
        ->limit(15)
        ->orderBy('Tore', 'desc')
        ->orderBy('TeamName')
        ->get();
      //
      $saisondaten[$saisonnr]['ligatorjägerliste'] = '';
      $saisondaten[$saisonnr]['ligatorjägerliste'] = '<table>';
      //
      $saisondaten[$saisonnr]['ligatorjägerliste'] .= '<thead>';
      $saisondaten[$saisonnr]['ligatorjägerliste'] .= '<tr>';
      $saisondaten[$saisonnr]['ligatorjägerliste'] .= '<th>Torschütze</th>';
      $saisondaten[$saisonnr]['ligatorjägerliste'] .= '<th>Verein</th>';
      $saisondaten[$saisonnr]['ligatorjägerliste'] .= '<th>Tore</th>';
      $saisondaten[$saisonnr]['ligatorjägerliste'] .= '</thead>';
      foreach($torjäger as $torschütze)
      {
          $saisondaten[$saisonnr]['ligatorjägerliste'] .= '<tr>';
          $saisondaten[$saisonnr]['ligatorjägerliste'] .= '<td>' . $torschütze->PlayerName . ' ('. $torschütze->PlayerTrikotNr . ')</td>';
          $saisondaten[$saisonnr]['ligatorjägerliste'] .= '<td>' . $torschütze->TeamName . '</td>';
          $saisondaten[$saisonnr]['ligatorjägerliste'] .= '<td>' . $torschütze->Tore . '</td>';
          $saisondaten[$saisonnr]['ligatorjägerliste'] .= '</tr>';
      }
      $saisondaten[$saisonnr]['ligatorjägerliste'] .= '</table>';
      //
      $saisondaten[$saisonnr]['pokalheimspiele'] = '';
      //
      $pokalspiele_heim = Spiel::where('SpielzugSaisonNr', '=', $saisonnr)
        ->where('SpielHeimTeamNr', '=', $teamnr)
        ->whereBetween('SpielTypNr', [100, 120])
        ->orderBy('SpielNr')
        ->get();
      //
      foreach($pokalspiele_heim as $single_spiel)
      {
        $saisondaten[$saisonnr]['pokalheimspiele'] .= '<div class="my-4 p-4 bg-green-300 rounded-lg border border-blue-800">';
        $saisondaten[$saisonnr]['pokalheimspiele'] .= $single_spiel->SpielBericht;
        $saisondaten[$saisonnr]['pokalheimspiele'] .= '</div>';
      }
      //
      $pokalspiele_gast = Spiel::where('SpielzugSaisonNr', '=', $saisonnr)
        ->where('SpielGastTeamNr', '=', $teamnr)
        ->whereBetween('SpielTypNr', [100, 120])
        ->orderBy('SpielNr')
        ->get();
      //
      $saisondaten[$saisonnr]['pokalgastspiele'] = '';
      //
      foreach($pokalspiele_gast as $single_spiel)
      {
        $saisondaten[$saisonnr]['pokalgastspiele'] .= '<div class="my-4 p-4 bg-orange-300 rounded-lg border border-blue-800">';
        $saisondaten[$saisonnr]['pokalgastspiele'] .= $single_spiel->SpielBericht;
        $saisondaten[$saisonnr]['pokalgastspiele'] .= '</div>';
      }
      // ermittle die Torjägerliste
      $torjäger = DB::table('spieltore')
        ->select('PlayerName', 'PlayerTrikotNr', 'TeamName', DB::raw('COUNT(SpielToreNr) as Tore'))
        ->join('player', 'player.PlayerNr', '=', 'spieltore.SpielTorezugPlayerNr')
        ->join('team', 'team.TeamNr', '=', 'spieltore.SpielTorezugTeamNr')
        ->groupBy('SpielTorezugPlayerNr', 'PlayerName', 'PlayerTrikotNr', 'TeamName')
        ->where('SpielTorezugSaisonNr', '=', $saisonnr)
        ->where('SpielTorezugTeamNr', '=', $teamnr)
        ->whereBetween('SpielTorezugSpieltypNr', [100, 120])
        ->where('SpielToreTyp', '=', 0)
        ->limit(15)
        ->orderBy('Tore', 'desc')
        ->orderBy('TeamName')
        ->get();
      //
      $saisondaten[$saisonnr]['pokaltorjägerliste'] = '<table>';
      //
      $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '<thead>';
      $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '<tr>';
      $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '<th>Torschütze</th>';
      $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '<th>Verein</th>';
      $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '<th>Tore</th>';
      $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '</thead>';
      foreach($torjäger as $torschütze)
      {
          $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '<tr>';
          $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '<td>' . $torschütze->PlayerName . ' ('. $torschütze->PlayerTrikotNr . ')</td>';
          $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '<td>' . $torschütze->TeamName . '</td>';
          $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '<td>' . $torschütze->Tore . '</td>';
          $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '</tr>';
      }
      $saisondaten[$saisonnr]['pokaltorjägerliste'] .= '</table>';
    }
    //
    return view('pages.team_saison', [
      'seitenname'      => 'team_saison',
      'saisonnr'        => $input_saisonnr,
      'liganr'          => $liganr,
      'liganame'        => $liganame,
      'teamnr'          => $teamnr,
      'teamname'        => $teamname,
      'teaminfo'        => $teaminfo,
      'mannschaft'      => $mannschaft,
      'spielliste'      => $spielliste,
      'saisondaten'     => $saisondaten,
      'playerliste'     => $playerliste,
      'fehlerkz'        => false,
      'fehlermeldung'   => '',
    ]);
  }
  //
  public function team($liganr, $teamnr)
  {
    // ermittle Teamname
    $teamname = ermittle_Teamnamen($teamnr);
    // ermittle Liganame
    $liganame = ermittle_Liganamen($liganr);
    // ermittle notwendige Werte aus der Tabelle Steuerung
    $maxSaisonNr = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    //
    $saisonliste = Saison::select('SaisonName', 'SaisonNr')
      ->where('SaisonNr', '<=', $maxSaisonNr)
      ->orderBy('SaisonNr')
      ->get();
    //
    $saisonliste_url = '';
    //
    $playerliste = DB::table('player')
      ->select('PlayerNr', 'PlayerName', 'PlayerTrikotNr', DB::raw('COUNT(SpielToreNr) as Tore'))
      ->leftjoin('spieltore', 'spieltore.SpielTorezugPlayerNr', '=', 'player.PlayerNr')
      ->where('PzugTeamNr', '=', $teamnr)
      ->where('SpielTorezugSaisonNr', '<=', $maxSaisonNr)
      ->where('SpielToreTyp', '=', 0)
      ->orderBy('PlayerTrikotNr')
      ->groupBy('PlayerNr', 'PlayerName', 'PlayerTrikotNr')
      ->get();
    //
    foreach ($saisonliste as $single_saison) {
      $saisonliste_url .= '<a href="/team_saison/' . $liganr . '/'. $teamnr . '/' . $single_saison->SaisonNr . '" class="block py-1 px-2 m-1 rounded-lg bg-blue-500 hover:bg-green-300" role="button">' . $single_saison->SaisonName . '</a>';
    }
    // ermittle die bisherigen Platzierungen
    $platzierungen = '<table>';
    $platzierungen .= '<thead>';
    $platzierungen .= '<tr>';
    $platzierungen .= '<th>Saison</th>';
    $platzierungen .= '<th>Platz</th>';
    $platzierungen .= '<th>Pkt.</th>';
    $platzierungen .= '<th>S</th>';
    $platzierungen .= '<th>U</th>';
    $platzierungen .= '<th>N</th>';
    $platzierungen .= '<th class="hidden md:table-cell">Tore</th>';
    $platzierungen .= '<th>Diff.</th>';
    $platzierungen .= '</tr>';
    $platzierungen .= '</thead>';
    //
    $platzierung_liste = DB::table('ligatabelle')
      ->select('ligatabelle.*')
      ->where('LTzugTeamNr', '=', $teamnr)
      ->where('LTSpieltag', '=', 30)
      ->orderBy('LTzugSaisonNr', 'desc')
      ->get();
    //
    foreach($platzierung_liste as $single_platzierung)
    {
      $platzierungen .= '<tr>';
      $platzierungen .= '<td>' . $single_platzierung->LTzugSaisonNr . '</td>';
      $platzierungen .= '<td>' . $single_platzierung->LTPlatz . '</td>';
      $platzierungen .= '<td>' . $single_platzierung->LTPlusPunkte . '</td>';
      $platzierungen .= '<td>' . $single_platzierung->LTAnzahlSiege . '</td>';
      $platzierungen .= '<td>' . $single_platzierung->LTAnzahlUnentschieden . '</td>';
      $platzierungen .= '<td>' . $single_platzierung->LTAnzahlNiederlagen . '</td>';
      $platzierungen .= '<td class="hidden md:table-cell">' . $single_platzierung->LTPlusTore . ':' . $single_platzierung->LTMinusTore . '</td>';
      $platzierungen .= '<td>' . $single_platzierung->LTTorDifferenz . '</td>';
      $platzierungen .= '</tr>';
    }
    $platzierungen .= '</table>';
    // ermittle die bisherigen Saisonspiele
    $spielliste = '<table>';
    $spielliste .= '<thead>';
    $spielliste .= '<tr>';
    $spielliste .= '<th class="hidden md:table-cell">Spiel</th>';
    $spielliste .= '<th>Saison</th>';
    $spielliste .= '<th>Heim</th>';
    $spielliste .= '<th>Ergebnis</th>';
    $spielliste .= '<th>Gast</th>';
    //$spielliste .= '<th class="hidden md:table-cell">eigene Werte (TW,SW)</th>';
    //$spielliste .= '<th class="hidden md:table-cell">Gegner-Werte (TW,SW)</th>';
    $spielliste .= '</tr>';
    $spielliste .= '</thead>';
    $spielteam_liste = DB::table('spielteam')
      ->select('spieltyp.SpielTypName as Spiel',
        'spielteam.STTeamwert as STTeamwert',
        'spielteam.STSpielwert as STSpielwert',
        'spielteam.STGegnerTeamwert as STGegnerTeamwert',
        'spielteam.STGegnerSpielwert as STGegnerSpielwert',
        'Heim.teamname as HeimTeam',
        'Gast.teamname as GastTeam',
        'spiel.SpielHeimTore as HeimTore',
        'spiel.SpielGastTore as GastTore',
        'spiel.SpielzugSaisonNr as Saison')
      ->join('spiel', 'spiel.SpielNr', '=', 'spielteam.STzugSpielNr')
      ->join('spieltyp', 'spieltyp.SpieltypNr', '=', 'spiel.SpielTypNr')
      ->join('team as Heim', 'Heim.TeamNr', '=', 'spiel.SpielHeimTeamNr')
      ->join('team as Gast', 'Gast.TeamNr', '=', 'spiel.SpielGastTeamNr')
      ->where('STzugTeamNr', '=', $teamnr)
      ->orderBy('spiel.SpielNr', 'DESC')
      ->get();
    //
    foreach($spielteam_liste as $single_spiel)
    {
      $spielliste .= '<tr>';
      $spielliste .= '<td class="hidden md:table-cell">' . $single_spiel->Spiel . '</td>';
      $spielliste .= '<td>' . $single_spiel->Saison . '</td>';
      $spielliste .= '<td>' . $single_spiel->HeimTeam . '</td>';
      $spielliste .= '<td>' . $single_spiel->HeimTore . ' : ' . $single_spiel->GastTore . '</td>';
      $spielliste .= '<td>' . $single_spiel->GastTeam . '</td>';
      //$spielliste .= '<td class="hidden md:table-cell">' . $single_spiel->STTeamwert . ' - ' . $single_spiel->STSpielwert . '</td>';
      //$spielliste .= '<td class="hidden md:table-cell">' . $single_spiel->STGegnerTeamwert . ' - ' . $single_spiel->STGegnerSpielwert . '</td>';
      $spielliste .= '</tr>';
    }
    $spielliste .= '</table>';
    //
    $titelliste = TeamTitel::select('TeamName', 'TTName', 'SaisonName')
      ->join('team', 'team.TeamNr', '=', 'teamtitel.TTzugTeamNr')
      ->join('saison', 'saison.SaisonNr', '=', 'teamtitel.TTzugSaisonNr')
      ->where('TTzugTeamNr', '=', $teamnr)
      ->orderBy('TTzugSaisonNr')
      ->orderBy('TTTitelTypNr')
      ->get();
    //
    // ermittle die Tabelle
    $titellistetabelle= '<table width="100%">';
    //
    $titellistetabelle.= '<thead>';
    $titellistetabelle.= '<tr>';
    $titellistetabelle.= '<th>Saison</th>';
    $titellistetabelle.= '<th>Team</th>';
    $titellistetabelle.= '<th>Titel</th>';
    $titellistetabelle.= '</tr>';
    $titellistetabelle.= '</thead>';
    //
    foreach($titelliste as $index=>$titel)
    {
      $titellistetabelle.= '<tr>';
      $titellistetabelle.= '<td>' . $titel->SaisonName . '</td>';
      $titellistetabelle.= '<td>' . $titel->TeamName . '</td>';
      $titellistetabelle.= '<td>' . $titel->TTName . '</td>';
      $titellistetabelle.= '</tr>';
    }
    $titellistetabelle.= '</table>';
    //
    return view('pages.team', [
      'seitenname'        => 'team',
      'liganr'            => $liganr,
      'liganame'          => $liganame,
      'teamname'          => $teamname,
      'saisonliste_url'   => $saisonliste_url,
      'platzierungen'     => $platzierungen,
      'titellistetabelle' => $titellistetabelle,
      'spielliste'        => $spielliste,
      'playerliste'       => $playerliste,
      'fehlerkz'          => false,
      'fehlermeldung'     => '',
    ]);
  }
  //
  public function saison($liganr, $saisonnr)
  {
    // ermittle Liganame
    $liganame = ermittle_Liganamen($liganr);
    // ermittle Saisonname
    $saisonname = ermittle_Saisonnamen($saisonnr);
    //
    $maxSaisonNr = 0;
    $maxSzugSpieltagRunde = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    $maxSzugSpieltagRunde = $steuerung->SzugSpieltagRunde;
    //
    $spieltagliste_url = '';
    // =========================
    // Fall 1: Saison läuft noch
    // =========================
    if ($saisonnr == $maxSaisonNr)
    {
      for($spieltagnr = 1; $spieltagnr <= 30; $spieltagnr++)
      {
        if ($spieltagnr <= $maxSzugSpieltagRunde)
        {
          $spieltagliste_url .= '<div class="w-1/6 my-1 mx-1 rounded bg-green-400 hover:bg-green-300"><a href="/spieltag/' . $liganr . '/'. $saisonnr . '/' . $spieltagnr . '" class="block p-1">' . $spieltagnr . '. Spieltag</a></div>';
        } else {
          $spieltagliste_url .= '<div class="w-1/6 my-1 mx-1 rounded bg-red-400 hover:bg-red-300"><a href="/spieltag/' . $liganr . '/'. $saisonnr . '/' . $spieltagnr . '" class="block p-1">' . $spieltagnr . '. Spieltag</a></div>';
        }
      }
    }
    // =======================================
    // Fall 2:Saison ist bereits abgeschlossen
    // =======================================
    if ($saisonnr < $maxSaisonNr)
    {
      for($spieltagnr = 1; $spieltagnr <= 30; $spieltagnr++)
      {
        $spieltagliste_url .= '<div class="w-1/6 my-1 mx-1 rounded bg-green-400 hover:bg-green-300"><a href="/spieltag/' . $liganr . '/'. $saisonnr . '/' . $spieltagnr . '" class="block p-1">' . $spieltagnr . '. Spieltag</a></div>';
      }
    }
    //
    return view('pages.saison', [
      'seitenname'        => 'saison',
      'liganr'            => $liganr,
      'liganame'          => $liganame,
      'saisonname'        => $saisonname,
      'spieltagliste_url' => $spieltagliste_url,
    ]);
  }

  public function ermittle_Ligalivetickerdaten($liganr, $saisonnr, $spieltag, $heimnr, $gastnr)
  {
    // hier werden die Ligelivetickerdaten ermittelt
    $fehlerkz = false;
    $meldung = '';
    //
    $tormeldung = '';
    //
    $maxSaisonNr = 0;
    $maxSzugSpieltagRunde = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    $maxSzugSpieltagRunde = $steuerung->SzugSpieltagRunde;
    // plausibilisiere spieltag
    if ($spieltag > 30)
    {
      $meldung = 'Es wurde kein gültiger Spieltag vorgegeben.';
      $fehlerkz = true;
    }
    //
    if ($fehlerkz == false) {
      // ermittle, ob Spieltag schon gespielt wurde
      $spieltag_gespielt_kz = false;
      //
      if ($maxSaisonNr > $saisonnr)
      {
        $spieltag_gespielt_kz = true;
      }
      if ($maxSaisonNr == $saisonnr)
      {
        if ($maxSzugSpieltagRunde >= $spieltag)
        {
          $spieltag_gespielt_kz = true;
        }
      }
      //
      if ($spieltag_gespielt_kz == false)
      {
        $meldung = 'Es liegen noch keine Spielberichte vor, da dieser Spieltag noch nicht gespielt wurde.';
        $fehlerkz = true;
      }
    }
    //
    if ($fehlerkz == false) {
      // ermittle den Heimnamen
      $heimname = ermittle_Teamnamen($heimnr);
      // ermittle den Gastnamen
      $gastname = ermittle_Teamnamen($gastnr);
      // ermittle die Paarungen des Spieltages
      $liste_spielplan = DB::table('spiel')
        ->select(
          'spiel.SpielHeimTeamnr AS HeimTeamNr',
          'spiel.SpielGastTeamnr AS GastTeamNr',
          'Heim.TeamName AS HeimTeamName',
          'Gast.TeamName AS GastTeamName'
          )
        ->join('team as Heim', 'Heim.TeamNr', '=', 'spiel.SpielHeimTeamNr')
        ->join('team as Gast', 'Gast.TeamNr', '=', 'spiel.SpielGastTeamNr')
        ->where('spiel.SpielzugLandNr', '=', $liganr)
        ->where('spiel.SpielzugSaisonNr', '=', $saisonnr)
        ->where('spiel.SpielTypNr', '=', $spieltag)
        ->get();
      //dd('$liste_spielplan: ', $liste_spielplan[2]);

      $tore = [];
      for ($i = 0; $i <= 15; $i++)
      {
        $tore[$i] = 0;
      }
      //dd('$tore: ', $tore);

      // ermittle Ergebnisliste (liste_spielplan +  $tore) zu Beginn des Spieltages
      $ergebnisse = ermittle_Ergebnisse($liste_spielplan, $tore);
      //dd('$ergebnisse: ', $ergebnisse);

      // erster Ticker
      event(new LigaLiveTicker($meldung, $fehlerkz, 0, $ergebnisse, null));
      sleep(2);
      // ermittle jetzt die SpielteamNr für die vorgegebene Paarung
      $spielteamnr = ermittle_Spielteam_Nr($heimnr, $saisonnr, $spieltag);
      //dd('$heimnr: ' . $heimnr . ', $saisonnr: '. $saisonnr . ', $spieltag: ' . $spieltag . ', $spielteamnr: ' . $spielteamnr);
      // heimtore, gasttore
      $heimtore = 0;
      $gasttore = 0;
      //
      $torchancen = '<div class="p-4">';
      $torchancen .= '<b>' . $heimname . ' gegen ' . $gastname . '</b><br>';
      $torchancen .= '</div>';
      //
      if ($spielteamnr > 0) {
        $spieltore = DB::table('spieltore')
          ->select(
            'SpielToreMinute',
            'SpielToreTyp',
            'PlayerName',
            'PlayerTrikotNr',
            'TeamNr',
            'TeamName')
          ->join('player', 'player.PlayerNr', '=', 'spieltore.SpielTorezugPlayerNr')
          ->join('team', 'team.TeamNr', '=', 'spieltore.SpielTorezugTeamNr')
          ->where('SpielTorezugLandNr', '=', $liganr)
          ->where('SpielTorezugSaisonNr', '=', $saisonnr)
          ->where('SpielTorezugSpieltypNr', '=', $spieltag)
          ->orderBy('SpielToreMinute')
          ->get();
          //dd('spieltore:', $spieltore);

        // durchlaufe die Tabelle $spieltore
        foreach($spieltore as $spieltor)
        {
          if ($spieltor->SpielToreTyp == 0) {
            // Aktualisiere Tore
            for ($i = 0; $i <= 7; $i++)
            {
              if ($liste_spielplan[$i]->HeimTeamNr == $spieltor->TeamNr) {
                $tore[$i*2] += 1;
              }
              if ($liste_spielplan[$i]->GastTeamNr == $spieltor->TeamNr) {
                $tore[($i*2)+1] += 1;
              }
              $tormeldung = '<div class="bg-gray-400 rounded-lg font-bold mt-4 p-2 text-xs text-center"><b>Tor für ' . $spieltor->TeamName . ' durch ' . $spieltor->PlayerName .  '.</b></div>';
            }
          }
          // prüfe, ob eine Torchance für die vorgegebene Spielpaarung vorliegt
          if ($spieltor->TeamNr == $heimnr || $spieltor->TeamNr == $gastnr ) {
            $torchancen = '<div class="p-4 rounded-lg bg-green-200">';
            $torchancen .= $spieltor->SpielToreMinute . '.-te Spielminute<br>';
            $torchancen .= 'Torchance für die Mannschaft ' . $spieltor->TeamName . '.<br>';
            $torchancen .= 'Für den Spieler ' . $spieltor->PlayerName . ' mit der Nr ' . $spieltor->PlayerTrikotNr . '.<br>';
            $torchancen .= '</div>';
            //
            sleep(2);
            event(new LigaLiveTicker($meldung, $fehlerkz, $spieltor->SpielToreMinute, $ergebnisse, $torchancen));
            //
            $torchancen = '<div class="p-4 rounded-lg bg-green-200">';
            if ($spieltor->SpielToreTyp == 0)
            {
              $torchancen .= '<b>Der Spieler konnte die Torchance nutzen.</b><br>';

              if ($heimnr == $spieltor->TeamNr) {
                $heimtore += 1;
              } else {
                $gasttore += 1;
              }
              //
              $torchancen .= '<br>';
              $torchancen .= 'Neuer Spielstand:<br>';
              $torchancen .= '<b>' . $heimtore . ' : ' . $gasttore . '</b><br>';
            } else {
              $torchancen .= 'Der Spieler hat die Torchance leider vergeben.<br>';
              $torchancen .= 'Es bleibt beim Spielstand: <b>' . $heimtore . ' : ' . $gasttore . '</b><br>';
            }
            $torchancen .= '</div>';
            //
            sleep(2);
            event(new LigaLiveTicker($meldung, $fehlerkz, $spieltor->SpielToreMinute, $ergebnisse, $torchancen));
          }
          // aktualisiere ergebnisse
          $ergebnisse = ermittle_Ergebnisse($liste_spielplan, $tore) . $tormeldung;
          //dd('$ergebnisse: ', $ergebnisse);
          sleep(2);
          event(new LigaLiveTicker($meldung, $fehlerkz, $spieltor->SpielToreMinute, $ergebnisse, null));
        }
      } else {
        $meldung = 'Die Spiel-Nr konnte nicht ermittelt werden.';
        $fehlerkz = true;
      }
      // Schlussmeldung
      sleep(1);
      $ergebnisse = ermittle_Ergebnisse($liste_spielplan, $tore);
      $torchancen = '<div class="p-4 rounded-lg bg-green-300">';
      $torchancen .= 'Das Spiel ist aus.';
      $torchancen .= '</div>';
      event(new LigaLiveTicker($meldung, $fehlerkz, 90, $ergebnisse, $torchancen));
      sleep(12);
      //
      return back();

    }
  }
  public function ligaliveticker($liganr, $saisonnr, $spieltag, $heimnr, $gastnr)
  {
    // hier wird die Seite ligaliveticker.blade.php aufgerufen
    $fehlerkz = false;
    $meldung = '';
    // ermittle Liganame
    $liganame = ermittle_Liganamen($liganr);
    // ermittle Saisonname
    $saisonname = ermittle_Saisonnamen($saisonnr);
    //
    $maxSaisonNr = 0;
    $maxSzugSpieltagRunde = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    $maxSzugSpieltagRunde = $steuerung->SzugSpieltagRunde;
    // plausibilisiere spieltag
    if ($spieltag > 30)
    {
      $meldung = 'Es wurde kein gültiger Spieltag vorgegeben.';
      $fehlerkz = true;
    }
    //
    if ($fehlerkz == false) {
      // ermittle, ob Spieltag schon gespielt wurde
      $spieltag_gespielt_kz = false;
      //
      if ($maxSaisonNr > $saisonnr)
      {
        $spieltag_gespielt_kz = true;
      }
      if ($maxSaisonNr == $saisonnr)
      {
        if ($maxSzugSpieltagRunde >= $spieltag)
        {
          $spieltag_gespielt_kz = true;
        }
      }
      //
      if ($spieltag_gespielt_kz == false)
      {
        $meldung = 'Es liegen noch keine Spielberichte vor, da dieser Spieltag noch nicht gespielt wurde.';
        $fehlerkz = true;
      }
    }
    //
    if ($fehlerkz == false) {
      // ermittle den Namen des Spieltages
      $spieltagname = $spieltag . '.ter Spieltag';
      // ermittle den Heimnamen
      $heimname = ermittle_Teamnamen($heimnr);
      // ermittle den Gastnamen
      $gastname = ermittle_Teamnamen($gastnr);
    }
    //
    return view('pages.ligaliveticker', [
      'seitenname'        => 'ligaliveticker',
      'liganr'            => $liganr,
      'liganame'          => $liganame,
      'saisonnr'          => $saisonnr,
      'saisonname'        => $saisonname,
      'spieltag'          => $spieltag,
      'spieltagname'      => $spieltagname,
      'heimnr'            => $heimnr,
      'heimname'          => $heimname,
      'gastnr'            => $gastnr,
      'gastname'          => $gastname,
      'meldung'           => $meldung
    ]);
  }
  public function spieltag($liganr, $saisonnr, $spieltag)
  {
    // ermittle Liganame
    $liganame = ermittle_Liganamen($liganr);
    // ermittle Saisonname
    $saisonname = ermittle_Saisonnamen($saisonnr);
    //
    $maxSaisonNr = 0;
    $maxSzugSpieltagRunde = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    $maxSzugSpieltagRunde = $steuerung->SzugSpieltagRunde;
    // ermittle, ob Spieltag schon gespielt wurde
    $spieltag_gespielt_kz = false;
    //
    if ($maxSaisonNr > $saisonnr)
    {
      $spieltag_gespielt_kz = true;
    }
    if ($maxSaisonNr == $saisonnr)
    {
      if ($maxSzugSpieltagRunde >= $spieltag)
      {
        $spieltag_gespielt_kz = true;
      }
    }
    //
    $spieltagname = $spieltag . '.ter Spieltag';
    //
    $spielberichte = '';
    if ($spieltag_gespielt_kz == false)
    {
      $spielberichte = 'Es liegen noch keine Spielberichte vor, da dieser Spieltag noch nicht gespielt wurde.';
    }
    //
    $teamliste = '';
    $spielpaarungen = '';
    $spieltagtabelle = 'Es liegt noch keine Tabelle vor, da dieser Spieltag noch nicht gespielt wurde.';
    $torjägerliste = 'Es liegt noch keine Torjägerliste vor, da dieser Spieltag noch nicht gespielt wurde.';
    // ermittle Spielpaarungen
    if ($maxSaisonNr == $saisonnr) {
      // ermittle $liste_spielplan mit Hilfe der Tabelle SpielPlan
      if ($spieltag < 16) {
        $liste_spielplan = SpielPlan::where('SpieltagNr', '=', $spieltag)
          ->get();
      } else {
        $spieltag2 = $spieltag - 15;
        $liste_spielplan = SpielPlan::where('SpieltagNr', '=', $spieltag2)
          ->get();
      }
    } else {
      // ermittle $liste_spielplan mit Hilfe der Tabelle Spiel
      $liste_spielplan = DB::table('spiel')
        ->select('spiel.SpielHeimTeamnr AS HeimTeamNr', 'spiel.SpielGastTeamnr AS GastTeamNr')
        ->where('spiel.SpielzugLandNr', '=', $liganr)
        ->where('spiel.SpielzugSaisonNr', '=', $saisonnr)
        ->where('spiel.SpielTypNr', '=', $spieltag)
        ->get();
    }
    //
    $spielpaarungen = '<table>';
    $spielpaarungen .= '<thead>';
    $spielpaarungen .= '<tr>';
    $spielpaarungen .= '<th>Heim</th>';
    $spielpaarungen .= '<th class="text-center">Ergebnis</th>';
    $spielpaarungen .= '<th class="text-right">Gast</th>';
    $spielpaarungen .= '</thead>';
    //
    foreach($liste_spielplan as $single_spielplan) {
      if ($maxSaisonNr == $saisonnr) {
        if ($spieltag < 16) {
          $heimnr = $single_spielplan->HeimNr;
          $heimname = ermittle_Teamnamen_Spielplan($liganr, $heimnr);
          $heimteamnr = ermittle_TeamNr_Spielplan($liganr, $heimnr);
          //
          $gastnr = $single_spielplan->GastNr;
          $gastname = ermittle_Teamnamen_Spielplan($liganr, $gastnr);
          $gastteamnr = ermittle_TeamNr_Spielplan($liganr, $gastnr);
        } else
        {
          $heimnr = $single_spielplan->GastNr;
          $heimname = ermittle_Teamnamen_Spielplan($liganr, $heimnr);
          $heimteamnr = ermittle_TeamNr_Spielplan($liganr, $heimnr);
          //
          $gastnr = $single_spielplan->HeimNr;
          $gastname = ermittle_Teamnamen_Spielplan($liganr, $gastnr);
          $gastteamnr = ermittle_TeamNr_Spielplan($liganr, $gastnr);
        }
      } else {
        $heimname = ermittle_Teamnamen($single_spielplan->HeimTeamNr);
        $heimteamnr = $single_spielplan->HeimTeamNr;
        //
        $gastname = ermittle_Teamnamen($single_spielplan->GastTeamNr);
        $gastteamnr = $single_spielplan->GastTeamNr;
      }
      //
      $spiel = ermittle_Spiel($liganr, $saisonnr, $spieltag, $heimteamnr, $gastteamnr);
      //
      $heimtore = '&nbsp;';
      $gasttore = '&nbsp;';
      // Prüfe, ob Spiel vorhanden ist
      if ($spiel)
      {
        $heimtore = $spiel->SpielHeimTore;
        $gasttore = $spiel->SpielGastTore;
        //
        $spielberichte .= $spiel->SpielBericht;
        $spielberichte .= '<hr/>';
      }
      //
      $spielpaarungen .= '<tr>';
      //
      $spielpaarungen .= '<td>';
      $spielpaarungen .= $heimname;
      $spielpaarungen .= '</td>';
      $spielpaarungen .= '<td class="text-center">';
      $spielpaarungen .= $heimtore . ':' . $gasttore;
      $spielpaarungen .= '</td>';
      $spielpaarungen .= '<td class="text-right">';
      $spielpaarungen .= $gastname;
      $spielpaarungen .= '</td>';
      //
      $spielpaarungen .= '</tr>';
      // teamliste
      $teamliste .= '<div class="w-1/3 my-4 mx-1 rounded bg-blue-500 hover:bg-green-300"><a href="/ligaliveticker/' . $liganr .'/' . $saisonnr . '/' .  $spieltag . '/' . $heimteamnr . '/' . $gastteamnr  . '" class="block py-1 px-1" target="_blank">' . $heimname . '</a></div>';
      $teamliste .= '<div class="w-1/3 my-4 mx-1 rounded bg-purple-500 hover:bg-green-300"><a href="/ligaliveticker/' . $liganr .'/' . $saisonnr . '/' .  $spieltag . '/' . $heimteamnr . '/'. $gastteamnr . '" class="block py-1 px-1" target="_blank">' . $gastname . '</a></div>';
    }
    $spielpaarungen .= '</table>';
    //
    if ($spieltag_gespielt_kz)
    {
      // ermittle die Tabelle
      $spieltagtabelle= '<table width="100%">';
      //
      $spieltagtabelle.= '<thead>';
      $spieltagtabelle.= '<tr>';
      $spieltagtabelle.= '<th class="hidden md:table-cell text-center">Platz</th>';
      $spieltagtabelle.= '<th>Team</th>';
      $spieltagtabelle.= '<th class="text-center">Spieltag</th>';
      $spieltagtabelle.= '<th class="text-center">G</th>';
      $spieltagtabelle.= '<th class="text-center">U</th>';
      $spieltagtabelle.= '<th class="text-center">V</th>';
      $spieltagtabelle.= '<th class="hidden md:table-cell text-center">Tore</th>';
      $spieltagtabelle.= '<th class="text-center">Diff.</th>';
      $spieltagtabelle.= '<th class="text-center">Pkt.</th>';
      $spieltagtabelle.= '</tr>';
      $spieltagtabelle.= '</thead>';
      //
      $tabelle = DB::table('ligatabelle')
        ->select('ligatabelle.*', 'team.TeamName AS TeamName')
        ->join('team', 'team.TeamNr', '=', 'ligatabelle.LTzugTeamNr')
        ->where('LTzugSaisonNr', '=', $saisonnr)
        ->where('LTzugLandNr', '=', $liganr)
        ->where('LTSpieltag', '=', $spieltag)
        ->orderBy('LTPlusPunkte', 'desc')
        ->orderBy('LTTorDifferenz', 'desc')
        ->orderBy('LTAnzahlSiege', 'desc')
        ->orderBy('LTPlusTore', 'desc')
        ->orderBy('LTzugTeamNr', 'desc')
        ->get();
      //
      foreach($tabelle as $index=>$platz)
      {
        $spieltagtabelle.= '<tr>';
        $spieltagtabelle.= '<td class="hidden md:table-cell text-center">' . ($index + 1) . '</td>';
        $spieltagtabelle.= '<td>' . $platz->TeamName . '</td>';
        $spieltagtabelle.= '<td class="text-center">' . $platz->LTSpieltag . '</td>';
        $spieltagtabelle.= '<td class="text-center">' . $platz->LTAnzahlSiege . '</td>';
        $spieltagtabelle.= '<td class="text-center">' . $platz->LTAnzahlUnentschieden . '</td>';
        $spieltagtabelle.= '<td class="text-center">' . $platz->LTAnzahlNiederlagen . '</td>';
        $spieltagtabelle.= '<td class="hidden md:table-cell text-center">' . $platz->LTPlusTore . ':'. $platz->LTMinusTore . '</td>';
        $spieltagtabelle.= '<td class="text-center">' . $platz->LTTorDifferenz . '</td>';
        $spieltagtabelle.= '<td class="text-center">' . $platz->LTPlusPunkte . '</td>';
        $spieltagtabelle.= '</tr>';
      }
      //
      $spieltagtabelle.= '</table>';
      // ermittle die Torjägerliste
      $torjäger = DB::table('spieltore')
        ->select('PlayerName', 'PlayerTrikotNr', 'TeamName', DB::raw('COUNT(SpielToreNr) as Tore'))
        ->join('player', 'player.PlayerNr', '=', 'spieltore.SpielTorezugPlayerNr')
        ->join('team', 'team.TeamNr', '=', 'spieltore.SpielTorezugTeamNr')
        ->groupBy('SpielTorezugPlayerNr', 'PlayerName', 'PlayerTrikotNr', 'TeamName')
        ->where('SpielTorezugSaisonNr', '=', $saisonnr)
        ->where('SpielTorezugLandNr', '=', $liganr)
        ->where('SpielTorezugSpieltypNr', '<=', $spieltag)
        ->where('SpielToreTyp', '=', 0)
        ->limit(15)
        ->orderBy('Tore', 'desc')
        ->orderBy('TeamName')
        ->get();
      //
      $torjägerliste = '<table>';
      //
      $torjägerliste .= '<thead>';
      $torjägerliste .= '<tr>';
      $torjägerliste .= '<th>Torschütze</th>';
      $torjägerliste .= '<th>Verein</th>';
      $torjägerliste .= '<th>Tore</th>';
      $torjägerliste .= '</thead>';
      foreach($torjäger as $torschütze)
      {
          $torjägerliste .= '<tr>';
          $torjägerliste .= '<td>' . $torschütze->PlayerName . ' ('. $torschütze->PlayerTrikotNr . ')</td>';
          $torjägerliste .= '<td>' . $torschütze->TeamName . '</td>';
          $torjägerliste .= '<td>' . $torschütze->Tore . '</td>';
          $torjägerliste .= '</tr>';
      }
      $torjägerliste .= '</table>';
    }
    //
    $spieltagliste_url = '';
    // =========================
    // Fall 1: Saison läuft noch
    // =========================
    if ($saisonnr == $maxSaisonNr)
    {
      for($spieltagnr = 1; $spieltagnr <= 30; $spieltagnr++)
      {
        if ($spieltagnr <= $maxSzugSpieltagRunde)
        {
          if ($spieltag == $spieltagnr) {
            $spieltagliste_url .= '<div class="w-1/6 my-1 mx-1 rounded bg-orange-400 hover:bg-green-300"><a href="/spieltag/' . $liganr . '/'. $saisonnr . '/' . $spieltagnr . '" class="block p-1">' . $spieltagnr . '. Spieltag</a></div>';
          } else {
            $spieltagliste_url .= '<div class="w-1/6 my-1 mx-1 rounded bg-blue-500 hover:bg-green-300"><a href="/spieltag/' . $liganr . '/'. $saisonnr . '/' . $spieltagnr . '" class="block p-1">' . $spieltagnr . '. Spieltag</a></div>';
          }
        } else {
          if ($spieltag == $spieltagnr) {
            $spieltagliste_url .= '<div class="w-1/6 my-1 mx-1 rounded bg-orange-500 hover:bg-red-300"><a href="/spieltag/' . $liganr . '/'. $saisonnr . '/' . $spieltagnr . '" class="block p-1">' . $spieltagnr . '. Spieltag</a></div>';
          } else {
            $spieltagliste_url .= '<div class="w-1/6 my-1 mx-1 rounded bg-blue-500 hover:bg-red-300"><a href="/spieltag/' . $liganr . '/'. $saisonnr . '/' . $spieltagnr . '" class="block p-1">' . $spieltagnr . '. Spieltag</a></div>';
          }
        }
      }
    }
    // =======================================
    // Fall 2:Saison ist bereits abgeschlossen
    // =======================================
    if ($saisonnr < $maxSaisonNr)
    {
      for($spieltagnr = 1; $spieltagnr <= 30; $spieltagnr++)
      {
        if ($spieltag == $spieltagnr) {
          $spieltagliste_url .= '<div class="w-1/6 my-1 mx-1 rounded bg-orange-400 hover:bg-green-300"><a href="/spieltag/' . $liganr . '/'. $saisonnr . '/' . $spieltagnr . '" class="block p-1">' . $spieltagnr . '. Spieltag</a></div>';
        } else {
          $spieltagliste_url .= '<div class="w-1/6 my-1 mx-1 rounded bg-blue-500 hover:bg-green-300"><a href="/spieltag/' . $liganr . '/'. $saisonnr . '/' . $spieltagnr . '" class="block p-1">' . $spieltagnr . '. Spieltag</a></div>';
        }
      }
    }
    //
    return view('pages.spieltag', [
      'seitenname'        => 'spieltag',
      'liganr'            => $liganr,
      'liganame'          => $liganame,
      'saisonnr'          => $saisonnr,
      'saisonname'        => $saisonname,
      'spieltag'          => $spieltag,
      'spieltagname'      => $spieltagname,
      'spielberichte'     => $spielberichte,
      'spielpaarungen'    => $spielpaarungen,
      'spieltagtabelle'   => $spieltagtabelle,
      'torjägerliste'     => $torjägerliste,
      'spieltagliste_url' => $spieltagliste_url,
      'teamliste'         => $teamliste,
    ]);
  }
  //
  public function liga($liganr)
  {
    // ermittle Liganame
    $liganame = ermittle_Liganamen($liganr);
    // ermittle notwendige Werte aus der Tabelle Steuerung
    $maxSaisonNr = 0;
    //
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $maxSaisonNr = $steuerung->SzugSaisonNr;
    //
    $saisonliste = Saison::select('SaisonName', 'SaisonNr')
      ->where('SaisonNr', '<=', $maxSaisonNr)
      ->orderBy('SaisonNr')
      ->get();
    //
    $saisonliste_url = '';
    //
    foreach ($saisonliste as $single_saison) {
      $landesmeister = 'wird noch ermittelt';
      if ($single_saison->SaisonNr < $maxSaisonNr)
      {
        $landesmeister = ermittle_Landesmeister_Saison($single_saison->SaisonNr, $liganr);
      }
      //
      $saisonliste_url .= '<a href="/saison/' . $liganr . '/' . $single_saison->SaisonNr . '" class="block py-2 px-2 rounded-lg hover:bg-green-300">' . $single_saison->SaisonName . ' (' . $landesmeister .')</a>';
    }
    //
    $teamliste = Team::select('TeamName', 'TeamNr', 'TeamWert')
      ->where('TzugLandNr', '=', $liganr)
      ->orderBy('TeamName')
      ->get();
    //
    $teamliste_url = '';
    //
    foreach ($teamliste as $single_team) {
      $teamliste_url .= '<a href="/team/' . $liganr . '/' . $single_team->TeamNr . '" class="block py-2 px-2 rounded-lg hover:bg-green-300">' . $single_team->TeamName . '</a>';
    }
    //
    $titelliste = TeamTitel::select('TeamName', 'TTName', 'SaisonName')
      ->join('team', 'team.TeamNr', '=', 'teamtitel.TTzugTeamNr')
      ->join('saison', 'saison.SaisonNr', '=', 'teamtitel.TTzugSaisonNr')
      ->where('TTzugLandNr', '=', $liganr)
      ->orderBy('TTzugSaisonNr')
      ->orderBy('TTTitelTypNr')
      ->get();
    //
    // ermittle die Tabelle
    $titellistetabelle= '<table width="100%">';
    //
    $titellistetabelle.= '<thead>';
    $titellistetabelle.= '<tr>';
    $titellistetabelle.= '<th>Saison</th>';
    $titellistetabelle.= '<th>Team</th>';
    $titellistetabelle.= '<th>Titel</th>';
    $titellistetabelle.= '</tr>';
    $titellistetabelle.= '</thead>';
    //
    foreach($titelliste as $index=>$titel)
    {
      $titellistetabelle.= '<tr>';
      $titellistetabelle.= '<td>' . $titel->SaisonName . '</td>';
      $titellistetabelle.= '<td>' . $titel->TeamName . '</td>';
      $titellistetabelle.= '<td>' . $titel->TTName . '</td>';
      $titellistetabelle.= '</tr>';
    }
    $titellistetabelle.= '</table>';
    //
    return view('pages.leagues', [
      'seitenname'        => 'liga',
      'liganr'            => $liganr,
      'liganame'          => $liganame,
      'saisonliste_url'   => $saisonliste_url,
      'teamliste_url'     => $teamliste_url,
      'titellistetabelle' => $titellistetabelle,
    ]);
  }
  //
  public function country()
  {
    $steuerung = Steuerung::where('SNr', '=', 1)
      ->firstOrFail();
    //
    $aktSaisonNr = $steuerung->SzugSaisonNr;
    $aktSpieltagRunde = $steuerung->SzugSpieltagRunde;

    $ligen = Land::all();

    // ermittle die Tabelle
    $spieltagtabelle= '<table width="100%">';
    //
    $spieltagtabelle.= '<thead>';
    $spieltagtabelle.= '<tr>';
    $spieltagtabelle.= '<th class="hidden md:table-cell text-center">Platz</th>';
    $spieltagtabelle.= '<th>Land</th>';
    $spieltagtabelle.= '<th>Team</th>';
    $spieltagtabelle.= '<th class="text-center">Spieltag</th>';
    $spieltagtabelle.= '<th class="text-center">G</th>';
    $spieltagtabelle.= '<th class="text-center">U</th>';
    $spieltagtabelle.= '<th class="text-center">V</th>';
    $spieltagtabelle.= '<th class="hidden md:table-cell text-center">Tore</th>';
    $spieltagtabelle.= '<th class="text-center">Diff.</th>';
    $spieltagtabelle.= '<th class="text-center">Pkt.</th>';
    $spieltagtabelle.= '</tr>';
    $spieltagtabelle.= '</thead>';
    //
    $tabelle = DB::table('ligatabelle')
      ->select('ligatabelle.*', 'team.TeamName AS TeamName', 'team.TeamWert AS TeamWert', 'land.LandName AS LandName')
      ->join('team', 'team.TeamNr', '=', 'ligatabelle.LTzugTeamNr')
      ->join('land', 'land.LandNr', '=', 'ligatabelle.LTzugLandNr')
      ->where('LTzugSaisonNr', '=', $aktSaisonNr)
      ->where('LTSpieltag', '=', $aktSpieltagRunde)
      ->where('LTPlatz', '<=', 6)
      ->orderBy('LTzugLandNr')
      ->orderBy('LTPlusPunkte', 'desc')
      ->orderBy('LTTorDifferenz', 'desc')
      ->orderBy('LTAnzahlSiege', 'desc')
      ->orderBy('LTPlusTore', 'desc')
      ->orderBy('LTzugTeamNr', 'desc')
      ->get();
    //
    foreach($tabelle as $index=>$platz)
    {
      $spieltagtabelle.= '<tr>';
      $spieltagtabelle.= '<td class="hidden md:table-cell text-center">' . $platz->LTPlatz . '</td>';
      $spieltagtabelle.= '<td>' . $platz->LandName . '</td>';
      $spieltagtabelle.= '<td>' . $platz->TeamName . ' (' . $platz->TeamWert . ')</td>';
      $spieltagtabelle.= '<td class="text-center">' . $platz->LTSpieltag . '</td>';
      $spieltagtabelle.= '<td class="text-center">' . $platz->LTAnzahlSiege . '</td>';
      $spieltagtabelle.= '<td class="text-center">' . $platz->LTAnzahlUnentschieden . '</td>';
      $spieltagtabelle.= '<td class="text-center">' . $platz->LTAnzahlNiederlagen . '</td>';
      $spieltagtabelle.= '<td class="hidden md:table-cell text-center">' . $platz->LTPlusTore . ':'. $platz->LTMinusTore . '</td>';
      $spieltagtabelle.= '<td class="text-center">' . $platz->LTTorDifferenz . '</td>';
      $spieltagtabelle.= '<td class="text-center">' . $platz->LTPlusPunkte . '</td>';
      $spieltagtabelle.= '</tr>';
      //
      if($platz->LTPlatz == 6) {
        $spieltagtabelle.= '<td colspan="10"></td>';
      }
    }
    //
    $spieltagtabelle.= '</table>';
    //
    $titelliste = TeamTitel::select('TeamName', 'TTName', 'SaisonName')
      ->join('team', 'team.TeamNr', '=', 'teamtitel.TTzugTeamNr')
      ->join('saison', 'saison.SaisonNr', '=', 'teamtitel.TTzugSaisonNr')
      ->where('TTTitelTypNr', '>', 1)
      ->orderBy('TTzugSaisonNr')
      ->orderBy('TTTitelTypNr')
      ->get();
    //
    // ermittle die Tabelle
    $titellistetabelle= '<table width="100%">';
    //
    $titellistetabelle.= '<thead>';
    $titellistetabelle.= '<tr>';
    $titellistetabelle.= '<th>Saison</th>';
    $titellistetabelle.= '<th>Team</th>';
    $titellistetabelle.= '<th>Titel</th>';
    $titellistetabelle.= '</tr>';
    $titellistetabelle.= '</thead>';
    //
    foreach($titelliste as $index=>$titel)
    {
      $titellistetabelle.= '<tr>';
      $titellistetabelle.= '<td>' . $titel->SaisonName . '</td>';
      $titellistetabelle.= '<td>' . $titel->TeamName . '</td>';
      $titellistetabelle.= '<td>' . $titel->TTName . '</td>';
      $titellistetabelle.= '</tr>';
    }
    $titellistetabelle.= '</table>';
    //
    return view('pages.country', [
      'seitenname'        => 'country',
      'spieltagtabelle'   => $spieltagtabelle,
      'ligen'             => $ligen,
      'titellistetabelle' => $titellistetabelle
    ]);
  }
}

<?php

namespace App\Http\Controllers;

use App\Land;
use App\Team;
use App\Aktion;
use App\SpielTyp;
use App\SpielPlan;
use App\Steuerung;
use App\TeamKonto;
use App\TeamTitel;
use App\WMTabelle;
use App\PokalTabelle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class SpielController extends Controller
{
  //
  public function about()
  {
    // ermittle die Teams
    $teams = Team::orderBy('TeamKontostand', 'Desc')->get();

    return view('pages.about', [
      'seitenname'        => 'about',
      'fehlerkz'          => false,
      'fehlermeldung'     => '',
      'steuerung_kz'      => false,
      'aktion_kz'         => false,
      'teams'             => $teams
    ]);
  }
  //
  public function aktion()
  {
    return view('pages.aktion', [
      'seitenname'        => 'aktion',
      'fehlerkz'          => false,
      'fehlermeldung'     => '',
      'steuerung_kz'      => false,
      'aktion_kz'         => false
    ]);
  }
  //
  public function steuerungsdaten_ermitteln()
  {
    //dd("49: SpielController steuerungsdaten_ermitteln");
    $steuerungsbericht = '';
    //
    $steuerung = Steuerung::where('SNr', '=', 1)->first();
    //
    if (!$steuerung)
    {
      $fehlerkz = true;
      $fehlermeldung = 'Die Steuerungswerte konnten nicht geladen werden.';
      //
      return view('pages.aktion', [
        'seitenname'      => 'aktion',
        'fehlerkz'        => $fehlerkz,
        'fehlermeldung'   => $fehlermeldung,
        'steuerung_kz'    => false,
        'aktion_kz'       => false
      ]);
    }
    //
    $steuerungsbericht .= 'Die aktuelle Saison-Nr lautet: ' . $steuerung->SzugSaisonNr . ' <br />';
    $steuerungsbericht .= 'Die aktuelle Spieltagrunde lautet: ' . $steuerung->SzugSpieltagRunde . ' <br />';
    $steuerungsbericht .= 'Die aktuelle Pokalrunde lautet: ' . $steuerung->SzugPokalRunde . ' <br />';
    $steuerungsbericht .= 'Die aktuelle WM-Runde lautet: ' . $steuerung->SzugWMRunde . ' <br />';
    $steuerungsbericht .= 'Die aktuelle Aktion-Nr lautet: ' . $steuerung->SzugAktionNr . ' <br />';
    //
    return view('pages.aktion', [
      'seitenname'        => 'aktion',
      'fehlerkz'          => false,
      'fehlermeldung'     => '',
      'steuerung_kz'      => true,
      'aktion_kz'         => false,
      'steuerungsbericht' => $steuerungsbericht,
    ]);
  }
  //
  public function aktion_starten()
  {
      set_time_limit(0);
      ini_set('max_execution_time', 300);
      // Output-Werte
      $seitenname = 'aktion';
      $fehlerkz = false;
      $fehlermeldung = '';
      $aktionsbericht = null;
      // initialisiere notwendige Werte
      $landnr = 0;
      $aktSaisonNr = 0;
      $aktSpieltagRunde = 0;
      $aktPokalRunde = 0;
      $aktWMRunde = 0;
      // ermittle die notwendigen Steuerungsdaten
      $steuerung = Steuerung::where('SNr', '=', 1)->first();
      if (!$steuerung)
      {
        $fehlerkz = true;
        $fehlermeldung = 'Die Steuerungswerte konnten nicht geladen werden.';
        //
        return view('pages.aktion', [
          'seitenname'      => $seitenname,
          'fehlerkz'        => $fehlerkz,
          'fehlermeldung'   => $fehlermeldung,
          'steuerung_kz'    => false,
          'aktion_kz'       => false
        ]);
      }
      //
      $aktSaisonNr = $steuerung->SzugSaisonNr;
      $aktSpieltagRunde = $steuerung->SzugSpieltagRunde;
      $aktPokalRunde = $steuerung->SzugPokalRunde;
      $aktWMRunde = $steuerung->SzugWMRunde;
      $aktAktionNr = $steuerung->SzugAktionNr;
      // ermittle die Aktion
      $aktion = Aktion::where('ANr', '=', $aktAktionNr)->first();
      //
      if (!$aktion)
      {
        $fehlerkz = true;
        $fehlermeldung = 'Die Daten der nächsten Aktion konnten nicht geladen werden.';
        //
        return view('pages.aktion', [
          'seitenname'      => $seitenname,
          'fehlerkz'        => $fehlerkz,
          'fehlermeldung'   => $fehlermeldung,
          'steuerung_kz'    => false,
          'aktion_kz'       => false
        ]);
      }
      // ermittle $AzugSpielTypNr
      $AzugSpielTypNr = $aktion->AzugSpieltypNr;
      //
      $ligaspiel = false;
      $pokalspiel = false;
      $wmspiel = false;
      // ==================================
      // Fall Aktion-Nr = 1 => Saisonanfang
      // ==================================
      if ($aktAktionNr === 1) {
        $aktionsbericht = 'Die Saisoneröffnung wurde erfolgreich durchgeführt.<br />';
        // Aktualisiere die Auslosungswerte
        aktualisiere_Auslosung();
        // Aktualisiere das Attribut TeamSpielplanNr der Tabelle Team
        aktualisiere_Spielplan();
        //
        $auslosung = ermittle_Pokalauslosung($aktSaisonNr, 1, 1);
        //
        if ($auslosung['fehlerkz']) {
          return view('pages.aktion', [
            'seitenname'      => $seitenname,
            'fehlerkz'        => $auslosung['fehlerkz'],
            'fehlermeldung'   => $auslosung['fehlermeldung'],
            'steuerung_kz'    => false,
            'aktion_kz'       => false
          ]);
        }
        // Passe Werte in Tabelle Steuerung an
        $steuerung->SzugAktionNr = $aktAktionNr + 1;
        $steuerung->save();
        //
        return view('pages.aktion', [
          'seitenname'      => $seitenname,
          'fehlerkz'        => $fehlerkz,
          'fehlermeldung'   => $fehlermeldung,
          'steuerung_kz'    => false,
          'aktion_kz'       => true,
          'aktionsbericht'  => $aktionsbericht
        ]);
      }
      // =================================
      // Fall Aktion-Nr = 48 => Saisonende
      // =================================
      if ($aktAktionNr === 48) {
        $aktionsbericht = 'Die Saison wurde erfolgreich abgeschlossen.<br />';
        //
        $landesmeister = ermittle_Landesmeister($aktSaisonNr);
        // Werte Rückgabewerte aus
        if ($landesmeister['fehlerkz']) {
          return view('pages.aktion', [
            'seitenname'      => $seitenname,
            'fehlerkz'        => $landesmeister['fehlerkz'],
            'fehlermeldung'   => $landesmeister['fehlermeldung'],
            'steuerung_kz'    => false,
            'aktion_kz'       => false
          ]);
        }
        // Passe Werte in Tabelle Steuerung an
        $steuerung->SzugAktionNr = $aktAktionNr + 1;
        $steuerung->save();
        //
        return view('pages.aktion', [
          'seitenname'      => $seitenname,
          'fehlerkz'        => $fehlerkz,
          'fehlermeldung'   => $fehlermeldung,
          'steuerung_kz'    => false,
          'aktion_kz'       => true,
          'aktionsbericht'  => $aktionsbericht
        ]);
      }
      // ===================================
      // Fall Aktion-Nr = 49 => WM-Auslosung
      // ===================================
      if ($aktAktionNr === 49) {
        $aktionsbericht = 'Die WM-Auslosung wurde durchgeführt.<br />';
        // führe die WM-Auslosung (1. Runde) durch
        ermittle_Pokalauslosung($aktSaisonNr, 1, 2);
        // Passe Werte in Tabelle Steuerung an
        $steuerung->SzugAktionNr = $aktAktionNr + 1;
        $steuerung->save();
        //
        return view('pages.aktion', [
          'seitenname'      => $seitenname,
          'fehlerkz'        => $fehlerkz,
          'fehlermeldung'   => $fehlermeldung,
          'steuerung_kz'    => false,
          'aktion_kz'       => true,
          'aktionsbericht'  => $aktionsbericht
        ]);
      }
      // ==============================
      // Fall Aktion-Nr = 58 => WM-Ende
      // ==============================
      if ($aktAktionNr === 58) {
        $aktionsbericht = 'Die WM-Ende wurde erfolgreich durchgeführt.<br />';
        // Passe Werte in Tabelle Steuerung an
        $steuerung->SzugSaisonNr = $aktSaisonNr + 1;
        $steuerung->SzugSpieltagRunde = 0;
        $steuerung->SzugPokalRunde = 0;
        $steuerung->SzugWMRunde = 0;
        $steuerung->SzugAktionNr = 1;
        $steuerung->save();
        //
        $aktionsbericht .= 'Die Steuerungsdaten wurden für die nächste Saison initialisiert.<br />';
        //
        DB::table('saison')->insert([
          'SaisonNr' => $aktSaisonNr + 1,
          'SaisonName' => $aktSaisonNr + 1 . '. Saison',
        ]);
        $aktionsbericht .= 'Die nächste Saison wurde im Content-Bereich aktiviert.<br />';
        // Berechne die Einnahmen der Teams für diese Saison
        $einnahmeliste = DB::table('spielteam')
           ->select('spielteam.STzugTeamNr', 'spielteam.STTypNr', DB::raw('SUM(STPunkte) as Punkte'))
           ->where('spielteam.STzugSaisonNr', '=', $aktSaisonNr)
           ->groupBy('spielteam.STzugTeamNr')
           ->groupBy('spielteam.STTypNr')
           ->get();
        //
        foreach($einnahmeliste as $buchung)
        {
          // ermittle den Wert
          $wert = 0;
          $wertname = 'unbekannt';
          if ($buchung->STTypNr == 1) {
            $wert = $buchung->Punkte * 30000;
            $wertname = 'Liga';
          }
          if ($buchung->STTypNr == 2) {
            $wert = $buchung->Punkte * 50000;
            $wertname = 'Cup';
          }
          if ($buchung->STTypNr == 3) {
            $wert = $buchung->Punkte * 90000;
            $wertname = 'World-Champion';
          }
          $single_teamkonto = new TeamKonto;
          $single_teamkonto->TKzugTeamNr = $buchung->STzugTeamNr;
          $single_teamkonto->TKzugSaisonNr = $aktSaisonNr;
          $single_teamkonto->TKWert = $wert;
          $single_teamkonto->TKName = $wertname;
          $single_teamkonto->save();
          // Passe Team.TeamKontostand am
          $single_team = Team::find($buchung->STzugTeamNr);
          $single_team->TeamKontostand += $wert;
          $single_team->save();
        }
        $aktionsbericht .= 'Die Einnahmen für Punkte wurden ermittelt.<br />';
        // Ermittle Landesmeisterprämie
        $landesmeister = TeamTitel::where('TTzugSaisonNr', '=', $aktSaisonNr)
          ->where('TTTitelTypNr', '=', 1)
          ->orderBy('TTzugTeamNr')
          ->get();
        // hier noch alle Landesmeister durchlaufen und neuen Datensatz in TeamKonto anlegen.
        foreach($landesmeister as $meister)
        {
          $wert = 1000000;
          $wertname = 'Landesmeister';
          //
          $single_teamkonto = new TeamKonto;
          $single_teamkonto->TKzugTeamNr = $meister->TTzugTeamNr;
          $single_teamkonto->TKzugSaisonNr = $aktSaisonNr;
          $single_teamkonto->TKWert = $wert;
          $single_teamkonto->TKName = $wertname;
          $single_teamkonto->save();
          // Passe Team.TeamKontostand am
          $single_team = Team::find($meister->TTzugTeamNr);
          $single_team->TeamKontostand += $wert;
          $single_team->save();
        }
        $aktionsbericht .= 'Die Siegprämien für die Landesmeister wurden ermittelt.<br />';
        // Ermittle Pokalsieg-Prämie
        $cup = TeamTitel::where('TTzugSaisonNr', '=', $aktSaisonNr)
          ->where('TTTitelTypNr', '=', 2)
          ->first();
        //
        $wert = 2000000;
        $wertname = 'Pokalsieger';
        //
        $single_teamkonto = new TeamKonto;
        $single_teamkonto->TKzugTeamNr = $cup->TTzugTeamNr;
        $single_teamkonto->TKzugSaisonNr = $aktSaisonNr;
        $single_teamkonto->TKWert = $wert;
        $single_teamkonto->TKName = $wertname;
        $single_teamkonto->save();
        // Passe Team.TeamKontostand am
        $single_team = Team::find($cup->TTzugTeamNr);
        $single_team->TeamKontostand += $wert;
        $single_team->save();
        $aktionsbericht .= 'Die Siegprämie für den Pokalsieger wurde ermittelt.<br />';
        // Ermittle WM-Siegprämie
        $wmsieger = TeamTitel::where('TTzugSaisonNr', '=', $aktSaisonNr)
          ->where('TTTitelTypNr', '=', 3)
          ->first();
        //
        $wert = 2000000;
        $wertname = 'Weltmeister';
        //
        $single_teamkonto = new TeamKonto;
        $single_teamkonto->TKzugTeamNr = $wmsieger->TTzugTeamNr;
        $single_teamkonto->TKzugSaisonNr = $aktSaisonNr;
        $single_teamkonto->TKWert = $wert;
        $single_teamkonto->TKName = $wertname;
        $single_teamkonto->save();
        // Passe Team.TeamKontostand am
        $single_team = Team::find($wmsieger->TTzugTeamNr);
        $single_team->TeamKontostand += $wert;
        $single_team->save();
        $aktionsbericht .= 'Die Siegprämie für den Weltmeister wurde ermittelt.<br />';
        // Teamverstärkung durchführen (Geld wieder ausgeben)
        Team_Verstaerkung($aktSaisonNr);
        $aktionsbericht .= 'Die Teams wurden verstärkt, die nächste Saison kann starten.<br />';
        //
        return view('pages.aktion', [
          'seitenname'      => $seitenname,
          'fehlerkz'        => $fehlerkz,
          'fehlermeldung'   => $fehlermeldung,
          'steuerung_kz'    => false,
          'aktion_kz'       => true,
          'aktionsbericht'  => $aktionsbericht
        ]);
      }
      // ========================
      // Fall $AzugSpielTypNr > 0
      // ========================
      if ($AzugSpielTypNr > 0) {
        // Bestimme Spieltyp
        $spieltyp = SpielTyp::where('SpielTypNr', '=', $AzugSpielTypNr)->first();
        // Prüfe, ob Spieltyp gefunden wurde
        if (!$spieltyp)
        {
          $fehlerkz = true;
          $fehlermeldung = 'Die Daten des Spieltyps konnten nicht geladen werden.';
          //
          return view('pages.aktion', [
            'seitenname'      => $seitenname,
            'fehlerkz'        => $fehlerkz,
            'fehlermeldung'   => $fehlermeldung,
            'steuerung_kz'    => false,
            'aktion_kz'       => false
          ]);
        }
        // Ermittle Art des Spiels
        if ($AzugSpielTypNr <= 30) {
          $ligaspiel = true;
          //
          $aktionsbericht .= 'Es wurde der ' . $AzugSpielTypNr . '.-te Spieltag durchgeführt.<br />';
          //
          if ($AzugSpielTypNr <> $aktSpieltagRunde + 1) {
            $fehlerkz = true;
            $fehlermeldung = 'Die vorgegebene Spieltyp-Nr ist nicht gültig.<br />';
            $fehlermeldung .= $AzugSpielTypNr . '<br />';
            $fehlermeldung .= ($aktSpieltagRunde + 1) . '<br />';
            //
            return view('pages.aktion', [
              'seitenname'      => $seitenname,
              'fehlerkz'        => $fehlerkz,
              'fehlermeldung'   => $fehlermeldung,
              'steuerung_kz'    => false,
              'aktion_kz'       => false,
              'aktionsbericht'  => $aktionsbericht
            ]);
          }
          //
          $steuerung->SzugSpieltagRunde = $aktSpieltagRunde + 1;
          $steuerung->SzugAktionNr = $aktAktionNr + 1;
          $steuerung->save();
        }
        //
        if ($AzugSpielTypNr >= 100 && $AzugSpielTypNr < 200) {
          $pokalspiel = true;
          //
          $aktionsbericht .= 'Es wurde eine Pokalrunde (' . $aktion->AName . ') durchgeführt.<br />';
          //
          $steuerung->SzugPokalRunde = $AzugSpielTypNr;
          $steuerung->SzugAktionNr = $aktAktionNr + 1;
          $steuerung->save();
        }
        //
        if ($AzugSpielTypNr >= 201 && $AzugSpielTypNr < 300) {
          $wmspiel = true;
          //
          $aktionsbericht .= 'Es wurde ein WM-Spieltag (' . $aktion->AName . ') durchgeführt.<br />';
          //
          $steuerung->SzugWMRunde = $AzugSpielTypNr;
          $steuerung->SzugAktionNr = $aktAktionNr + 1;
          $steuerung->save();
        }
      }
      // ===========================
      // F A L L - L I G A S P I E L
      // ===========================
      if ($ligaspiel)
      {
        for($landnr = 1; $landnr<=16; $landnr++)
        {
          if ($AzugSpielTypNr <= 15) {
            // führe Spiele für den Spieltag durch
            $spielplan = SpielPlan::where('SpieltagNr', '=', $AzugSpielTypNr)
              ->get();
          }
          if ($AzugSpielTypNr >= 16 && $AzugSpielTypNr <= 30) {
            // führe Spiele für den Spieltag durch
            $spielplan = SpielPlan::where('SpieltagNr', '=', $AzugSpielTypNr-15)
              ->get();
          }
          //
          foreach($spielplan as $single_spielplan)
          {
            if ($AzugSpielTypNr <= 15) {
              $heimnr = $single_spielplan->HeimNr;
              $heimteamnr = ermittle_TeamNr_Spielplan($landnr, $heimnr);
              $gastnr = $single_spielplan->GastNr;
              $gastteamnr = ermittle_TeamNr_Spielplan($landnr, $gastnr);
            }
            if ($AzugSpielTypNr >= 16 && $AzugSpielTypNr <= 30) {
              $gastnr = $single_spielplan->HeimNr;
              $gastteamnr = ermittle_TeamNr_Spielplan($landnr, $gastnr);
              $heimnr = $single_spielplan->GastNr;
              $heimteamnr = ermittle_TeamNr_Spielplan($landnr, $heimnr);
            }
            // Rufe Funktion Spiel_Durchfuehrung auf
            $spielergebnis = Spiel_Durchfuehrung($aktSaisonNr, $landnr, $AzugSpielTypNr, $heimteamnr, $gastteamnr);
            // Werte Rückgabewerte aus
            if ($spielergebnis['fehlerkz']) {
              return view('pages.aktion', [
                'seitenname'      => $seitenname,
                'fehlerkz'        => $spielergebnis['fehlerkz'],
                'fehlermeldung'   => $spielergebnis['fehlermeldung'],
                'steuerung_kz'    => false,
                'aktion_kz'       => false
              ]);
            }
            //
            $aktionsbericht .= $spielergebnis['spielergebnis'];
          }
        }
      }
      // =============================
      // F A L L - P O K A L S P I E L
      // =============================
      if ($pokalspiel)
      {
        // ermittle Pokalrunde und ob Hinspiel oder Rückspiel vorliegt
        $pokaldaten = ermittle_Pokalrunde_Hin_Rueck($AzugSpielTypNr);
        //
        $pokalrunde = $pokaldaten['pokalrunde'];
        $hinspielkz = $pokaldaten['hinspielkz'];
        //
        $pokalspielliste = PokalTabelle::where('PTzugSaisonNr', '=', $aktSaisonNr)
          ->where('PTRunde', '=', $pokalrunde)
          ->get();
        //
        foreach($pokalspielliste as $single_pokalspiel)
        {
          if ($hinspielkz) {
            $heimteamnr = $single_pokalspiel->PTTeamANr;
            $gastteamnr = $single_pokalspiel->PTTeamBNr;
          } else {
            $heimteamnr = $single_pokalspiel->PTTeamBNr;
            $gastteamnr = $single_pokalspiel->PTTeamANr;
          }
          // Rufe Funktion Spiel_Durchfuehrung auf
          $spielergebnis = Spiel_Durchfuehrung($aktSaisonNr, $landnr, $AzugSpielTypNr, $heimteamnr, $gastteamnr);
          // Werte Rückgabewerte aus
          if ($spielergebnis['fehlerkz']) {
            return view('pages.aktion', [
              'seitenname'      => $seitenname,
              'fehlerkz'        => $spielergebnis['fehlerkz'],
              'fehlermeldung'   => $spielergebnis['fehlermeldung'],
              'steuerung_kz'    => false,
              'aktion_kz'       => false
            ]);
          }
          //
          $aktionsbericht .= $spielergebnis['spielergebnis'];
        }
        // Falls Rückspiel vorliegt, lose die nächste Pokalrunde aus
        if (!$hinspielkz && $pokalrunde < 8) {
          ermittle_Pokalauslosung($aktSaisonNr, $pokalrunde + 1, 1);
          $aktionsbericht .= 'Die nächste Pokalrunde wurde ausgelost.<br />';
        }
        // Falls Pokalfinale gespielt ist, dokumentieren den Titelträger
        if (!$hinspielkz && $pokalrunde == 8) {
          $pokalsieger = PokalTabelle::where('PTzugSaisonNr', '=', $aktSaisonNr)
            ->where('PTRunde', '=', 8)
            ->first();
            //
          $single_teamtitel = new TeamTitel;
          $single_teamtitel->TTzugSaisonNr = $aktSaisonNr;
          $single_teamtitel->TTzugTeamNr = $pokalsieger->PTTeamSiegerNr;
          $single_teamtitel->TTzugLandNr = ermittle_Teamnamen_LandNr($pokalsieger->PTTeamSiegerNr);
          $single_teamtitel->TTTitelTypNr = 2;
          $single_teamtitel->TTName = 'Pokalsieger';
          $single_teamtitel->save();
        }
      }
      // =========================
      // F A L L - W M - S P I E L
      // =========================
      if ($wmspiel)
      {
        // ermittle WM-Runde und ob Hinspiel oder Rückspiel vorliegt
        $wmdaten = ermittle_Pokalrunde_Hin_Rueck($AzugSpielTypNr);
        $wmrunde = $wmdaten['pokalrunde'];
        $hinspielkz = $wmdaten['hinspielkz'];
        //
        $wmspielliste = WMTabelle::where('WMzugSaisonNr', '=', $aktSaisonNr)
          ->where('WMRunde', '=', $wmrunde)
          ->get();
        //
        foreach($wmspielliste as $single_wmspiel)
        {
          if ($hinspielkz) {
            $heimteamnr = $single_wmspiel->WMTeamANr;
            $gastteamnr = $single_wmspiel->WMTeamBNr;
          } else {
            $heimteamnr = $single_wmspiel->WMTeamBNr;
            $gastteamnr = $single_wmspiel->WMTeamANr;
          }
          // Rufe Funktion Spiel_Durchfuehrung auf
          $spielergebnis = Spiel_Durchfuehrung($aktSaisonNr, $landnr, $AzugSpielTypNr, $heimteamnr, $gastteamnr);
          // Werte Rückgabewerte aus
          if ($spielergebnis['fehlerkz']) {
            return view('pages.aktion', [
              'seitenname'      => $seitenname,
              'fehlerkz'        => $spielergebnis['fehlerkz'],
              'fehlermeldung'   => $spielergebnis['fehlermeldung'],
              'steuerung_kz'    => false,
              'aktion_kz'       => false
            ]);
          }
          //
          $aktionsbericht .= $spielergebnis['spielergebnis'];
        }
        // Falls Rückspiel vorliegt, lose die nächste WM-Runde aus
        if (!$hinspielkz && $wmrunde < 4) {
          ermittle_Pokalauslosung($aktSaisonNr, $wmrunde + 1, 2);
          $aktionsbericht .= 'Die nächste WM-Runde wurde ausgelost.<br />';
        }
        // Falls WM-Finale gespielt ist, dokumentieren den Titelträger
        if (!$hinspielkz && $wmrunde == 4) {
          $wmsieger = WMTabelle::where('WMzugSaisonNr', '=', $aktSaisonNr)
            ->where('WMRunde', '=', 4)
            ->first();
          //
          $single_teamtitel = new TeamTitel;
          $single_teamtitel->TTzugSaisonNr = $aktSaisonNr;
          $single_teamtitel->TTzugTeamNr = $wmsieger->WMTeamSiegerNr;
          $single_teamtitel->TTzugLandNr = ermittle_Teamnamen_LandNr($wmsieger->WMTeamSiegerNr);
          $single_teamtitel->TTTitelTypNr = 3;
          $single_teamtitel->TTName = 'World-Champion';
          $single_teamtitel->save();
        }
      }
      // ===============================================================
      // Sende die Spielereignisse des Spieltages an den Dienst Telegram
      // ===============================================================
      if (Config::get('konstanten.telegramm.eingeschaltet'))
      {
        // Ligaspiel, Pokalspiel oder WM-Spiel
        if ($ligaspiel || $pokalspiel || $wmspiel)
        {
          // Nachrichten für die Team-Channel
          $spielereignisse = DB::table('spielereignis')
            ->select('spielereignis.*', 'team.TeamChannelID')
            ->join('spiel', 'spiel.SpielNr', '=', 'spielereignis.SEzugSpielNr')
            ->join('spielteam', 'spielteam.STzugSpielNr', '=', 'spiel.SpielNr')
            ->join('team', 'team.TeamNr', '=', 'spielteam.STzugTeamNr')
            ->where('spiel.SpielzugSaisonNr', '=', $aktSaisonNr)
            ->where('spiel.SpielTypNr', '=', $AzugSpielTypNr)
            ->where('team.TeamChannelKZ', '=', true)
            ->orderby('spielereignis.SEMinute')
            ->orderby('spielereignis.SENr')
            ->get();
          //
          foreach($spielereignisse as $single_ereignis)
          {
            $message = erzeuge_Telegram_Emoji('cheering_megaphone') . '<br />';
            if ($single_ereignis->SEzugEreignisTypNr == 13 || $single_ereignis->SEzugEreignisTypNr == 23) {
              $message = erzeuge_Telegram_Emoji('soccer_ball') . '<br />';
            }
            if ($single_ereignis->SEzugEreignisTypNr == 12 || $single_ereignis->SEzugEreignisTypNr == 22) {
              $message = erzeuge_Telegram_Emoji('pouting_face') . '<br />';
            }
            $message .= $single_ereignis->SEBeschreibung;
            schreibe_Telegram($message, $single_ereignis->TeamChannelID);
            //
            sleep(2);
          }
        }
        // Ligaspiel, versende Spielergebnisse und Tabelle
        if ($ligaspiel)
        {
          // Nachrichten für die Country-Channel - Spielergebnisse
          $countryereignisse = DB::table('spiel')
            ->select('spiel.*', 'spieltyp.SpielTypName', 'land.LandChannelID', 'HeimTeam.TeamName AS HeimName', 'GastTeam.TeamName AS GastName')
            ->join('land', 'land.LandNr', '=', 'spiel.SpielzugLandNr')
            ->join('spieltyp', 'spieltyp.SpielTypNr', '=', 'spiel.SpielTypNr')
            ->join('team AS HeimTeam', 'HeimTeam.TeamNr', '=', 'spiel.SpielHeimTeamNr')
            ->join('team AS GastTeam', 'GastTeam.TeamNr', '=', 'spiel.SpielGastTeamNr')
            ->where('spiel.SpielzugSaisonNr', '=', $aktSaisonNr)
            ->where('spiel.SpielTypNr', '=', $AzugSpielTypNr)
            ->where('land.LandChannelKZ', '=', true)
            ->orderBy('spiel.SpielzugLandNr')
            ->get();
          // ermittle Startwerte für das Land 1
          $land1 = Land::select('LandChannelID')
            ->where('LandNr', '=', 1)
            ->first();
          //
          $alt_landnr = 1;
          $alt_countrychannel = $land1->LandChannelID;
          $message = 'unbekannt';
          $message_spieltyp = 'unbekannt';
          //
          foreach($countryereignisse as $single_ereignis)
          {
            // prüfe, ob Wechsel des Landes vorliegt
            if ($alt_landnr <> $single_ereignis->SpielzugLandNr)
            {
              // verarbeite $message_spieltyp
              $sendemessage = $message_spieltyp;
              $sendemessage .= erzeuge_Telegram_Emoji('soccer_ball') . '<br />' . $message;
              // versende die Nachricht mit den Spielergebnissen an das land
              schreibe_Telegram($sendemessage, $alt_countrychannel);
              //
              $message = 'unbekannt';
              //
              sleep(1);
              // ermittle jetzt noch die Tabelle für dieses land
              $tabellenplatz = DB::table('ligatabelle')
                ->select('ligatabelle.*', 'team.TeamName AS TeamName')
                ->join('team', 'team.TeamNr', '=', 'ligatabelle.LTzugTeamNr')
                ->where('LTzugSaisonNr', '=', $aktSaisonNr)
                ->where('LTzugLandNr', '=', $alt_landnr)
                ->where('LTSpieltag', '=', $AzugSpielTypNr)
                ->orderBy('LTPlatz')
                ->get();
              //
              $tabelle = erzeuge_Telegram_Emoji('chart_with_upwards_trend') .'<br />';
              $tabelle .= $message_spieltyp;
              //
              foreach($tabellenplatz as $platz)
              {
                $tabelle .= $platz->LTPlatz . ' ' . $platz->TeamName . ' ' . $platz->LTPlusPunkte . ' Punkte<br />';
              }
              // versende die Nachricht mit den Spielergebnissen an das land
              schreibe_Telegram($tabelle, $alt_countrychannel);
              //
              sleep(1);
              // aktualisiere die Werte $alt_landnr und $alt_countrychannel
              $alt_landnr = $single_ereignis->SpielzugLandNr;
              $alt_countrychannel = $single_ereignis->LandChannelID;
            }
            if ($message == 'unbekannt')
            {
              $message_spieltyp = '<b>' . $single_ereignis->SpielTypName . '</b><br />';
              $message = '';
            }
            // ermittle Spielergebnis
            $message .= $single_ereignis->HeimName . '  <b>' . $single_ereignis->SpielHeimTore . '</b>';
            $message .= ' : ';
            $message .= '<b>' . $single_ereignis->SpielGastTore . '</b>  ' .  $single_ereignis->GastName;
            $message .= '<br />';
          }
          // verarbeite jetzt noch das letzte Land
          if ($alt_landnr > 0 && $message != 'unbekannt') {
            $sendemessage = $message_spieltyp;
            $sendemessage .= erzeuge_Telegram_Emoji('soccer_ball') . '<br />' . $message;
            // versende die Nachricht mit den Spielergebnissen an das land
            schreibe_Telegram($sendemessage, $alt_countrychannel);
            //
            sleep(1);
            // ermittle jetzt noch die Tabelle für dieses land
            $tabellenplatz = DB::table('ligatabelle')
              ->select('ligatabelle.*', 'team.TeamName AS TeamName')
              ->join('team', 'team.TeamNr', '=', 'ligatabelle.LTzugTeamNr')
              ->where('LTzugSaisonNr', '=', $aktSaisonNr)
              ->where('LTzugLandNr', '=', $alt_landnr)
              ->where('LTSpieltag', '=', $AzugSpielTypNr)
              ->orderBy('LTPlatz')
              ->get();
            //
            $tabelle = erzeuge_Telegram_Emoji('chart_with_upwards_trend') .'<br />';
            $tabelle .= $message_spieltyp;
            //
            foreach($tabellenplatz as $platz)
            {
              $tabelle .= $platz->LTPlatz . ' ' . $platz->TeamName . ' ' . $platz->LTPlusPunkte . ' Punkte<br />';
            }
            // versende die Nachricht mit den Spielergebnissen an das land
            schreibe_Telegram($tabelle, $alt_countrychannel);
            //
            sleep(1);
          }
        }
        // Pokalspiel
        if ($pokalspiel && $AzugSpielTypNr >= 105)
        {
          // versende die Nachricht an den Cup-Channel
          $cup_aktionsbericht = erzeuge_Telegram_Emoji('trophy') .'<br />';
          $cup_aktionsbericht .= $aktionsbericht;
          schreibe_Telegram($cup_aktionsbericht, $steuerung->SCupChannelID);
        }
        // WM-Spiel
        if ($wmspiel)
        {
          // versende die Nachricht an den Cup-Channel
          $wm_aktionsbericht = erzeuge_Telegram_Emoji('trophy') .'<br />';
          $wm_aktionsbericht .= $aktionsbericht;
          schreibe_Telegram($wm_aktionsbericht, $steuerung->SWMChannelID);
        }

      }
      //
      return view('pages.aktion', [
        'seitenname'      => $seitenname,
        'fehlerkz'        => $fehlerkz,
        'fehlermeldung'   => $fehlermeldung,
        'steuerung_kz'    => false,
        'aktion_kz'       => true,
        'aktionsbericht'  => $aktionsbericht,
      ]);
  }
  //
  public function news()
  {
      return view('pages.news', [
        'seitenname'      => 'news',
      ]);
  }
  //
  public function imprint()
  {
      return view('pages.imprint', [
        'seitenname'      => 'imprint',
      ]);
  }
  //
  public function contact()
  {
      return view('pages.contact', [
        'seitenname'      => 'contact',
      ]);
  }
}

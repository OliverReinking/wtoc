<?php
use App\Land;
use App\Team;
use App\Spiel;
use App\Player;
use App\Saison;
use App\SpielTyp;
use App\SpielTeam;
use App\SpielTore;
use App\Steuerung;
use App\TeamKonto;
use App\TeamTitel;
use App\WMTabelle;
use Carbon\Carbon;
use App\LigaTabelle;
use App\PokalTabelle;
use App\SpielEreignis;
use GuzzleHttp\Client;
//
use App\SpielVerletzung;
//
use App\AuslosungTabelle;
use Illuminate\Support\Facades\DB;
//
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Exception\GuzzleException;
// emoji für Telegram
function erzeuge_Telegram_Emoji($emojiname)
{
    $emoji = "\xE2\x9A\xBD";
    if ($emojiname == 'soccer_ball') {
      $emoji = "\xE2\x9A\xBD";
    }
    if ($emojiname == 'cheering_megaphone') {
      $emoji = "\xF0\x9F\x93\xA3";
    }
    if ($emojiname == 'chart_with_upwards_trend') {
      $emoji = "\xF0\x9F\x93\x88";
    }
    if ($emojiname == 'memo') {
      $emoji = "\xF0\x9F\x93\x9D";
    }
    if ($emojiname == 'pouting_face') {
      $emoji = "\xF0\x9F\x98\xA1";
    }
    if ($emojiname == 'trophy') {
      $emoji = "\xF0\x9F\x8F\x86";
    }
    return $emoji;
}
// schreibe eine Nachricht an den Dienst Telegram
function schreibe_Telegram($message, $channel_id)
{
  $send_message = '';
  // prüfe, ob channel_id vorgegeben wurde
  if (!$channel_id) {
    return;
  }
  //
  $telegram_api_token = Config::get('konstanten.telegram.api_token');
  $telegram_bot_username = Config::get('konstanten.telegram.bot_username');
  $telegram_channel_signature = Config::get('konstanten.telegram.channel_signature');
  //
  $message .= $telegram_channel_signature;
  //
  $send_message = implode("\n", explode('<br />', $message));
  //
  $telegram_apiRUL = 'https://api.telegram.org/bot' . $telegram_api_token . '/';
  //
  $client = new Client(['base_uri' => $telegram_apiRUL]);
  //
  $client->post('sendMessage',
    [
      'query' =>
      [
        'chat_id' => $channel_id,
        'text' => $send_message,
        'parse_mode' => 'HTML',
      ]
    ]
  );
}
// kaufe_Teampunkte
function kaufe_Teampunkte($teamnr, $saisonnr, $punktanzahl)
{
  $kosten = 0;
  $teamwertzuwachs = 0;
  //
  if ($punktanzahl == 0)
  {
    $kosten = 0;
    $kostenname = 'Teamwert wieder auf Standardwert zurückgesetzt.';
  }
  if ($punktanzahl == 1)
  {
    $kosten = -1250000;
    $kostenname = 'Teamverstärkung für 1.250.000 TCs.';
    $teamwertzuwachs = random_int(180,220);
  }
  if ($punktanzahl == 2)
  {
    $kosten = -2500000;
    $kostenname = 'Teamverstärkung für 2.500.000 TCs.';
    $teamwertzuwachs = random_int(360,440);
  }
  if ($punktanzahl == 3)
  {
    $kosten = -3750000;
    $kostenname = 'Teamverstärkung für 3.750.000 TCs.';
    $teamwertzuwachs = random_int(540,660);
  }
  if ($punktanzahl == 4)
  {
    $kosten = -5000000;
    $kostenname = 'Teamverstärkung für 5.000.000 TCs.';
    $teamwertzuwachs = random_int(720,880);
  }
  if ($punktanzahl == 11)
  {
    $kosten = 0;
    $kostenname = 'Teamverstärkung Landesmeister';
    $teamwertzuwachs = 100;
  }
  if ($punktanzahl == 12)
  {
    $kosten = 0;
    $kostenname = 'Teamverstärkung Pokalsieger';
    $teamwertzuwachs = 150;
  }
  if ($punktanzahl == 13)
  {
    $kosten = 0;
    $kostenname = 'Teamverstärkung Weltmeister';
    $teamwertzuwachs = 200;
  }
  //
  if ($kosten <> 0) {
    $single_teamkonto = new TeamKonto;
    $single_teamkonto->TKzugTeamNr = $teamnr;
    $single_teamkonto->TKzugSaisonNr = $saisonnr;
    $single_teamkonto->TKWert = $kosten;
    $single_teamkonto->TKName = $kostenname;
    $single_teamkonto->save();
  }
  // Passe Team.TeamKontostand am
  $single_team = Team::find($teamnr);
  if ($punktanzahl == 0)
  {
    $single_team->TeamWert = 800;
  } else {
    $single_team->TeamWert += $teamwertzuwachs;
  }
  $single_team->TeamKontostand += $kosten;
  $single_team->save();
}
// Teamverstärkung
function Team_Verstaerkung($saisonnr)
{
  $teamliste = Team::all();
  // ermittle aktuellen Pokalsieger
  $pokalsieger = TeamTitel::where('TTzugSaisonNr', '=', $saisonnr)
    ->where('TTTitelTypNr', '=', 2)
    ->first();
  $cup_teamnr = $pokalsieger->TTzugTeamNr;
  // ermittle aktuellen Weltmeister
  $weltmeister = TeamTitel::where('TTzugSaisonNr', '=', $saisonnr)
    ->where('TTTitelTypNr', '=', 3)
    ->first();
  $wm_teamnr = $weltmeister->TTzugTeamNr;
  //
  foreach($teamliste as $team)
  {
    $wert = $team->TeamKontostand;
    $alg = $team->TmAlg_Kauf;
    // Setze den Teamwert zunächst wieder auf 800
    kaufe_Teampunkte($team->TeamNr, $saisonnr, 0);
    // prüfe, ob Team aktueller Landesmeister ist
    $landesmeister = TeamTitel::where('TTzugSaisonNr', '=', $saisonnr)
      ->where('TTzugLandNr', '=', $team->TzugLandNr)
      ->where('TTTitelTypNr', '=', 1)
      ->first();
    $lm_teamnr = $landesmeister->TTzugTeamNr;
    //
    if ($team->TeamNr == $lm_teamnr) {
      kaufe_Teampunkte($team->TeamNr, $saisonnr, 11);
    }
    // prüfe, ob Team aktueller Pokalsieger ist
    if ($team->TeamNr == $cup_teamnr) {
      kaufe_Teampunkte($team->TeamNr, $saisonnr, 12);
    }
    // prüfe, ob Team aktueller Weltmeister ist
    if ($team->TeamNr == $wm_teamnr) {
      kaufe_Teampunkte($team->TeamNr, $saisonnr, 13);
    }
    //
    if ($alg == 1)
    {
      if ($wert >= 6000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 4);
      }
      if ($wert >= 1250000 && $wert < 6000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 1);
      }
    }
    if ($alg == 2)
    {
      if ($wert >= 6000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 4);
      }
      if ($wert >= 2500000 && $wert < 6000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 2);
      }
      if ($wert > 1250000 && $wert < 2500000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 1);
      }
    }
    if ($alg == 3)
    {
      if ($wert >= 3750000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 3);
      }
      if ($wert >= 2500000 && $wert < 3750000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 2);
      }
      if ($wert > 1250000 && $wert < 2500000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 1);
      }
    }
    if ($alg == 4)
    {
      if ($wert >= 5000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 4);
      }
      if ($wert >= 3750000 && $wert < 5000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 3);
      }
      if ($wert >= 2500000 && $wert < 3750000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 2);
      }
      if ($wert >= 1250000 && $wert < 2500000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 1);
      }
    }
    if ($alg == 5)
    {
      if ($wert >= 6000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 4);
      }
      if ($wert >= 2500000 && $wert < 6000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 2);
      }
    }
    if ($alg == 6)
    {
      if ($wert >= 6000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 4);
      }
      if ($wert >= 3750000 && $wert < 6000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 3);
      }
    }
    if ($alg == 7)
    {
      if ($wert >= 5000000)
      {
        kaufe_Teampunkte($team->TeamNr, $saisonnr, 4);
      }
    }
  }
}
// Spiel_Durchfuehrung
function Spiel_Durchfuehrung($saisonnr, $landnr, $spieltypnr, $heimteamnr, $gastteamnr)
{
  // notwendige Werte
  $spielnr = 0;
  $nachspielzeit = random_int(1,6);
  $spielzeit = 90 + $nachspielzeit;
  $spielereignis = '';
  $ereignistypnr = 0;
  // Rückgabewerte
  $fehlerkz = false;
  $fehlermeldung = '';
  $spielergebnis = 'Spielergebnis konnte nicht ermittelt werden.<br />';
  // Spieltyp
  $spieltyp = SpielTyp::find($spieltypnr);
  if (!$spieltyp) {
    $fehlerkz = true;
    $fehlermeldung = 'Das Spiel konnte nicht durchgeführt werden, es ist ein Fehler aufgetreten.';
    $fehlermeldung .= 'Die Werte des Spieltyps konnten nicht ermittelt werden.';
    return ([
      'fehlerkz' => $fehlerkz,
      'fehlermeldung' => $fehlermeldung,
      'spielergebnis' => $spielergebnis,
    ]);
  }
  // ermittle SpielTypName
  $SpielTypName = $spieltyp->SpielTypName;
  // Teamermittlung Heimmannschaft
  $heimteam = DB::table('team')
    ->select('team.*', 'land.LandName AS LandName')
    ->join('land', 'land.LandNr', '=', 'team.TzugLandNr')
    ->where('team.TeamNr', '=', $heimteamnr)
    ->first();
  if (!$heimteam) {
    $fehlerkz = true;
    $fehlermeldung = 'Das Spiel konnte nicht durchgeführt werden, es ist ein Fehler aufgetreten.';
    $fehlermeldung .= 'Die Werte der Heimmannschaft konnten nicht ermittelt werden.';
    return ([
      'fehlerkz' => $fehlerkz,
      'fehlermeldung' => $fehlermeldung,
      'spielergebnis' => $spielergebnis,
    ]);
  }
  // Teamermittlung Gastmannschaft
  $gastteam = DB::table('team')
    ->select('team.*', 'land.LandName AS LandName')
    ->join('land', 'land.LandNr', '=', 'team.TzugLandNr')
    ->where('team.TeamNr', '=', $gastteamnr)
    ->first();
  if (!$gastteam) {
    $fehlerkz = true;
    $fehlermeldung = 'Das Spiel konnte nicht durchgeführt werden, es ist ein Fehler aufgetreten.';
    $fehlermeldung .= 'Die Werte der Gastmannschaft konnten nicht ermittelt werden.';
    return ([
      'fehlerkz' => $fehlerkz,
      'fehlermeldung' => $fehlermeldung,
      'spielergebnis' => $spielergebnis,
    ]);
  }
  // ermittle die Taktik für jedes Team
  $heim_taktiknr = ermittle_Taktik($heimteamnr, $spieltypnr);
  $gast_taktiknr = ermittle_Taktik($gastteamnr, $spieltypnr);
  // ermittle heim_channel_kz und gast_channel_kz
  $heim_channel_kz = $heimteam->TeamChannelKZ;
  $gast_channel_kz = $gastteam->TeamChannelKZ;
  // lege neuen Datensatz in Spiel an
  $single_spiel = new Spiel;
  $single_spiel->SpielTypNr = $spieltypnr;
  $single_spiel->SpielzugLandNr = $landnr;
  $single_spiel->SpielzugSaisonNr = $saisonnr;
  $single_spiel->SpielHeimTeamNr = $heimteamnr;
  $single_spiel->SpielGastTeamNr = $gastteamnr;
  $single_spiel->HTaktikNr = $heim_taktiknr;
  $single_spiel->GTaktikNr = $gast_taktiknr;
  $single_spiel->SpielBericht = '';
  //
  $single_spiel->H02 = $heimteam->T02;
  $single_spiel->H03 = $heimteam->T03;
  $single_spiel->H04 = $heimteam->T04;
  $single_spiel->H05 = $heimteam->T05;
  $single_spiel->H06 = $heimteam->T06;
  $single_spiel->H07 = $heimteam->T07;
  $single_spiel->H08 = $heimteam->T08;
  $single_spiel->H09 = $heimteam->T09;
  $single_spiel->H10 = $heimteam->T10;
  $single_spiel->H11 = $heimteam->T11;
  //
  $single_spiel->G02 = $gastteam->T02;
  $single_spiel->G03 = $gastteam->T03;
  $single_spiel->G04 = $gastteam->T04;
  $single_spiel->G05 = $gastteam->T05;
  $single_spiel->G06 = $gastteam->T06;
  $single_spiel->G07 = $gastteam->T07;
  $single_spiel->G08 = $gastteam->T08;
  $single_spiel->G09 = $gastteam->T09;
  $single_spiel->G10 = $gastteam->T10;
  $single_spiel->G11 = $gastteam->T11;
  //
  $single_spiel->save();
  // ermittle $spielnr
  $spielnr = $single_spiel->SpielNr;
  // Spielwert der Heimmannschaft
  $heimteam_spielwert = ermittle_Spielwert($heimteamnr, $heim_taktiknr);
  // Spielwert der Gastmannschaft
  $gastteam_spielwert = ermittle_Spielwert($gastteamnr, $gast_taktiknr);
  // Die Heimmannschaft bekommt bis zu 300 Punkte zusätzlich (Tagesform)
  $heimteam_tagesform = random_int(1,300);
  // Die Gastmannschaft bekommt bis zu 200 Punkte zusätzlich (Tagesform)
  $gastteam_tagesform = random_int(1,200);
  // Begrenze Spielwert-Abstand auf maximal 300, falls Ligaspiel, aber nicht am letzten Spieltag
  $abstand = 0;
  if ($spieltypnr <= 28) {
    if ($heimteam_spielwert > $gastteam_spielwert)
    {
      $abstand = $heimteam_spielwert - $gastteam_spielwert;
      if ($abstand > 500)
      {
        // Abstand größer als 500, Reduktion auf 300
        $heimteam_spielwert = $gastteam_spielwert + 300;
      }
    }
    if ($gastteam_spielwert > $heimteam_spielwert)
    {
      $abstand = $gastteam_spielwert - $heimteam_spielwert;
      if ($abstand > 300)
      // Abstand größer als 300, Reduktion auf 200
      {
        $gastteam_spielwert = $heimteam_spielwert + 200;
      }
    }
  }
  // ermittle jetzt die Tageswerte
  $heimteam_tageswert = $heimteam_spielwert + $heimteam_tagesform;
  $gastteam_tageswert = $gastteam_spielwert + $gastteam_tagesform;
  // ermittle Teamnamen der Heimmannschaft
  $heimteam_name = $heimteam->TeamName;
  // ermittle Teamnamen der Gastmannschaft
  $gastteam_name  = $gastteam->TeamName;
  // Spielereignis Spielpaarung
  $spielereignis = '<b>' . $SpielTypName . '</b><br />';
  if ($spieltypnr > 200) {
    $heimteam_landname = $heimteam->LandName;
    $gastteam_landname = $gastteam->LandName;
    $spielereignis .= '<b>' . $heimteam_landname  . ' : ' . $gastteam_landname . '</b><br />';
    $spielereignis .= '<b>' . $heimteam_name . ' : ' . $gastteam_name . '</b><br />';
  } else {
    $spielereignis .= '<b>' . $heimteam_name . ' : ' . $gastteam_name . '</b><br />';
  }
  // Spielereignis Spielpaarung
  $ereignistypnr = Config::get('konstanten.ereignis_spielpaarung');
  insert_Spielereignis($spielnr, $heimteamnr, $gastteamnr, $heim_channel_kz, $gast_channel_kz, $ereignistypnr, $spielereignis, 0);
  //
  $spielbericht = $spielereignis;
  // initialisiere Spielwerte
  $heim_tore = 0;
  $heim_angriff_anzahl = 0;
  $heim_torchance_anzahl = 0;
  $heim_grosstorchance_anzahl = 0;
  $gast_tore = 0;
  $gast_angriff_anzahl = 0;
  $gast_torchance_anzahl = 0;
  $gast_grosstorchance_anzahl = 0;
  //
  for($i = 1; $i<=$spielzeit; $i++)
  {
    // =======
    // Phase 1
    // =======
    // ermittle welche Mannschaft angreifen darf
    $angriff = 0;
    $heim_zufallszahl = random_int(1,$heimteam_tageswert);
    $gast_zufallszahl = random_int(1,$gastteam_tageswert);
    //
    if ($heim_zufallszahl >= $gast_zufallszahl) {
      $angriff = 1;
      $heim_angriff_anzahl += 1;
    } else {
      $angriff = 2;
      $gast_angriff_anzahl += 1;
    }
    // Prüfe, ob Werte identisch sind: Falls ja Verletzung bei der Gastmannschaft
    // Teamermittlung
    if ($heim_zufallszahl == $gast_zufallszahl) {
      $teamv_verletzung = random_int(1,2);
      $teamv_zufallszahl = 0;
      $spielbericht .= '<b>' . $i . '.-te Spielminute: Spielunterbrechnung. Ein Spieler wurde offenbar verletzt.</b><br />';
      // Prüfe, zu welcher Mannschaft der verletzte Spieler gehört
      if ($teamv_verletzung == 2) {
        // Spieler gehört zur Heimmannschaft
        $spielereignis = '<b>' . $i . '.-te Spielminute</b><br />Ein Spieler der Mannschaft ' . $heimteam_name . ' wurde schwer verletzt.<br />';
        // Ziehe vom $heimteam_tageswert 480 ab, aber nur falls dieser > 800 ist!
        if ($heimteam_tageswert > 800) {
          $heimteam_tageswert += -480;
        }
        // Ziehe 2 bis 10 Prozent vom aktuellen Teamwert ab, aber nur falls dieser > 900 ist!
        $single_team = Team::find($heimteamnr);
        if ($single_team->TeamWert > 900)
        {
          $x1 = intval($single_team->TeamWert * 2 / 100);
          $x2 = intval($single_team->TeamWert * 20 / 100);
          //
          $teamv_zufallszahl = random_int($x1, $x2);
          $spielereignis .= 'Die Verletzung des Spielers ist ' . ermittle_Verletzungsgrad($teamv_zufallszahl) . '.<br />';
          //
          $single_team->TeamWert += -$teamv_zufallszahl;
          $single_team->save();
          // erhöhe jetzt noch den Teamwert des Gastes
          $single_team_gegner = Team::find($gastteamnr);
          if ($single_team_gegner->TeamWert < 1600)
          {
            $single_team_gegner->TeamWert += $teamv_zufallszahl;
            $single_team_gegner->save();
          }
        } else {
          $spielereignis .= 'Die Verletzung ist nicht schwerwiegend.<br />';
        }
        // Spielereignis Verletzung eines Spielers der Heimmannschaft
        $ereignistypnr = Config::get('konstanten.ereignis_verletzung_heim');
        insert_Spielereignis($spielnr, $heimteamnr, $gastteamnr, $heim_channel_kz, $gast_channel_kz, $ereignistypnr, $spielereignis, $i);
        //
        $spielbericht .= $spielereignis;
        //
        $verletzung = insert_Verletzung($landnr, $saisonnr, $spieltypnr, $spielnr, $heimteamnr, $teamv_zufallszahl, $i);
      }
      if ($teamv_verletzung == 1) {
        // Spieler gehört zur Gastmannschaft
        $spielereignis = '<b>' . $i . '.-te Spielminute</b><br />Ein Spieler der Mannschaft ' . $gastteam_name . ' wurde schwer verletzt.<br />';
        // Ziehe vom $gastteam_tageswert 480 ab, aber nur falls dieser > 800 ist!
        if ($gastteam_tageswert > 800) {
          $gastteam_tageswert += -480;
        }
        // Ziehe 2 bis 10 Prozent vom aktuellen Teamwert ab, aber nur falls dieser > 900 ist!
        $single_team = Team::find($gastteamnr);
        if ($single_team->TeamWert > 900)
        {
          $x1 = intval($single_team->TeamWert * 2 / 100);
          $x2 = intval($single_team->TeamWert * 10 / 100);
          //
          $teamv_zufallszahl = random_int($x1, $x2);
          $spielereignis .= '<b>Die Verletzung des Spielers ist ' . ermittle_Verletzungsgrad($teamv_zufallszahl) . '.</b><br />';
          //
          $single_team->TeamWert += -$teamv_zufallszahl;
          $single_team->save();
          // erhöhe jetzt noch den Teamwert des Gastes
          $single_team_gegner = Team::find($heimteamnr);
          if ($single_team_gegner->TeamWert < 1600)
          {
            $single_team_gegner->TeamWert += $teamv_zufallszahl;
            $single_team_gegner->save();
          }
        } else {
          $spielereignis .= 'Die Verletzung ist nicht schwerwiegend.<br />';
        }
        // Spielereignis Verletzung eines Spielers der Gastmannschaft
        $ereignistypnr = Config::get('konstanten.ereignis_verletzung_gast');
        insert_Spielereignis($spielnr, $heimteamnr, $gastteamnr, $heim_channel_kz, $gast_channel_kz, $ereignistypnr, $spielereignis, $i);
        //
        $spielbericht .= $spielereignis;
        //
        $verletzung = insert_Verletzung($landnr, $saisonnr, $spieltypnr, $spielnr, $gastteamnr, $teamv_zufallszahl, $i);
      }
    }
    // =======
    // Phase 2
    // =======
    if ($angriff == 1) {
      // Heimmannschaft greift an
      $heim_zufallszahl = random_int(1,$heimteam_tageswert);
      $gast_zufallszahl = random_int(1,$gastteam_tageswert);
      $tor_zufallszahl = random_int(1,100);
      //
      if ($heim_zufallszahl >= $gast_zufallszahl) {
        // Heimmannschaft hat eine Torchance
        $heim_torchance_anzahl += 1;
        //
        if ($tor_zufallszahl < 12) {
          // Torchance
          $heim_grosstorchance_anzahl += 1;
          // Spielereignis Torchance für die Heimmannschaft
          $spielereignis = '<b>' . $i . '.-te Spielminute</b><br />Torchance für ' . $heimteam_name . '<br />';
          $ereignistypnr = Config::get('konstanten.ereignis_torchance_heim');
          insert_Spielereignis($spielnr, $heimteamnr, $gastteamnr, $heim_channel_kz, $gast_channel_kz, $ereignistypnr, $spielereignis, $i);
          //
          $spielbericht .= $spielereignis;
          // prüfe, ob Tor vorliegt
          if ($tor_zufallszahl < 7) {
            $heim_tore += 1;
            // füge Tor in Tabelle SpielTore ein
            $trikotnr = ermittle_Torschuetzen();
            $torschuetze = null;
            $torschuetze = insert_Tor($landnr, $saisonnr, $spieltypnr, $spielnr, $heimteamnr, $trikotnr, $i, 0);
            // Spielereignis Tor für die Heimmannschaft
            $spielereignis = '<b>T O R</b>  für ' . $heimteam_name . ' gegen '. $gastteam_name . '<br />';
            $spielereignis .= 'Aktueller Spielstand ' . $heim_tore . ' : ' . $gast_tore .  '<br />';

            //$spielereignis .= 'Torschütze war der Spieler mit der Nummer ' . $trikotnr . ': ' . $torschuetze['playername'] .'<br />';
            $spielereignis .= 'Torschütze war der Spieler mit der Nummer ' . $trikotnr . '<br />';

            $ereignistypnr = Config::get('konstanten.ereignis_tor_erzielt_heim');
            insert_Spielereignis($spielnr, $heimteamnr, $gastteamnr, $heim_channel_kz, $gast_channel_kz, $ereignistypnr, $spielereignis, $i);
            //
            $spielbericht .= $spielereignis;
          } else {
            // füge Großchance in Tabelle SpielTore ein
            $trikotnr = ermittle_Torschuetzen();
            $torschuetze = null;
            $torschuetze = insert_Tor($landnr, $saisonnr, $spieltypnr, $spielnr, $heimteamnr, $trikotnr, $i, 1);
            // Spielereignis vergebene Torchance für die Heimmannschaft
            $spielereignis = 'Die Torchance wurde vergeben.<br />';
            $spielereignis .= '<b>Kein Tor</b> im Spiel ' . $heimteam_name . ' gegen '. $gastteam_name . '<br />';
            $spielereignis .= 'Der Spieler ' . $torschuetze['playername'] . ' mit der Nummer ' . $trikotnr . ' hat die Chance vergeben.<br />';
            $spielereignis .= 'Es bleibt beim Spielstand ' . $heim_tore . ' : ' . $gast_tore .  '<br />';
            $ereignistypnr = Config::get('konstanten.ereignis_torchance_vergeben_heim');
            insert_Spielereignis($spielnr, $heimteamnr, $gastteamnr, $heim_channel_kz, $gast_channel_kz, $ereignistypnr, $spielereignis, $i);
            //
            $spielbericht .= $spielereignis;
          }
          $spielbericht .= '<br />';
        }
      }
    }
    if ($angriff == 2) {
      $heim_zufallszahl = random_int(1,$heimteam_tageswert);
      $gast_zufallszahl = random_int(1,$gastteam_tageswert);
      $tor_zufallszahl = random_int(1,100);
      //
      if ($gast_zufallszahl >= $heim_zufallszahl) {
        // Gastmannschaft hat eine Torchance
        $gast_torchance_anzahl += 1;
        //
        if ($tor_zufallszahl < 12) {
          // Torchance
          $gast_grosstorchance_anzahl += 1;
          // Spielereignis Torchance für die Gastmannswchaft
          $spielereignis = '<b>' . $i . '.-te Spielminute</b><br />Torchance für ' . $gastteam_name . '<br />';
          $ereignistypnr = Config::get('konstanten.ereignis_torchance_gast');
          insert_Spielereignis($spielnr, $heimteamnr, $gastteamnr, $heim_channel_kz, $gast_channel_kz, $ereignistypnr, $spielereignis, $i);
          //
          $spielbericht .= $spielereignis;
          // prüfe, ob Tor vorliegt
          if ($tor_zufallszahl < 7) {
            $gast_tore += 1;
            // füge Tor in Tabelle SpielTore ein
            $trikotnr = ermittle_Torschuetzen();
            $torschuetze = null;
            $torschuetze = insert_Tor($landnr, $saisonnr, $spieltypnr, $spielnr, $gastteamnr, $trikotnr, $i, 0);
            // Spielereignis Tor für die Gastmannswchaft
            $spielereignis = '<b>T O R</b>  für den Gast ' . $gastteam_name . ' gegen ' . $heimteam_name . '<br />';
            $spielereignis .= 'Aktueller Spielstand ' . $heim_tore . ' : ' . $gast_tore .  '<br />';
            $spielereignis .= 'Torschütze war der Spieler mit der Nummer ' . $trikotnr . '<br />';
            $ereignistypnr = Config::get('konstanten.ereignis_tor_erzielt_gast');
            insert_Spielereignis($spielnr, $heimteamnr, $gastteamnr, $heim_channel_kz, $gast_channel_kz, $ereignistypnr, $spielereignis, $i);
            //
            $spielbericht .= $spielereignis;
          } else {
            // füge Großchance in Tabelle SpielTore ein
            $trikotnr = ermittle_Torschuetzen();
            $torschuetze = null;
            $torschuetze = insert_Tor($landnr, $saisonnr, $spieltypnr, $spielnr, $gastteamnr, $trikotnr, $i, 1);
            // Spielereignis vergebene Torchance für die Gastmannswchaft
            $spielereignis = 'Die Torchance wurde vergeben.<br />';
            $spielereignis .= '<b>Kein Tor</b> im Spiel ' . $heimteam_name . ' gegen '. $gastteam_name . '<br />';
            $spielereignis .= 'Der Spieler mit der Nummer ' . $trikotnr . ' hat die Chance vergeben.<br />';
            $spielereignis .= 'Es bleibt beim Spielstand ' . $heim_tore . ' : ' . $gast_tore .  '<br />';
            $ereignistypnr = Config::get('konstanten.ereignis_torchance_vergeben_gast');
            insert_Spielereignis($spielnr, $heimteamnr, $gastteamnr, $heim_channel_kz, $gast_channel_kz, $ereignistypnr, $spielereignis, $i);
            //
            $spielbericht .= $spielereignis;
          }
          $spielbericht .= '<br />';
        }
      }
    }
  }
  // Spielereignis Endergebnis
  $spielereignis = '<b>ENDERGEBNIS</b><br />';
  $spielereignis .= $heimteam_name . ' ' . $heim_tore . ' : ' . $gast_tore . ' ' . $gastteam_name . '<br />';
  $ereignistypnr = Config::get('konstanten.ereignis_endergebnis');
  insert_Spielereignis($spielnr, $heimteamnr, $gastteamnr, $heim_channel_kz, $gast_channel_kz, $ereignistypnr, $spielereignis, 100);
  // Ermittle Rückgabewert $spielergebnis
  $spielergebnis = $heimteam_name . ' ' . $heim_tore . ' : ' . $gast_tore . ' ' . $gastteam_name . '<br />';
  // Schreibe weitere Daten in den Spielbericht
  $spielbericht .= '<br />';
  $spielbericht .= '<h6>Endergebnis ' . $heim_tore . ' : ' . $gast_tore . '</h6>';
  //
  if ($heim_tore > $gast_tore) {
    $heimpunkte = 3;
    $gastpunkte = 0;
    $single_spiel->SpielHeimPunkte = 3;
    $single_spiel->SpielGastPunkte = 0;
  }
  if ($heim_tore == $gast_tore) {
    $heimpunkte = 1;
    $gastpunkte = 1;
    $single_spiel->SpielHeimPunkte = 1;
    $single_spiel->SpielGastPunkte = 1;
  }
  if ($heim_tore < $gast_tore) {
    $heimpunkte = 0;
    $gastpunkte = 3;
    $single_spiel->SpielHeimPunkte = 0;
    $single_spiel->SpielGastPunkte = 3;
  }
  //
  $single_spiel->SpielBericht = $spielbericht;
  //
  $single_spiel->HeimSpielWert = $heimteam_tageswert;
  $single_spiel->SpielHeimTore = $heim_tore;
  $single_spiel->SpielHeimTordifferenz = $heim_tore - $gast_tore;
  //
  $single_spiel->GastSpielWert = $gastteam_tageswert;
  $single_spiel->SpielGastTore = $gast_tore;
  $single_spiel->SpielGastTordifferenz = $gast_tore - $heim_tore;
  //
  $single_spiel->save();
  // ====================================================
  // Speichere jetzt noch zwei Datensätze in SpielTeam ab
  // ====================================================
  // ermittle tpynr
  $typnr = 1;
  if ($spieltypnr > 100 && $spieltypnr < 200) {
    $typnr = 2;
  }
  if ($spieltypnr > 200) {
    $typnr = 3;
  }
  //
  $teamspiel_a = new SpielTeam;
  $teamspiel_a->STzugSpielNr = $spielnr;
  $teamspiel_a->STzugSaisonNr = $saisonnr;
  $teamspiel_a->STzugTeamNr = $heimteamnr;
  $teamspiel_a->STTypNr = $typnr;
  $teamspiel_a->STW02 = $heimteam->T02;
  $teamspiel_a->STW03 = $heimteam->T03;
  $teamspiel_a->STW04 = $heimteam->T04;
  $teamspiel_a->STW05 = $heimteam->T05;
  $teamspiel_a->STW06 = $heimteam->T06;
  $teamspiel_a->STW07 = $heimteam->T07;
  $teamspiel_a->STW08 = $heimteam->T08;
  $teamspiel_a->STW09 = $heimteam->T09;
  $teamspiel_a->STW10 = $heimteam->T10;
  $teamspiel_a->STW11 = $heimteam->T11;
  $teamspiel_a->STTaktikNr = $heim_taktiknr;
  $teamspiel_a->STTeamwert = $heimteam->TeamWert;
  $teamspiel_a->STSpielwert = $heimteam_tageswert;
  $teamspiel_a->STTore = $heim_tore;
  $teamspiel_a->STGegenTore = $gast_tore;
  $teamspiel_a->STPunkte = $heimpunkte;
  $teamspiel_a->STGegnerTeamwert = $gastteam->TeamWert;
  $teamspiel_a->STGegnerSpielwert = $gastteam_tageswert;
  $teamspiel_a->save();
  //
  $teamspiel_b = new SpielTeam;
  $teamspiel_b->STzugSpielNr = $spielnr;
  $teamspiel_b->STzugSaisonNr = $saisonnr;
  $teamspiel_b->STzugTeamNr = $gastteamnr;
  $teamspiel_b->STTypNr = $typnr;
  $teamspiel_b->STW02 = $gastteam->T02;
  $teamspiel_b->STW03 = $gastteam->T03;
  $teamspiel_b->STW04 = $gastteam->T04;
  $teamspiel_b->STW05 = $gastteam->T05;
  $teamspiel_b->STW06 = $gastteam->T06;
  $teamspiel_b->STW07 = $gastteam->T07;
  $teamspiel_b->STW08 = $gastteam->T08;
  $teamspiel_b->STW09 = $gastteam->T09;
  $teamspiel_b->STW10 = $gastteam->T10;
  $teamspiel_b->STW11 = $gastteam->T11;
  $teamspiel_b->STTaktikNr = $gast_taktiknr;
  $teamspiel_b->STTeamwert = $gastteam->TeamWert;
  $teamspiel_b->STSpielwert = $gastteam_tageswert;
  $teamspiel_b->STTore = $gast_tore;
  $teamspiel_b->STGegenTore = $heim_tore;
  $teamspiel_b->STPunkte = $gastpunkte;
  $teamspiel_b->STGegnerTeamwert = $heimteam->TeamWert;
  $teamspiel_b->STGegnerSpielwert = $heimteam_tageswert;
  $teamspiel_b->save();
  // ========================
  // F A L L - W M  S P I E L
  // ========================
  if ($spieltypnr > 200)
  {
    $wmdaten = ermittle_Pokalrunde_Hin_Rueck($spieltypnr);
    $wmrunde = $wmdaten['pokalrunde'];
    $hinspielkz = $wmdaten['hinspielkz'];
    //
    if ($hinspielkz) {
      //
      $wtabelle = WMTabelle::where('WMzugSaisonNr', '=', $saisonnr)
        ->where('WMRunde', '=', $wmrunde)
        ->where('WMTeamANr', '=', $heimteamnr)
        ->where('WMTeamBNr', '=', $gastteamnr)
        ->first();
      //
      $wtabelle->WMHSpNr = $spielnr;
      $wtabelle->WMTAHTor = $heim_tore;
      $wtabelle->WMTBHTor = $gast_tore;
      $wtabelle->save();
    } else {
      //
      $wtabelle = WMTabelle::where('WMzugSaisonNr', '=', $saisonnr)
        ->where('WMRunde', '=', $wmrunde)
        ->where('WMTeamANr', '=', $gastteamnr)
        ->where('WMTeamBNr', '=', $heimteamnr)
        ->first();
      //
      $wtabelle->WMRSpNr = $spielnr;
      $wtabelle->WMTARTor = $gast_tore;
      $wtabelle->WMTBRTor = $heim_tore;
      // ermittel den Sieger des WM-Spiels
      $h_zufall = random_int(1,100);
      $g_zufall = random_int(1,100);
      //
      $TeamAToreH = $wtabelle->WMTAHTor;
      $TeamAToreR = $gast_tore;
      $TeamBToreH = $wtabelle->WMTBHTor;
      $TeamBToreR = $heim_tore;
      //
      $Diff_H = $TeamAToreH - $TeamBToreH;
      $Diff_R = $TeamAToreR - $TeamBToreR;
      //
      $Diff_Ges = $Diff_H + $Diff_R;
      //
      if ($Diff_Ges > 0) {
        $wtabelle->WMTeamSiegerNr = $gastteamnr;
        // ergänze den Spielbericht
        $single_spiel->SpielBericht .= 'Gewinner ist die Mannschaft ' . $gastteam_name . '<br />';
      }
      if ($Diff_Ges < 0) {
        $wtabelle->wMTeamSiegerNr = $heimteamnr;
        // ergänze den Spielbericht
        $single_spiel->SpielBericht .= 'Gewinner ist die Mannschaft ' . $heimteam_name . '<br />';
      }
      if ($Diff_Ges == 0) {
        if ($TeamAToreR < $TeamBToreH) {
          $wtabelle->wMTeamSiegerNr = $heimteamnr;
          // ergänze den Spielbericht
          $single_spiel->SpielBericht .= 'Gewinner ist die Mannschaft ' . $heimteam_name . '<br />';
        }
        if ($TeamAToreR == $TeamBToreH) {
          if ($h_zufall >= $g_zufall) {
            $wtabelle->WMTeamSiegerNr = $gastteamnr;
            // ergänze den Spielbericht
            $single_spiel->SpielBericht .= 'Elfmeterschießen. Gewinner ist die Mannschaft ' . $gastteam_name . '<br />';
          } else {
            $wtabelle->WMTeamSiegerNr = $heimteamnr;
            // ergänze den Spielbericht
            $single_spiel->SpielBericht .= 'Elfmeterschießen. Gewinner ist die Mannschaft ' . $heimteam_name . '<br />';
          }
        }
        if ($TeamAToreR > $TeamBToreH) {
          $wtabelle->WMTeamSiegerNr = $gastteamnr;
          // ergänze den Spielbericht
          $single_spiel->SpielBericht .= 'Gewinner ist die Mannschaft ' . $gastteam_name . '<br />';
        }
      }
      //
      $single_spiel->save();
      //
      $wtabelle->save();
    }
  }
  // ================================
  // F A L L - P O K A L S P I E L
  // ================================
  if ($spieltypnr > 100 && $spieltypnr < 200)
  {
    $pokaldaten = ermittle_Pokalrunde_Hin_Rueck($spieltypnr);
    $pokalrunde = $pokaldaten['pokalrunde'];
    $hinspielkz = $pokaldaten['hinspielkz'];
    //
    if ($hinspielkz) {
      //
      $ptabelle = PokalTabelle::where('PTzugSaisonNr', '=', $saisonnr)
        ->where('PTRunde', '=', $pokalrunde)
        ->where('PTTeamANr', '=', $heimteamnr)
        ->where('PTTeamBNr', '=', $gastteamnr)
        ->first();
      //
      $ptabelle->PTHSpNr = $spielnr;
      $ptabelle->PTTAHTor = $heim_tore;
      $ptabelle->PTTBHTor = $gast_tore;
      $ptabelle->save();
    } else {
      //
      $ptabelle = PokalTabelle::where('PTzugSaisonNr', '=', $saisonnr)
        ->where('PTRunde', '=', $pokalrunde)
        ->where('PTTeamANr', '=', $gastteamnr)
        ->where('PTTeamBNr', '=', $heimteamnr)
        ->first();
      //
      $ptabelle->PTRSpNr = $spielnr;
      $ptabelle->PTTARTor = $gast_tore;
      $ptabelle->PTTBRTor = $heim_tore;
      // ermittel den Sieger des Pokalspiels
      $h_zufall = random_int(1,100);
      $g_zufall = random_int(1,100);
      //
      $TeamAToreH = $ptabelle->PTTAHTor;
      $TeamAToreR = $gast_tore;
      $TeamBToreH = $ptabelle->PTTBHTor;
      $TeamBToreR = $heim_tore;
      //
      $Diff_H = $TeamAToreH - $TeamBToreH;
      $Diff_R = $TeamAToreR - $TeamBToreR;
      //
      $Diff_Ges = $Diff_H + $Diff_R;
      //
      if ($Diff_Ges > 0) {
        $ptabelle->PTTeamSiegerNr = $gastteamnr;
        // ergänze den Spielbericht
        $single_spiel->SpielBericht .= 'Gewinner ist die Mannschaft ' . $gastteam_name . '<br />';
      }
      if ($Diff_Ges < 0) {
        $ptabelle->PTTeamSiegerNr = $heimteamnr;
        // ergänze den Spielbericht
        $single_spiel->SpielBericht .= 'Gewinner ist die Mannschaft ' . $heimteam_name . '<br />';
      }
      if ($Diff_Ges == 0) {
        if ($TeamAToreR < $TeamBToreH) {
          $ptabelle->PTTeamSiegerNr = $heimteamnr;
          // ergänze den Spielbericht
          $single_spiel->SpielBericht .= 'Gewinner ist die Mannschaft ' . $heimteam_name . '<br />';
        }
        if ($TeamAToreR == $TeamBToreH) {
          if ($h_zufall >= $g_zufall) {
            $ptabelle->PTTeamSiegerNr = $gastteamnr;
            // ergänze den Spielbericht
            $single_spiel->SpielBericht .= 'Elfmeterschießen. Gewinner ist die Mannschaft ' . $gastteam_name . '<br />';
          } else {
            $ptabelle->PTTeamSiegerNr = $heimteamnr;
            // ergänze den Spielbericht
            $single_spiel->SpielBericht .= 'Elfmeterschießen. Gewinner ist die Mannschaft ' . $heimteam_name . '<br />';
          }
        }
        if ($TeamAToreR > $TeamBToreH) {
          $ptabelle->PTTeamSiegerNr = $gastteamnr;
          // ergänze den Spielbericht
          $single_spiel->SpielBericht .= 'Gewinner ist die Mannschaft ' . $gastteam_name . '<br />';
        }
      }
      //
      $single_spiel->save();
      //
      $ptabelle->save();
    }
  }
  // ================================
  // F A L L - L I G A S P I E L
  // ================================
  if ($spieltypnr < 31)
  {
    // ===================================================================
    // lege jetzt für die Heimmannschaft neuen Datensatz in LigaTabelle an
    // ===================================================================
    $alt_S = 0;
    $alt_U = 0;
    $alt_N = 0;
    $alt_Plus_Pkt = 0;
    $alt_Plus_T = 0;
    $alt_Minus_T = 0;
    $alt_Diff = 0;
    //
    if ($spieltypnr > 1)
    {
      $alt_ligaspiel_h = LigaTabelle::where('LTzugSaisonNr', '=', $saisonnr)
        ->where('LTSpieltag', '=', $spieltypnr - 1)
        ->where('LTzugTeamNr', '=', $heimteamnr)
        ->firstOrFail();
      $alt_S = $alt_ligaspiel_h->LTAnzahlSiege;
      $alt_U = $alt_ligaspiel_h->LTAnzahlUnentschieden;
      $alt_N = $alt_ligaspiel_h->LTAnzahlNiederlagen;
      $alt_Plus_Pkt = $alt_ligaspiel_h->LTPlusPunkte;
      $alt_Plus_T = $alt_ligaspiel_h->LTPlusTore;
      $alt_Minus_T = $alt_ligaspiel_h->LTMinusTore;
      $alt_Diff = $alt_ligaspiel_h->LTTorDifferenz;
    }
    $neu_S = 0;
    $neu_U = 0;
    $neu_N = 0;
    $neu_Plus_Pkt = 0;
    $neu_Plus_T = 0;
    $neu_Minus_T = 0;
    $neu_Diff = 0;
    //
    $neu_Plus_T = $heim_tore;
    $neu_Minus_T = $gast_tore;
    $neu_Diff = $heim_tore - $gast_tore;
    //
    if ($heim_tore > $gast_tore) {
      $neu_S = 1;
      $neu_Plus_Pkt = 3;
    }
    if ($heim_tore == $gast_tore) {
      $neu_U = 1;
      $neu_Plus_Pkt = 1;
    }
    if ($heim_tore < $gast_tore) {
      $neu_N = 1;
    }
    //
    $single_ligaspiel_h = new LigaTabelle;
    $single_ligaspiel_h->LTzugLandNr = $landnr;
    $single_ligaspiel_h->LTzugSaisonNr = $saisonnr;
    $single_ligaspiel_h->LTSpieltag = $spieltypnr;
    $single_ligaspiel_h->LTPlatz = 0;
    $single_ligaspiel_h->LTzugTeamNr = $heimteamnr;
    $single_ligaspiel_h->LTAnzahlSiege = $alt_S + $neu_S;
    $single_ligaspiel_h->LTAnzahlUnentschieden = $alt_U + $neu_U;
    $single_ligaspiel_h->LTAnzahlNiederlagen = $alt_N + $neu_N;
    $single_ligaspiel_h->LTPlusPunkte = $alt_Plus_Pkt + $neu_Plus_Pkt;
    $single_ligaspiel_h->LTPlusTore = $alt_Plus_T + $neu_Plus_T;
    $single_ligaspiel_h->LTMinusTore = $alt_Minus_T + $neu_Minus_T;
    $single_ligaspiel_h->LTTorDifferenz = $alt_Diff + $neu_Diff;
    $single_ligaspiel_h->save();
    // ===================================================================
    // lege jetzt für die Gastmannschaft neuen Datensatz in LigaTabelle an
    // ===================================================================
    $alt_S = 0;
    $alt_U = 0;
    $alt_N = 0;
    $alt_Plus_Pkt = 0;
    $alt_Plus_T = 0;
    $alt_Minus_T = 0;
    $alt_Diff = 0;
    //
    if ($spieltypnr > 1) {
      $alt_ligaspiel_g = LigaTabelle::where('LTzugSaisonNr', '=', $saisonnr)
        ->where('LTSpieltag', '=', $spieltypnr - 1)
        ->where('LTzugTeamNr', '=', $gastteamnr)
        ->firstOrFail();
      $alt_S = $alt_ligaspiel_g->LTAnzahlSiege;
      $alt_U = $alt_ligaspiel_g->LTAnzahlUnentschieden;
      $alt_N = $alt_ligaspiel_g->LTAnzahlNiederlagen;
      $alt_Plus_Pkt = $alt_ligaspiel_g->LTPlusPunkte;
      $alt_Plus_T = $alt_ligaspiel_g->LTPlusTore;
      $alt_Minus_T = $alt_ligaspiel_g->LTMinusTore;
      $alt_Diff = $alt_ligaspiel_g->LTTorDifferenz;
    }
    $neu_S = 0;
    $neu_U = 0;
    $neu_N = 0;
    $neu_Plus_Pkt = 0;
    $neu_Plus_Pkt = 0;
    $neu_Plus_T = 0;
    $neu_Minus_T = 0;
    $neu_Diff = 0;
    //
    $neu_Plus_T = $gast_tore;
    $neu_Minus_T = $heim_tore;
    $neu_Diff = $gast_tore - $heim_tore;
    //
    if ($gast_tore > $heim_tore) {
      $neu_S = 1;
      $neu_Plus_Pkt = 3;
    }
    if ($gast_tore == $heim_tore) {
      $neu_U = 1;
      $neu_Plus_Pkt = 1;
    }
    if ($gast_tore < $heim_tore) {
      $neu_N = 1;
    }
    //
    $single_ligaspiel_g = new LigaTabelle;
    $single_ligaspiel_g->LTzugLandNr = $landnr;
    $single_ligaspiel_g->LTzugSaisonNr = $saisonnr;
    $single_ligaspiel_g->LTSpieltag = $spieltypnr;
    $single_ligaspiel_g->LTPlatz = 0;
    $single_ligaspiel_g->LTzugTeamNr = $gastteamnr;
    $single_ligaspiel_g->LTAnzahlSiege = $alt_S + $neu_S;
    $single_ligaspiel_g->LTAnzahlUnentschieden = $alt_U + $neu_U;
    $single_ligaspiel_g->LTAnzahlNiederlagen = $alt_N + $neu_N;
    $single_ligaspiel_g->LTPlusPunkte = $alt_Plus_Pkt + $neu_Plus_Pkt;
    $single_ligaspiel_g->LTPlusTore = $alt_Plus_T + $neu_Plus_T;
    $single_ligaspiel_g->LTMinusTore = $alt_Minus_T + $neu_Minus_T;
    $single_ligaspiel_g->LTTorDifferenz = $alt_Diff + $neu_Diff;
    $single_ligaspiel_g->save();
  }
  // ermittle das Attribut LigaTabelle.LTPlatz für den aktuellen Spieltag
  $tabellenplatz = '';
  //
  if ($spieltypnr < 31) {
    $tabellenplatz = LigaTabelle::where('LTzugSaisonNr', '=', $saisonnr)
      ->where('LTzugLandNr', '=', $landnr)
      ->where('LTSpieltag', '=', $spieltypnr)
      ->orderBy('LTPlusPunkte', 'desc')
      ->orderBy('LTTorDifferenz', 'desc')
      ->orderBy('LTAnzahlSiege', 'desc')
      ->orderBy('LTPlusTore', 'desc')
      ->orderBy('LTzugTeamNr', 'desc')
      ->get();
    //
    $platz = 1;
    foreach ($tabellenplatz as $tabteam) {
      $tabteam->LTPlatz = $platz;
      $tabteam->save();
      $platz += 1;
    }
  }
  //
  return ([
    'fehlerkz' => false,
    'fehlermeldung' => '',
    'spielergebnis' => $spielergebnis,
    'spielbericht' => $spielbericht,
  ]);
}
// ermittle Pokalauslosung
function ermittle_Pokalauslosung($saisonnr, $rundennr, $pokaltyp)
{
  // $pokaltyp = 1 --> Pokal
  // $pokaltyp = 2 --> WM
  // Rückgabewerte
  $fehlerkz = false;
  $fehlermeldung = '';
  // ermittle Anzahl der teilnehmenden Pokalpartien
  $anzahl = 0;
  if ($pokaltyp === 1) {
    switch ($rundennr) {
      case 1:
        $anzahl = 128;
        break;
      case 2:
        $anzahl = 64;
        break;
      case 3:
        $anzahl = 32;
        break;
      case 4:
        $anzahl = 16;
        break;
      case 5:
        $anzahl = 8;
        break;
      case 6:
        $anzahl = 4;
        break;
      case 7:
        $anzahl = 2;
        break;
      case 8:
        $anzahl = 1;
        break;
      default:
        $anzahl = 0;
    }
  }
  if ($pokaltyp === 2) {
    switch ($rundennr) {
      case 1:
        $anzahl = 8;
        break;
      case 2:
        $anzahl = 4;
        break;
      case 3:
        $anzahl = 2;
        break;
      case 4:
        $anzahl = 1;
        break;
      default:
        $anzahl = 0;
    }
  }
  //
  if ($anzahl === 0) {
    $fehlerkz = true;
    $fehlermeldung = 'Die Anzahl der teilnehmenden Pokalpartien für diesen Wettbewerb konnte nicht ermittelt werden.';
    return ([
      'fehlerkz' => $fehlerkz,
      'fehlermeldung' => $fehlermeldung
    ]);
  }
  // Fall Pokal >= 2. Runde
  if ($rundennr > 1 && $pokaltyp == 1)
  {
    // Aktualisiere die Auslosungswerte
    aktualisiere_Auslosung();
    //
    $letzteRunde = PokalTabelle::where('PTzugSaisonNr', '=', $saisonnr)
      ->where('PTRunde', '=', $rundennr-1)
      ->orderBy('PTNr')
      ->get();
    //
    $auslosung = AuslosungTabelle::select('ATNr')
      ->where('ATNr', '<=', $anzahl*2)
      ->orderBy('ATZufallszahl')
      ->orderBy('ATNr')
      ->get();
    //
    for($i = 1; $i<=$anzahl; $i++)
    {
      $losanr = $auslosung[(2*$i)-2]['ATNr']-1;
      $teamanr = $letzteRunde[$losanr]['PTTeamSiegerNr'];
      $losbnr = $auslosung[(2*$i)-1]['ATNr']-1;
      $teambnr = $letzteRunde[$losbnr]['PTTeamSiegerNr'];
      //
      $pokalspiel = new PokalTabelle;
      $pokalspiel->PTzugSaisonNr = $saisonnr;
      $pokalspiel->PTRunde = $rundennr;
      $pokalspiel->PTTeamANr = $teamanr;
      $pokalspiel->PTTeamBNr = $teambnr;
      $pokalspiel->PTHSpNr = 0;
      $pokalspiel->PTRSpNr = 0;
      $pokalspiel->PTTAHTor = 0;
      $pokalspiel->PTTARTor = 0;
      $pokalspiel->PTTBHTor = 0;
      $pokalspiel->PTTBRTor = 0;
      $pokalspiel->PTTeamSiegerNr = 0;
      $pokalspiel->save();
    }
  }
  // Fall Pokal 1. Runde
  if ($rundennr == 1 && $pokaltyp == 1)
  {
    $auslosung = AuslosungTabelle::where('ATNr', '<=', $anzahl*2)
      ->orderBy('ATZufallszahl')
      ->orderBy('ATNr')
      ->get();
    //
    for($i = 1; $i<=$anzahl; $i++)
    {
      $teamanr = $auslosung[(2*$i)-2]['ATNr'];
      $teambnr = $auslosung[(2*$i)-1]['ATNr'];
      //
      $pokalspiel = new PokalTabelle;
      $pokalspiel->PTzugSaisonNr = $saisonnr;
      $pokalspiel->PTRunde = $rundennr;
      $pokalspiel->PTTeamANr = $teamanr;
      $pokalspiel->PTTeamBNr = $teambnr;
      $pokalspiel->PTHSpNr = 0;
      $pokalspiel->PTRSpNr = 0;
      $pokalspiel->PTTAHTor = 0;
      $pokalspiel->PTTARTor = 0;
      $pokalspiel->PTTBHTor = 0;
      $pokalspiel->PTTBRTor = 0;
      $pokalspiel->PTTeamSiegerNr = 0;
      $pokalspiel->save();
    }
  }
  // Fall WM >= 2. Runde
  if ($rundennr > 1 && $pokaltyp == 2)
  {
    // Aktualisiere die Auslosungswerte
    aktualisiere_Auslosung();
    //
    $letzteRunde = WMTabelle::where('WMzugSaisonNr', '=', $saisonnr)
      ->where('WMRunde', '=', $rundennr-1)
      ->orderBy('WMNr')
      ->get();
    //
    $auslosung = AuslosungTabelle::select('ATNr')
      ->where('ATNr', '<=', $anzahl*2)
      ->orderBy('ATZufallszahl')
      ->orderBy('ATNr')
      ->get();
    //
    for($i = 1; $i<=$anzahl; $i++)
    {
      $losanr = $auslosung[(2*$i)-2]['ATNr']-1;
      $teamanr = $letzteRunde[$losanr]['WMTeamSiegerNr'];
      $losbnr = $auslosung[(2*$i)-1]['ATNr']-1;
      $teambnr = $letzteRunde[$losbnr]['WMTeamSiegerNr'];
      //
      $wmspiel = new WMTabelle;
      $wmspiel->WMzugSaisonNr = $saisonnr;
      $wmspiel->WMRunde = $rundennr;
      $wmspiel->WMTeamANr = $teamanr;
      $wmspiel->WMTeamBNr = $teambnr;
      $wmspiel->WMHSpNr = 0;
      $wmspiel->WMRSpNr = 0;
      $wmspiel->WMTAHTor = 0;
      $wmspiel->WMTARTor = 0;
      $wmspiel->WMTBHTor = 0;
      $wmspiel->WMTBRTor = 0;
      $wmspiel->WMTeamSiegerNr = 0;
      $wmspiel->save();
    }
  }
  // Fall WM 1. Runde
  if ($rundennr == 1 && $pokaltyp == 2)
  {
    $auslosung = AuslosungTabelle::where('ATNr', '<=', $anzahl*2)
      ->orderBy('ATZufallszahl')
      ->orderBy('ATNr')
      ->get();
    //
    for($i = 1; $i<=$anzahl; $i++)
    {
      $titelteama = TeamTitel::where('TTzugSaisonNr', '=', $saisonnr)
        ->where('TTzugLandNr', '=', $auslosung[(2*$i)-2]['ATNr'])
        ->where('TTTitelTypNr', '=', 1)
        ->first();
      $teamanr = $titelteama->TTzugTeamNr;
      $titelteamb = TeamTitel::where('TTzugSaisonNr', '=', $saisonnr)
        ->where('TTzugLandNr', '=', $auslosung[(2*$i)-1]['ATNr'])
        ->where('TTTitelTypNr', '=', 1)
        ->first();
      $teambnr = $titelteamb->TTzugTeamNr;
      //
      $wmspiel = new WMTabelle;
      $wmspiel->WMzugSaisonNr = $saisonnr;
      $wmspiel->WMRunde = $rundennr;
      $wmspiel->WMTeamANr = $teamanr;
      $wmspiel->WMTeamBNr = $teambnr;
      $wmspiel->WMHSpNr = 0;
      $wmspiel->WMRSpNr = 0;
      $wmspiel->WMTAHTor = 0;
      $wmspiel->WMTARTor = 0;
      $wmspiel->WMTBHTor = 0;
      $wmspiel->WMTBRTor = 0;
      $wmspiel->WMTeamSiegerNr = 0;
      $wmspiel->save();
    }
  }
}
// aktualisiere_Spielplan
function aktualisiere_Spielplan()
{
  // durchlaufe alle Länder/Ligen
  for($landnr = 1; $landnr<=16; $landnr++)
  {
    $auslosung = AuslosungTabelle::where('ATNr', '<=', 16)
      ->orderBy('ATZufallszahl')
      ->orderBy('ATNr')
      ->get();
    //
    $i = 1;
    //
    foreach ($auslosung as $single_auslosung) {
      $spielplannr = $single_auslosung->ATNr;
      $teamnr = (($landnr - 1) * 16) + $i;
      $team = Team::where('TeamNr', '=', $teamnr)->first();
      $team->TeamSpielplanNr = $spielplannr;
      $team->save();
      $i += 1;
    }
  }
}
// aktualisiere_Auslosung
function aktualisiere_Auslosung()
{
  $auslosung = AuslosungTabelle::get();
  //
  foreach ($auslosung as $single_auslosung) {
    $wert = random_int(1,10000);
    $single_auslosung->ATZufallszahl = $wert;
    $single_auslosung->save();
  }
}
// ermittle_Spielwert
function ermittle_Spielwert($teamnr, $taktiknr)
{
  // ermittle $multiplikator
  $multiplikator = ermittle_Multiplikator($taktiknr);
  // initialisiere den fitnesswert
  $fitnesswert = 0;
  // initialisiere den spielwert_multiplikator
  $spielwert_multiplikator = 0;
  // ermittle Datensatz des Teams
  $single_team = Team::findOrFail($teamnr);
  // tw02, fw02
  $fw02 = ermittle_FitnessKosten($taktiknr);
  $tw02 = $single_team->T02;
  $twn02 = ermittle_NeuerFitnesswert($tw02, $fw02);
  if ($tw02 > 60)
  {
    $fitnesswert += 100;
  }
  $single_team->T02 = $twn02;
  // tw03, fw03
  $fw03 = ermittle_FitnessKosten($taktiknr);
  $tw03 = $single_team->T03;
  $twn03 = ermittle_NeuerFitnesswert($tw03, $fw03);
  if ($tw03 > 60)
  {
    $fitnesswert += 100;
  }
  $single_team->T03 = $twn03;
  // tw04, fw04
  $fw04 = ermittle_FitnessKosten($taktiknr);
  $tw04 = $single_team->T04;
  $twn04 = ermittle_NeuerFitnesswert($tw04, $fw04);
  if ($tw04 > 60)
  {
    $fitnesswert += 100;
  }
  $single_team->T04 = $twn04;
  // tw05, fw05
  $fw05 = ermittle_FitnessKosten($taktiknr);
  $tw05 = $single_team->T05;
  $twn05 = ermittle_NeuerFitnesswert($tw05, $fw05);
  if ($tw05 > 60)
  {
    $fitnesswert += 100;
  }
  $single_team->T05 = $twn05;
  // tw06, fw06
  $fw06 = ermittle_FitnessKosten($taktiknr);
  $tw06 = $single_team->T06;
  $twn06 = ermittle_NeuerFitnesswert($tw06, $fw06);
  if ($tw06 > 60)
  {
    $fitnesswert += 100;
  }
  $single_team->T06 = $twn06;
  // tw07, fw07
  $fw07 = ermittle_FitnessKosten($taktiknr);
  $tw07 = $single_team->T07;
  $twn07 = ermittle_NeuerFitnesswert($tw07, $fw07);
  if ($tw07 > 60)
  {
    $fitnesswert += 100;
  }
  $single_team->T07 = $twn07;
  // tw08, fw08
  $fw08 = ermittle_FitnessKosten($taktiknr);
  $tw08 = $single_team->T08;
  $twn08 = ermittle_NeuerFitnesswert($tw08, $fw08);
  if ($tw08 > 60)
  {
    $fitnesswert += 100;
  }
  $single_team->T08 = $twn08;
  // tw09, fw09
  $fw09 = ermittle_FitnessKosten($taktiknr);
  $tw09 = $single_team->T09;
  $twn09 = ermittle_NeuerFitnesswert($tw09, $fw09);
  if ($tw09 > 60)
  {
    $fitnesswert += 100;
  }
  $single_team->T09 = $twn09;
  // tw10, fw10
  $fw10 = ermittle_FitnessKosten($taktiknr);
  $tw10 = $single_team->T10;
  $twn10 = ermittle_NeuerFitnesswert($tw10, $fw10);
  if ($tw10 > 60)
  {
    $fitnesswert += 100;
  }
  $single_team->T10 = $twn10;
  // tw11, fw11
  $fw11 = ermittle_FitnessKosten($taktiknr);
  $tw11 = $single_team->T11;
  $twn11 = ermittle_NeuerFitnesswert($tw11, $fw11);
  if ($tw11 > 60)
  {
    $fitnesswert += 100;
  }
  $single_team->T11 = $twn11;
  //
  $single_team->save();
  //
  $spielwert_multiplikator = $fitnesswert * $multiplikator;
  //
  $spielwert = intval(($spielwert_multiplikator / 1000) * $single_team->TeamWert);
  //
  if ($spielwert < 400) {
    $spielwert = 400;
  }
  //
  return $spielwert;
}
// ermittle_NeuerFitnesswert
function ermittle_NeuerFitnesswert($tw, $fw)
{
  $twn = $tw - $fw;
  //
  if ($twn < 0) {
    $twn = 0;
  }
  return $twn;
}
// Dokumentiere Verletzung
function insert_Verletzung($liganr, $saisonnr, $spieltypnr, $spielnr, $teamnr, $reduktionswert, $minute)
{
  // Ermittle $single_v
  $single_v = new SpielVerletzung;
  $single_v->SVzugSaisonNr = $saisonnr;
  $single_v->SVzugLandNr = $liganr;
  $single_v->SVzugSpieltypNr = $spieltypnr;
  $single_v->SVzugSpielNr = $spielnr;
  $single_v->SVzugTeamNr = $teamnr;
  $single_v->SVTeamreduktionswert = $reduktionswert;
  $single_v->SVMinute = $minute;
  //
  $single_v->save();
}
// Dokumentiere das gefallene Tor
function insert_Tor($liganr, $saisonnr, $spieltypnr, $spielnr, $teamnr, $trikotnr, $minute, $tortyp)
{
  $torschuetze_nr = null;
  $torschuetze_playernr = null;
  $torschuetze_playername = null;
  
  // Ermittle zunächst die Player-Nr mit Hilfe der $teamnr und der $trikotnr
  $single_player = Player::where('PzugTeamNr', '=', $teamnr)
    ->where('PlayerTrikotNr', '=', $trikotnr)
    ->first();
  if (!$single_player) {
    return ([
      'spieltornr' => 0,
      'playernr' => 0,
      'playername' => 'unbekannt'
    ]);
  }

  $single_player->PlayerNr;

  // Ermittle $single_tor
  $single_tor = new SpielTore;
  $single_tor->SpielTorezugSaisonNr = $saisonnr;
  $single_tor->SpielTorezugLandNr = $liganr;
  $single_tor->SpielTorezugSpieltypNr = $spieltypnr;
  $single_tor->SpielTorezugSpielNr = $spielnr;
  $single_tor->SpielTorezugTeamNr = $teamnr;
  $single_tor->SpielTorezugPlayerNr = $single_player->PlayerNr;
  $single_tor->SpielToreMinute = $minute;
  $single_tor->SpielToreTyp = $tortyp;
  //
  $single_tor->save();
  // ermittle die Rückgabewerte
  $torschuetze_nr = $single_tor->SpielTorNr;
  $torschuetze_playernr = $single_player->PlayerNr;
  $torschuetze_playername = $single_player->PlayerName;
  //
  return ([
    'spieltornr'  => $torschuetze_nr,
    'playernr'    => $torschuetze_playernr,
    'playername'  => $torschuetze_playername
  ]);
}
// Dokumentiere Spielereignis
function insert_Spielereignis($spielnr, $HeimTeamNr, $GastTeamNr, $HeimChannelKZ,
  $GastChannelKZ, $EreignisTypNr,
  $Beschreibung, $Minute)
{
  if ($HeimChannelKZ) {
    // Ermittle $single_e_h
    $single_e_h = new SpielEreignis;
    $single_e_h->SEzugSpielNr = $spielnr;
    $single_e_h->SEzugTeamNr = $HeimTeamNr;
    $single_e_h->SEzugEreignisTypNr = $EreignisTypNr;
    $single_e_h->SEMinute = $Minute;
    $single_e_h->SEBeschreibung = $Beschreibung;
    //
    $single_e_h->save();
  }
  if ($GastChannelKZ) {
    // Ermittle $single_e_g
    $single_e_g = new SpielEreignis;
    $single_e_g->SEzugSpielNr = $spielnr;
    $single_e_g->SEzugTeamNr = $GastTeamNr;
    $single_e_g->SEzugEreignisTypNr = $EreignisTypNr;
    $single_e_g->SEMinute = $Minute;
    $single_e_g->SEBeschreibung = $Beschreibung;
    //
    $single_e_g->save();
  }
}
// Ermittle Torschützen
function ermittle_Torschuetzen()
{
  $nr = 9;
  $wert = random_int(1,100);
  if ($wert < 6) {
    $nr = 2;
  }
  if ($wert >= 6 && $wert < 10) {
    $nr = 3;
  }
  if ($wert >= 10 && $wert < 15) {
    $nr = 4;
  }
  if ($wert >= 15 && $wert < 20) {
    $nr = 5;
  }
  if ($wert >= 20 && $wert < 25) {
    $nr = 6;
  }
  if ($wert >= 25 && $wert < 40) {
    $nr = 7;
  }
  if ($wert >= 40 && $wert < 50) {
    $nr = 8;
  }
  if ($wert >= 50 && $wert < 70) {
    $nr = 9;
  }
  if ($wert >= 70 && $wert < 85) {
    $nr = 10;
  }
  if ($wert >= 85 && $wert <= 100) {
    $nr = 11;
  }
  //
  return $nr;
}
// Ermittle FitnessKosten
function ermittle_FitnessKosten($taktiknr)
{
  $fk = -6;
  $wert = random_int(1,100);
  if ($wert <= 25) {
    $fk = -6;
  }
  if ($wert > 26 && $wert <= 50) {
    $fk = -5;
  }
  if ($wert > 50 && $wert <= 90) {
    $fk = -4;
  }
  if ($wert > 90 && $wert <= 97) {
    $fk = -3;
  }
  if ($wert > 97) {
    $fk = -2;
  }
  //
  switch ($taktiknr) {
    case 1:
      $fk += 0;
      break;
    case 2:
      $fk += 2;
      break;
    case 3:
      $fk += 4;
      break;
    case 4:
      $fk += 6;
      break;
    case 5:
      $fk += 8;
      break;
    default:
      $fk = -6;
  }
  //
  return $fk;
}
// Ermittle Multiplikator
function ermittle_Multiplikator($taktiknr)
{
  $m = 0;
  switch ($taktiknr) {
    case 1:
      $m = 0.6;
      break;
    case 2:
      $m = 0.8;
      break;
    case 3:
      $m = 0.9;
      break;
    case 4:
      $m = 1.1;
      break;
    case 5:
      $m = 1.4;
      break;
    default:
      $m = 0;
  }
  //
  return $m;
}
// Ermittle Spiel mit Hilfe der LandNr, SaisonNr, SpieltypNr, HeimTeamNr und GastTeamNr
function ermittle_Spiel($landnr, $saisonnr, $spieltypnr, $heimteamnr, $gastteamnr)
{
  $single_spiel = [];
  // Variante 1
  $single_spiel_1 = Spiel::where('SpielzugLandNr', '=', $landnr)
    ->where('SpielzugSaisonNr', '=', $saisonnr)
    ->where('SpielTypNr', '=', $spieltypnr)
    ->where('SpielHeimTeamNr', '=', $heimteamnr)
    ->where('SpielGastTeamNr', '=', $gastteamnr)
    ->first();
  //
  if (!$single_spiel_1)
  {
    // Variante 2
    $single_spiel_2 = Spiel::where('SpielzugLandNr', '=', $landnr)
      ->where('SpielzugSaisonNr', '=', $saisonnr)
      ->where('SpielTypNr', '=', $spieltypnr)
      ->where('SpielHeimTeamNr', '=', $gastteamnr)
      ->where('SpielGastTeamNr', '=', $heimteamnr)
      ->first();
    //
    $single_spiel = $single_spiel_2;
  } else
  {
    $single_spiel = $single_spiel_1;
  }
  //
  return $single_spiel;
}
// Ermittle Spieergebnisse
function ermittle_Ergebnisse($liste_spielplan, $tore)
{
  $ergebnisse = '';
  //
  for ($i = 0; $i <= 7; $i++)
  {
    $ergebnisse .= '<div class="flex p-2 my-1">';

    $ergebnisse .= '<div class="w-5/12 text-center">';
    $ergebnisse .= $liste_spielplan[$i]->HeimTeamName;
    $ergebnisse .= '</div>';

    $ergebnisse .= '<div class="w-2/12 text-center">';
    $ergebnisse .= $tore[2*$i];
    $ergebnisse .= ' : ';
    $ergebnisse .= $tore[(2*$i)+1];
    $ergebnisse .= '</div>';

    $ergebnisse .= '<div class="w-5/12 text-center">';
    $ergebnisse .= $liste_spielplan[$i]->GastTeamName;
    $ergebnisse .= '</div>';

    $ergebnisse .= '</div>';
  }

  //
  return $ergebnisse;
}
// Ermittle spielteam.SpielTeamNr mit Hilfe der TeamNr, SaisonNr und SpieltypNr
function ermittle_Spielteam_Nr($teamnr, $saisonnr, $spieltypnr)
{
  $spielteamnr = 0;
  //
  $single_spielteam = SpielTeam
    ::where('STzugTeamNr', '=', $teamnr)
    ->join('spiel', 'spiel.SpielNr', '=', 'spielteam.STzugSpielNr')
    ->where('STzugSaisonNr', '=', $saisonnr)
    ->where('SpielTypNr', '=', $spieltypnr)
    ->first();
  //
  if ($single_spielteam) {
    $spielteamnr = $single_spielteam->STzugSpielNr;
  }
  //
  return $spielteamnr;
}
// Ermittle Teamnamen mit Hilfe der LandNr und TeamspielplanNr
function ermittle_Teamnamen_Spielplan($landnr, $teamspielplannr)
{
  $teamname = 'unbekannt';
  //
  $single_team = Team::where('TzugLandNr', '=', $landnr)
    ->where('TeamSpielplanNr', '=', $teamspielplannr)
    ->first();
  //
  if ($single_team) {
    $teamname = $single_team->TeamName;
  }
  //
  return $teamname;
}
// Ermittle TeamNr mit Hilfe der LandNr und TeamspielplanNr
function ermittle_TeamNr_Spielplan($landnr, $teamspielplannr)
{
  $teamnr = 0;
  //
  $single_team = Team::where('TzugLandNr', '=', $landnr)
    ->where('TeamSpielplanNr', '=', $teamspielplannr)
    ->first();
  //
  if ($single_team) {
    $teamnr = $single_team->TeamNr;
  }
  //
  return $teamnr;
}
// Ermittle Liganamen mit Hilfe der ligaNr
function ermittle_Liganamen($liganr)
{
  $liganame = 'unbekannt';
  //
  $single_land = Land::where('LandNr', '=', $liganr)
    ->first();
  //
  if ($single_land) {
    $liganame = $single_land->LandName;
  }
  //
  return $liganame;
}
// Ermittle Saisonname mit Hilfe der SaisonNr
function ermittle_Saisonnamen($saisonnr)
{
  $saisonname = 'unbekannt';
  //
  $single_saison = Saison::where('SaisonNr', '=', $saisonnr)
    ->first();
  //
  if ($single_saison) {
    $saisonname = $single_saison->SaisonName;
  }
  //
  return $saisonname;
}
// Ermittle Teamnamen mit Hilfe der TeamNr
function ermittle_Teamnamen($teamnr)
{
  $teamname = 'unbekannt';
  //
  $single_team = Team::where('TeamNr', '=', $teamnr)
    ->first();
  //
  if ($single_team) {
    $teamname = $single_team->TeamName;
  }
  //
  return $teamname;
}
// Ermittle Land des Teams mit Hilfe der TeamNr
function ermittle_Teamnamen_Land($teamnr)
{
  $teamlandname = 'unbekannt';
  //
  $single_team = Team::where('TeamNr', '=', $teamnr)
    ->first();
  //
  if ($single_team) {
    $landnr = $single_team->TzugLandNr;
    $teamlandname = ermittle_Liganamen($landnr);
  }
  //
  return $teamlandname;
}
// Ermittle Land des Teams mit Hilfe der TeamNr
function ermittle_Teamnamen_LandNr($teamnr)
{
  $landnr = 0;
  //
  $single_team = Team::where('TeamNr', '=', $teamnr)
    ->first();
  //
  if ($single_team) {
    $landnr = $single_team->TzugLandNr;
  }
  //
  return $landnr;
}
// Ermittle das Datum
function ermittle_Datum($input, $format = 1)
{
  // $format = 1 => Datumanzeige TT.MM.JJJJ
  // $format = 2 => Datumanzeige TT.MM.JJJJ HH:MM
  // $format = 3 => Datumanzeige TT.MM.JJJJ HH:MM:ss
  // $format = 4 => in Worten zu Jetzt
  //
  Carbon::setLocale('de');
  //
  switch ($format) {
    case "1":
      return date('d.m.Y', strtotime($input));
      break;
    case "2":
      return date('d.m.Y H:i', strtotime($input));
      break;
    case "3":
      return date('d.m.Y H:i:s', strtotime($input));
      break;
    case "4":
      return Carbon::createFromTimeStamp(strtotime($input))->diffForHumans();
      break;
  }
}
// ermittle Clubbezeichung
function ermittle_Club($wert)
{
  $club = 'WTC';
  //
  switch ($wert)
  {
    case 1:
      $club = 'FC';
      break;
    case 2:
      $club = 'Real';
      break;
    case 3:
      $club = 'Inter';
      break;
    case 4:
      $club = 'Club';
      break;
    case 5:
      $club = 'Fortuna';
      break;
    case 6:
      $club = 'Union';
      break;
    case 7:
      $club = 'TFC';
      break;
    case 8:
      $club = 'SC';
      break;
    case 9:
      $club = 'Sporting';
      break;
    case 10:
      $club = 'Team';
      break;
    default:
      $club = 'WTC';
  }
  //
  return $club;
}
function ermittle_Pokalrundenname($rundennr, $pokaltyp)
{
  // $pokaltyp = 1 --> Pokal
  // $pokaltyp = 2 --> WM
  // Rückgabewerte
  // ermittle Namen der Pokalrunde
  $pokalrundenname = 'unbekannt';
  if ($pokaltyp === 1) {
    switch ($rundennr) {
      case 1:
        $pokalrundenname = '1. Runde';
        break;
      case 2:
        $pokalrundenname = '2. Runde';
        break;
      case 3:
        $pokalrundenname = '3. Runde';
        break;
      case 4:
        $pokalrundenname = '4. Runde';
        break;
      case 5:
        $pokalrundenname = 'Achtelfinale';
        break;
      case 6:
        $pokalrundenname = 'Viertelfinale';
        break;
      case 7:
        $pokalrundenname = 'Halbfinale';
        break;
      case 8:
        $pokalrundenname = 'Endspiel';
        break;
      default:
        $pokalrundenname = 'unbekannt';
    }
  }
  if ($pokaltyp === 2) {
    switch ($rundennr) {
      case 1:
        $pokalrundenname = 'Achtelfinale';
        break;
      case 2:
        $pokalrundenname = 'Viertelfinale';
        break;
      case 3:
        $pokalrundenname = 'Halbfinale';
        break;
      case 4:
        $pokalrundenname = 'WM-Endspiel';
        break;
      default:
        $pokalrundenname = '1. Runde';
    }
  }
  //
  return $pokalrundenname;
}
// Ermittle die Taktik für ein Spiel
function ermittle_Taktik($teamnr, $spieltypnr)
{
  // Rückgabewert
  $taktiknr = 1;
  //
  $team = Team::find($teamnr);
  //
  if (!$team) {
    return $taktiknr;
  }
  // prüfe team.SpieltaktikNr
  if ($team->SpieltaktikNr > 0 && $team->SpieltaktikNr < 6) {
    return $team->SpieltaktikNr;
  }
  //
  $alg_spiel  = $team->TmAlg_Spiel;
  // falls teamwert < 810 ist, dann mit 75 % Wahrscheinlichkeit Taktik 1 anwenden
  $team_wert = $team->TeamWert;
  $zwtw = random_int(1,100);
  if ($team_wert < 810 && $zwtw < 75) {
    $taktiknr = 1;
    return $taktiknr;
  }
  //
  $fitnesswertsumme = $team->T02 + $team->T03 + $team->T04 + $team->T05 + $team->T06 + $team->T07 + $team->T08 + $team->T09 + $team->T10 + $team->T11;
  //
  $zw100 = random_int(1,100);
  // Prüfe, ob es Spieler gibt mit einem Wert < 40
  if ($team->T02 < 40)
  {
    $taktiknr = 1;
    return $taktiknr;
  }
  if ($team->T03 < 40)
  {
    $taktiknr = 1;
    return $taktiknr;
  }
  if ($team->T04 < 40)
  {
    $taktiknr = 1;
    return $taktiknr;
  }
  if ($team->T05 < 40)
  {
    $taktiknr = 1;
    return $taktiknr;
  }
  if ($team->T06 < 40)
  {
    $taktiknr = 1;
    return $taktiknr;
  }
  if ($team->T07 < 40)
  {
    $taktiknr = 1;
    return $taktiknr;
  }
  if ($team->T09 < 40)
  {
    $taktiknr = 1;
    return $taktiknr;
  }
  if ($team->T09 < 40)
  {
    $taktiknr = 1;
    return $taktiknr;
  }
  if ($team->T10 < 40)
  {
    $taktiknr = 1;
    return $taktiknr;
  }
  if ($team->T11 < 40)
  {
    $taktiknr = 1;
    return $taktiknr;
  }
  //
  if ($alg_spiel == 1)
  {
    if ($spieltypnr < 100)
    {
      if ($fitnesswertsumme < 1100)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 1100 && $fitnesswertsumme < 1500)
      {
        $taktiknr = 2;
      }
      if ($fitnesswertsumme >= 1500 && $fitnesswertsumme < 1800)
      {
        if ($zw100>=0 && $zw100<50) {
          $taktiknr = 3;
        }
        if ($zw100>=50 && $zw100<60) {
          $taktiknr = 4;
        }
        if ($zw100>=60 && $zw100<101) {
          $taktiknr = 5;
        }
      }
      if ($fitnesswertsumme >= 1800)
      {
        $taktiknr = 5;
      }
    } else {
      if ($fitnesswertsumme < 700)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 700 && $fitnesswertsumme < 1400) {
        $taktiknr = 4;
      }
      if ($fitnesswertsumme >= 1400)
      {
        $taktiknr = 5;
      }
    }
    return $taktiknr;
  }
  //
  if ($alg_spiel == 2)
  {
    if ($spieltypnr < 100)
    {
      if ($fitnesswertsumme < 800)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 800 && $fitnesswertsumme < 1400) {
        if ($zw100>=0 && $zw100<7) {
          $taktiknr = 1;
        }
        if ($zw100>=7 && $zw100<19) {
          $taktiknr = 2;
        }
        if ($zw100>=19 && $zw100<83) {
          $taktiknr = 3;
        }
        if ($zw100>=83 && $zw100<95) {
          $taktiknr = 4;
        }
        if ($zw100>=95 && $zw100<101) {
          $taktiknr = 5;
        }
      }
      if ($fitnesswertsumme >= 1400)
      {
        $taktiknr = 4;
      }
    } else {
      if ($fitnesswertsumme < 700)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 700 && $fitnesswertsumme < 800) {
        $taktiknr = 4;
      }
      if ($fitnesswertsumme >= 800)
      {
        $taktiknr = 5;
      }
    }
    return $taktiknr;
  }
  //
  if ($alg_spiel == 3)
  {
    if ($spieltypnr < 100)
    {
      if ($fitnesswertsumme < 800)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 800 && $fitnesswertsumme < 1100) {
        if ($zw100>=0 && $zw100<16) {
          $taktiknr = 2;
        }
        if ($zw100>=17 && $zw100<83) {
          $taktiknr = 3;
        }
        if ($zw100>=83 && $zw100<95) {
          $taktiknr = 4;
        }
        if ($zw100>=95 && $zw100<101) {
          $taktiknr = 5;
        }
      }
      if ($fitnesswertsumme >= 1100)
      {
        $taktiknr = 4;
      }
    } else {
      if ($fitnesswertsumme < 700)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 700 && $fitnesswertsumme < 800) {
        $taktiknr = 4;
      }
      if ($fitnesswertsumme >= 800)
      {
        $taktiknr = 5;
      }
    }
    return $taktiknr;
  }
  //
  if ($alg_spiel == 4)
  {
    if ($spieltypnr < 100)
    {
      if ($fitnesswertsumme < 800)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 800 && $fitnesswertsumme < 1000) {
        if ($zw100>=0 && $zw100<9) {
          $taktiknr = 1;
        }
        if ($zw100>=9 && $zw100<25) {
          $taktiknr = 2;
        }
        if ($zw100>=25 && $zw100<78) {
          $taktiknr = 3;
        }
        if ($zw100>=78 && $zw100<94) {
          $taktiknr = 4;
        }
        if ($zw100>=94 && $zw100<101) {
          $taktiknr = 5;
        }
      }
      if ($fitnesswertsumme >= 1000)
      {
        $taktiknr = 4;
      }
    } else {
      if ($fitnesswertsumme < 700)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 700 && $fitnesswertsumme < 800) {
        $taktiknr = 4;
      }
      if ($fitnesswertsumme >= 800)
      {
        $taktiknr = 5;
      }
    }
    return $taktiknr;
  }
  //
  if ($alg_spiel == 5)
  {
    if ($spieltypnr < 100)
    {
      if ($fitnesswertsumme < 800)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 800 && $fitnesswertsumme < 1300)
      {
        $taktiknr = 2;
      }
      if ($fitnesswertsumme >= 1300 && $fitnesswertsumme < 1600)
      {
        $taktiknr = 3;
      }
      if ($fitnesswertsumme >= 1600)
      {
        $taktiknr = 4;
      }
    } else {
      if ($fitnesswertsumme < 900)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 900 && $fitnesswertsumme < 1100) {
        $taktiknr = 2;
      }
      if ($fitnesswertsumme >= 1100) {
        $taktiknr = 5;
      }
    }
    return $taktiknr;
  }
  //
  if ($alg_spiel == 6)
  {
    if ($spieltypnr < 100)
    {
      if ($fitnesswertsumme < 800)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 800 && $fitnesswertsumme < 1000)
      {
        if ($zw100>=0 && $zw100<40) {
          $taktiknr = 2;
        }
        if ($zw100>=40 && $zw100<80) {
          $taktiknr = 3;
        }
        if ($zw100>=80 && $zw100<90) {
          $taktiknr = 4;
        }
        if ($zw100>=90 && $zw100<101) {
          $taktiknr = 5;
        }
      }
      if ($fitnesswertsumme >= 1000)
      {
        if ($zw100>=0 && $zw100<50) {
          $taktiknr = 4;
        }
        if ($zw100>=50 && $zw100<101) {
          $taktiknr = 5;
        }
      }
    } else {
      if ($fitnesswertsumme < 700)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 700 && $fitnesswertsumme < 800) {
        $taktiknr = 4;
      }
      if ($fitnesswertsumme >= 800)
      {
        $taktiknr = 5;
      }
    }
    return $taktiknr;
  }
  //
  if ($alg_spiel == 7)
  {
    if ($spieltypnr < 100)
    {
      if ($fitnesswertsumme < 800)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 800 && $fitnesswertsumme < 1000) {
        $taktiknr = 2;
      }
      if ($fitnesswertsumme >= 1000 && $fitnesswertsumme < 1500) {
        $taktiknr = 4;
      }
      if ($fitnesswertsumme >= 1500)
      {
        $taktiknr = 5;
      }
    }
    if ($spieltypnr > 100 && $spieltypnr < 200) {
    }
    if ($spieltypnr > 200) {
      if ($fitnesswertsumme < 700)
      {
        $taktiknr = 1;
      }
      if ($fitnesswertsumme >= 700)
      {
        $taktiknr = 5;
      }
    }
    return $taktiknr;
  }
  // Zur Sicherheit nochmals ein Return
  return $taktiknr;
}
// Ermittle Pokalwerte anhand der spieltypnr
function ermittle_Pokalrunde_Hin_Rueck($spieltypnr)
{
  $pokalrunde = 0;
  $hinspielkz = true;
  $anzahl = 0;
  //
  if ($spieltypnr == 101)
  {
    $pokalrunde = 1;
    $hinspielkz = true;
    $anzahl = 128;
  }
  if ($spieltypnr == 102)
  {
    $pokalrunde = 1;
    $hinspielkz = false;
    $anzahl = 128;
  }
  //
  if ($spieltypnr == 103)
  {
    $pokalrunde = 2;
    $hinspielkz = true;
    $anzahl = 64;
  }
  if ($spieltypnr == 104)
  {
    $pokalrunde = 2;
    $hinspielkz = false;
    $anzahl = 64;
  }
  //
  if ($spieltypnr == 105)
  {
    $pokalrunde = 3;
    $hinspielkz = true;
    $anzahl = 32;
  }
  if ($spieltypnr == 106)
  {
    $pokalrunde = 3;
    $hinspielkz = false;
    $anzahl = 32;
  }
  //
  if ($spieltypnr == 107)
  {
    $pokalrunde = 4;
    $hinspielkz = true;
    $anzahl = 16;
  }
  if ($spieltypnr == 108)
  {
    $pokalrunde = 4;
    $hinspielkz = false;
    $anzahl = 16;
  }
  //
  if ($spieltypnr == 109)
  {
    $pokalrunde = 5;
    $hinspielkz = true;
    $anzahl = 8;
  }
  if ($spieltypnr == 110)
  {
    $pokalrunde = 5;
    $hinspielkz = false;
    $anzahl = 8;
  }
  //
  if ($spieltypnr == 111)
  {
    $pokalrunde = 6;
    $hinspielkz = true;
    $anzahl = 4;
  }
  if ($spieltypnr == 112)
  {
    $pokalrunde = 6;
    $hinspielkz = false;
    $anzahl = 4;
  }
  //
  if ($spieltypnr == 113)
  {
    $pokalrunde = 7;
    $hinspielkz = true;
    $anzahl = 2;
  }
  if ($spieltypnr == 114)
  {
    $pokalrunde = 7;
    $hinspielkz = false;
    $anzahl = 2;
  }
  //
  if ($spieltypnr == 115)
  {
    $pokalrunde = 8;
    $hinspielkz = true;
    $anzahl = 1;
  }
  if ($spieltypnr == 116)
  {
    $pokalrunde = 8;
    $hinspielkz = false;
    $anzahl = 1;
  }
  if ($spieltypnr == 201)
  {
    $pokalrunde = 1;
    $hinspielkz = true;
    $anzahl = 8;
  }
  if ($spieltypnr == 202)
  {
    $pokalrunde = 1;
    $hinspielkz = false;
    $anzahl = 8;
  }
  if ($spieltypnr == 203)
  {
    $pokalrunde = 2;
    $hinspielkz = true;
    $anzahl = 4;
  }
  if ($spieltypnr == 204)
  {
    $pokalrunde = 2;
    $hinspielkz = false;
    $anzahl = 4;
  }
  if ($spieltypnr == 205)
  {
    $pokalrunde = 3;
    $hinspielkz = true;
    $anzahl = 2;
  }
  if ($spieltypnr == 206)
  {
    $pokalrunde = 3;
    $hinspielkz = false;
    $anzahl = 2;
  }
  if ($spieltypnr == 207)
  {
    $pokalrunde = 4;
    $hinspielkz = true;
    $anzahl = 1;
  }
  if ($spieltypnr == 208)
  {
    $pokalrunde = 4;
    $hinspielkz = false;
    $anzahl = 1;
  }
  return ([
    'pokalrunde'  => $pokalrunde,
    'hinspielkz'  => $hinspielkz,
    'anzahl'      => $anzahl,
  ]);
}
// Ermittle Spielbericht mit Hilfe der SpielNr
function ermittle_Spielbericht($spielnr)
{
  $spielbericht = 'unbekannt';
  //
  $single_spiel = Spiel::where('SpielNr', '=', $spielnr)
    ->first();
  //
  if ($single_spiel) {
    $spielbericht = $single_spiel->SpielBericht;
  }
  //
  return $spielbericht;
}
// Dokumentiere die Landesmeister einer Saison
function ermittle_Landesmeister($saisonnr)
{
  // Rückgabewerte
  $fehlerkz = false;
  $fehlermeldung = '';
  // prüfe, ob diese Saison abgeschlossen ist
  $steuerung = Steuerung::where('SNr', '=', 1)->first();
  //
  $aktSaisonNr = 0;
  $aktSpieltagRunde = 0;
  //
  $aktSaisonNr = $steuerung->SzugSaisonNr;
  $aktSpieltagRunde = $steuerung->SzugSpieltagRunde;
  //
  if ($saisonnr <> $aktSaisonNr) {
    $fehlerkz = true;
    $fehlermeldung = 'Die vorgegebene Saison ist nicht mehr aktuell.<br />';
  }
  //
  if ($aktSpieltagRunde <> 30) {
    $fehlerkz = true;
    $fehlermeldung = 'Der Spieltag der vorgegebenen Saison ist nicht gültig.<br />';
  }
  //
  if (!$fehlerkz) {
    $landesmeister = LigaTabelle::where('LTzugSaisonNr', '=', $saisonnr)
      ->where('LTPlatz', '=', 1)
      ->where('LTSpieltag', '=', 30)
      ->orderBy('LTzugTeamNr')
      ->get();
    // hier noch alle Landesmeister durchlaufen und einen neuen Datensatz in TeamTitel anlegen.
    foreach($landesmeister as $meister)
    {
      $single_teamtitel = new TeamTitel;
      $single_teamtitel->TTzugSaisonNr = $saisonnr;
      $single_teamtitel->TTzugTeamNr = $meister->LTzugTeamNr;
      $single_teamtitel->TTzugLandNr = $meister->LTzugLandNr;
      $single_teamtitel->TTTitelTypNr = 1;
      $single_teamtitel->TTName = 'Landesmeister';
      $single_teamtitel->save();
    }
  }
  //
  return ([
    'fehlerkz' => $fehlerkz,
    'fehlermeldung' => $fehlermeldung
  ]);
}
// Ermittle Verletzungsgrad
function ermittle_Verletzungsgrad($reduktionswert)
{
  $grad = 'leicht';
  //
  if ($reduktionswert > 200) {
    $grad = 'sehr schwer';
  }
  if ($reduktionswert > 100 && $reduktionswert <= 200) {
    $grad = 'schwer';
  }
  if ($reduktionswert > 50 && $reduktionswert <= 100) {
    $grad = 'mittelschwer';
  }
  //
  return $grad;
}
// Ermittle Landesmeister
function ermittle_Landesmeister_Saison($saisonnr, $liganr)
{
  $landesmeister = 'unbekannt';
  // ermittle Landesmeister
  $meister = DB::table('teamtitel')
    ->select('team.TeamName AS TeamName')
    ->join('team', 'team.TeamNr', '=', 'teamtitel.TTzugTeamNr')
    ->where('TTzugSaisonNr', '=', $saisonnr)
    ->where('TTzugLandNr', '=', $liganr)
    ->where('TTTitelTypNr', '=', 1)
    ->first();
  //
  if ($meister) {
    $landesmeister = $meister->TeamName;
  }
  //
  return $landesmeister;
}
?>

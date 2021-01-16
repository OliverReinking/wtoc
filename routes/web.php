<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LigenController;
use App\Http\Controllers\SpielController;

// Startseite
Route::get('/', [SpielController::class, 'about']);
// Startseite
Route::get('/about', [SpielController::class, 'about']);
// Aktionsseite
Route::get('/aktion', [SpielController::class, 'aktion']);
// Button Steuerungsdaten ermitteln
Route::post('/wtoc/steuerungsdaten', [SpielController::class, 'steuerungsdaten_ermitteln'])->name('WTOC_Steuerungsdaten_ermitteln');
// Button Aktion starten
Route::post('/wtoc/aktion', [SpielController::class, 'aktion_starten'])->name('WTOC_Aktion_starten');
// Newsseite
Route::get('/news', [SpielController::class, 'news']);
// Liste der Ligen
Route::get('/country', [LigenController::class, 'country'])->name('Country');
// Liga
Route::get('/ligen/{liganr}', [LigenController::class, 'liga'])->name('Liga');
// Liga Saison
Route::get('/saison/{liganr}/{saisonnr}', [LigenController::class, 'saison'])->name('Saison');
// Liga Saison Spieltag
Route::get('/spieltag/{liganr}/{saisonnr}/{spieltagnr}', [LigenController::class, 'spieltag'])->name('SaisonSpieltag');
// Ereignis Ligaliveticker starten
Route::put('/ticker/Ligalivetickerdaten_ermitteln/{liganr}/{saisonnr}/{spieltagnr}/{heimnr}/{gastnr}', [
    LigenController::class, 'ermittle_Ligalivetickerdaten'
])->name('Ligalivetickerdaten_ermitteln');
// Liga Saison Spieltag Team Ligaliveticker
Route::get('/ligaliveticker/{liganr}/{saisonnr}/{spieltagnr}/{heimnr}/{gastnr}', [LigenController::class, 'ligaliveticker'])->name('Ligaliveticker');
// Liga Team
Route::get('/team/{liganr}/{teamnr}', [LigenController::class, 'team'])->name('Team');
// Liga Team Saison
Route::get('/team_saison/{liganr}/{teamnr}/{saisonnr}', [LigenController::class, 'team_saison'])->name('Team-Saison');
// Weltmeisterschaft
Route::get('/worldchampionship', [LigenController::class, 'worldchampionship'])->name('World-Championship');
// Weltmeisterschaft Saison
Route::get('/worldchampionship_saison/{saisonnr}', [LigenController::class, 'worldchampionship_saison'])->name('World-Championship-Saison');
// Pokalwettbewerb
Route::get('/cup', [LigenController::class, 'cup'])->name('Pokal');
// Pokalwettbewerb Saison
Route::get('/cup_saison/{saisonnr}', [LigenController::class, 'cup_saison'])->name('Pokalsaison');

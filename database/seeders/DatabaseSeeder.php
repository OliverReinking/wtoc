<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->call(SteuerungTableSeeder::class);
        //
        $this->call(AktionTableSeeder::class);
        //
        $this->call(TeamTableSeeder::class);
        //
        $this->call(TeamKontoTableSeeder::class);
        //
        $this->call(PlayerTableSeeder::class);
        //
        $this->call(SaisonTableSeeder::class);
        //
        $this->call(SpieltypTableSeeder::class);
        //
        $this->call(SpielplanTableSeeder::class);
        //
        $this->call(LandTableSeeder::class);
        //
        $this->call(AuslosungTabelleSeeder::class);
    }
}
//
class SteuerungTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Steuerung')->insert([
            'SNr' => 1,
            'SzugSaisonNr' => 1,
            'SzugSpieltagRunde' => 0,
            'SzugPokalRunde' => 0,
            'SzugWMRunde' => 0,
            'SzugAktionNr' => 1,
            'SInfoChannelID' => '-1001232774436',
            'SCupChannelID' => '-1001388121049',
            'SWMChannelID' => '-1001305817194',
        ]);
    }
}
//
class TeamKontoTableSeeder extends Seeder
{
    public function run()
    {
        for ($j = 1; $j <= 256; $j++) {
            //
            DB::table('TeamKonto')->insert([
                'TKNr' => $j,
                'TKzugTeamNr' => $j,
                'TKzugSaisonNr' => 1,
                'TKWert' => 50000,
                'TKName' => 'Startkapital',
            ]);
        }
    }
}
//
class TeamTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Team')->insert([
            'TeamNr' => 1,
            'TeamCity' => 'Zweibrücken',
            'TeamName' => 'Zweibrücker Löwen',
            'TeamSpielplanNr' => 1,
            'TmAlg_Spiel' => 1,
            'TmAlg_Kauf' => 4,
            'TeamChannelKZ' => false,
            'TeamChannelID' => '-1001251409347'
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 2,
            'TeamCity' => 'Berlin',
            'TeamName' => 'Berliner Bären',
            'TeamSpielplanNr' => 2,
            'TmAlg_Spiel' => 1,
            'TmAlg_Kauf' => 1,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 3,
            'TeamCity' => 'Rendsburg',
            'TeamName' => 'Rendsburger Möwen',
            'TeamSpielplanNr' => 3,
            'TmAlg_Spiel' => 7,
            'TmAlg_Kauf' => 7,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 4,
            'TeamCity' => 'Hamburg',
            'TeamName' => 'Hansa Hamburg',
            'TeamSpielplanNr' => 4,
            'TmAlg_Spiel' => 6,
            'TmAlg_Kauf' => 6,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 5,
            'TeamCity' => 'Bremen',
            'TeamName' => 'Hansa Bremen',
            'TeamSpielplanNr' => 5,
            'TmAlg_Spiel' => 6,
            'TmAlg_Kauf' => 6,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 6,
            'TeamCity' => 'Gelsenkirchen',
            'TeamName' => 'FC Gelsenkirchen',
            'TeamSpielplanNr' => 6,
            'TmAlg_Spiel' => 5,
            'TmAlg_Kauf' => 5,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 7,
            'TeamCity' => 'Dortmund',
            'TeamName' => 'Dynamo Dortmund',
            'TeamSpielplanNr' => 7,
            'TmAlg_Spiel' => 5,
            'TmAlg_Kauf' => 5,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 8,
            'TeamCity' => 'Duisburg',
            'TeamName' => 'Duisburger Adler',
            'TeamSpielplanNr' => 8,
            'TmAlg_Spiel' => 3,
            'TmAlg_Kauf' => 3,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 9,
            'TeamCity' => 'Düsseldorf',
            'TeamName' => 'FC Düsseldorf',
            'TeamSpielplanNr' => 9,
            'TmAlg_Spiel' => 2,
            'TmAlg_Kauf' => 2,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 10,
            'TeamCity' => 'Köln',
            'TeamName' => 'FC Köln',
            'TeamSpielplanNr' => 10,
            'TmAlg_Spiel' => 2,
            'TmAlg_Kauf' => 2,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 11,
            'TeamCity' => 'Saarbrücken',
            'TeamName' => 'Saarbrücker Bären',
            'TeamSpielplanNr' => 11,
            'TmAlg_Spiel' => 4,
            'TmAlg_Kauf' => 4,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 12,
            'TeamCity' => 'Dresden',
            'TeamName' => 'Lokomotive Dresden',
            'TeamSpielplanNr' => 12,
            'TmAlg_Spiel' => 1,
            'TmAlg_Kauf' => 1,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 13,
            'TeamCity' => 'München',
            'TeamName' => 'Adler München',
            'TeamSpielplanNr' => 13,
            'TmAlg_Spiel' => 3,
            'TmAlg_Kauf' => 3,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 14,
            'TeamCity' => 'Nürnberg',
            'TeamName' => 'Nürnberger Bullen',
            'TeamSpielplanNr' => 14,
            'TmAlg_Spiel' => 4,
            'TmAlg_Kauf' => 4,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 15,
            'TeamCity' => 'Frankfurt',
            'TeamName' => 'Fortuna Frankfurt',
            'TeamSpielplanNr' => 15,
            'TmAlg_Spiel' => 4,
            'TmAlg_Kauf' => 4,
        ]);
        DB::table('Team')->insert([
            'TeamNr' => 16,
            'TeamCity' => 'Lübeck',
            'TeamName' => 'Hansa Lübeck',
            'TeamSpielplanNr' => 16,
            'TmAlg_Spiel' => 7,
            'TmAlg_Kauf' => 7,
        ]);
        //
        for ($i = 2; $i <= 16; $i++) {
            for ($j = 1; $j <= 16; $j++) {
                $k = (($i - 1) * 16) + $j;
                $zw1 = random_int(1, 7);
                $zw2 = random_int(1, 7);
                //
                DB::table('Team')->insert([
                    'TeamNr' => $k,
                    'TzugLandNr' => $i,
                    'TeamCity' => $k . '-Stadt',
                    'TeamName' => $k,
                    'TeamSpielplanNr' => $j,
                    'TmAlg_Spiel' => $zw1,
                    'TmAlg_Kauf' => $zw2,
                ]);
            }
        }
        // Italien: 17-32
        DB::table('Team')->where('TeamNr', '=', 17)->update(['TeamCity' => 'Barletta', 'TeamName' => 'WTC Barletta']);
        DB::table('Team')->where('TeamNr', '=', 18)->update(['TeamCity' => 'Rom', 'TeamName' => 'WTC Rom']);
        DB::table('Team')->where('TeamNr', '=', 19)->update(['TeamCity' => 'Turin', 'TeamName' => 'WTC Turin']);
        DB::table('Team')->where('TeamNr', '=', 20)->update(['TeamCity' => 'Pisa', 'TeamName' => 'WTC Pisa']);
        DB::table('Team')->where('TeamNr', '=', 21)->update(['TeamCity' => 'Neapel', 'TeamName' => 'WTC Neapel']);
        DB::table('Team')->where('TeamNr', '=', 22)->update(['TeamCity' => 'Bologna', 'TeamName' => 'WTC Bologna']);
        DB::table('Team')->where('TeamNr', '=', 23)->update(['TeamCity' => 'Florenz', 'TeamName' => 'WTC Florenz']);
        DB::table('Team')->where('TeamNr', '=', 24)->update(['TeamCity' => 'Verona', 'TeamName' => 'WTC Verona']);
        DB::table('Team')->where('TeamNr', '=', 25)->update(['TeamCity' => 'Varese', 'TeamName' => 'WTC Varese']);
        DB::table('Team')->where('TeamNr', '=', 26)->update(['TeamCity' => 'Venedig', 'TeamName' => 'WTC Venedig']);
        DB::table('Team')->where('TeamNr', '=', 27)->update(['TeamCity' => 'Ragusa', 'TeamName' => 'WTC Ragusa']);
        DB::table('Team')->where('TeamNr', '=', 28)->update(['TeamCity' => 'Imola', 'TeamName' => 'WTC Imola']);
        DB::table('Team')->where('TeamNr', '=', 29)->update(['TeamCity' => 'Trapani', 'TeamName' => 'WTC Trapani']);
        DB::table('Team')->where('TeamNr', '=', 30)->update(['TeamCity' => 'Carpi', 'TeamName' => 'WTC Carpi']);
        DB::table('Team')->where('TeamNr', '=', 31)->update(['TeamCity' => 'Bergamo', 'TeamName' => 'WTC Bergamo']);
        DB::table('Team')->where('TeamNr', '=', 32)->update(['TeamCity' => 'Pescara', 'TeamName' => 'WTC Pescara']);
        // Frankreich: 33-48
        DB::table('Team')->where('TeamNr', '=', 33)->update(['TeamCity' => 'Lille', 'TeamName' => 'SC Lille']);
        DB::table('Team')->where('TeamNr', '=', 34)->update(['TeamCity' => 'Avignon', 'TeamName' => 'WTC Avignon']);
        DB::table('Team')->where('TeamNr', '=', 35)->update(['TeamCity' => 'Versailles', 'TeamName' => 'WTC Versailles']);
        DB::table('Team')->where('TeamNr', '=', 36)->update(['TeamCity' => 'Paris', 'TeamName' => 'WTC Paris']);
        DB::table('Team')->where('TeamNr', '=', 37)->update(['TeamCity' => 'Lyon', 'TeamName' => 'WTC Lyon']);
        DB::table('Team')->where('TeamNr', '=', 38)->update(['TeamCity' => 'Marseille', 'TeamName' => 'WTC Marseille']);
        DB::table('Team')->where('TeamNr', '=', 39)->update(['TeamCity' => 'Cannes', 'TeamName' => 'WTC Cannes']);
        DB::table('Team')->where('TeamNr', '=', 40)->update(['TeamCity' => 'Toulouse', 'TeamName' => 'WTC Toulouse']);
        DB::table('Team')->where('TeamNr', '=', 41)->update(['TeamCity' => 'Nantes', 'TeamName' => 'WTC Nantes']);
        DB::table('Team')->where('TeamNr', '=', 42)->update(['TeamCity' => 'Montpellier', 'TeamName' => 'WTC Montpellier']);
        DB::table('Team')->where('TeamNr', '=', 43)->update(['TeamCity' => 'Nizza', 'TeamName' => 'WTC Nizza']);
        DB::table('Team')->where('TeamNr', '=', 44)->update(['TeamCity' => 'Bordeaux', 'TeamName' => 'WTC Bordeaux']);
        DB::table('Team')->where('TeamNr', '=', 45)->update(['TeamCity' => 'Reims', 'TeamName' => 'WTC Reims']);
        DB::table('Team')->where('TeamNr', '=', 46)->update(['TeamCity' => 'Strasbourg', 'TeamName' => 'WTC Strasbourg']);
        DB::table('Team')->where('TeamNr', '=', 47)->update(['TeamCity' => 'Rennes', 'TeamName' => 'WTC Rennes']);
        DB::table('Team')->where('TeamNr', '=', 48)->update(['TeamCity' => 'Grenoble', 'TeamName' => 'WTC Grenoble']);
        // England: 49-64
        DB::table('Team')->where('TeamNr', '=', 49)->update(['TeamCity' => 'Bolton', 'TeamName' => 'Bolton Wasps']);
        DB::table('Team')->where('TeamNr', '=', 50)->update(['TeamCity' => 'London', 'TeamName' => 'London Crocodiles']);
        DB::table('Team')->where('TeamNr', '=', 51)->update(['TeamCity' => 'Liverpool', 'TeamName' => 'FFC Liverpool']);
        DB::table('Team')->where('TeamNr', '=', 52)->update(['TeamCity' => 'Oxford', 'TeamName' => 'Oxford Owls']);
        DB::table('Team')->where('TeamNr', '=', 53)->update(['TeamCity' => 'Huddersfield', 'TeamName' => 'Huddersfield Hawks']);
        DB::table('Team')->where('TeamNr', '=', 54)->update(['TeamCity' => 'York', 'TeamName' => 'FFC York']);
        DB::table('Team')->where('TeamNr', '=', 55)->update(['TeamCity' => 'Newport', 'TeamName' => 'Newport Lions']);
        DB::table('Team')->where('TeamNr', '=', 56)->update(['TeamCity' => 'Leeds', 'TeamName' => 'TC Leeds United']);
        DB::table('Team')->where('TeamNr', '=', 57)->update(['TeamCity' => 'Manchester', 'TeamName' => 'Club Manchester City']);
        DB::table('Team')->where('TeamNr', '=', 58)->update(['TeamCity' => 'Sunderland', 'TeamName' => 'Sunderland Spiders']);
        DB::table('Team')->where('TeamNr', '=', 59)->update(['TeamCity' => 'Birmingham', 'TeamName' => 'TSC Birmingham Bulls']);
        DB::table('Team')->where('TeamNr', '=', 60)->update(['TeamCity' => 'Nottingham', 'TeamName' => 'TSC Nottingham Forest']);
        DB::table('Team')->where('TeamNr', '=', 61)->update(['TeamCity' => 'Lincoln', 'TeamName' => 'Lincoln Lions']);
        DB::table('Team')->where('TeamNr', '=', 62)->update(['TeamCity' => 'Halifax', 'TeamName' => 'Halifax Hawks']);
        DB::table('Team')->where('TeamNr', '=', 63)->update(['TeamCity' => 'Derby', 'TeamName' => 'Derby Dolphins']);
        DB::table('Team')->where('TeamNr', '=', 64)->update(['TeamCity' => 'Barnsley', 'TeamName' => 'Barnsley Bobcats']);
        // Spanien: 65-80
        DB::table('Team')->where('TeamNr', '=', 65)->update(['TeamCity' => 'Bilbao', 'TeamName' => 'FC Bilbao']);
        DB::table('Team')->where('TeamNr', '=', 66)->update(['TeamCity' => 'Madrid', 'TeamName' => 'WTC Madrid']);
        DB::table('Team')->where('TeamNr', '=', 67)->update(['TeamCity' => 'Barcelona', 'TeamName' => 'WTC Barcelona']);
        DB::table('Team')->where('TeamNr', '=', 68)->update(['TeamCity' => 'Sevilla', 'TeamName' => 'WTC Sevilla']);
        DB::table('Team')->where('TeamNr', '=', 69)->update(['TeamCity' => 'Valencia', 'TeamName' => 'WTC Valencia']);
        DB::table('Team')->where('TeamNr', '=', 70)->update(['TeamCity' => 'Palma', 'TeamName' => 'WTC Palma']);
        DB::table('Team')->where('TeamNr', '=', 71)->update(['TeamCity' => 'Vigo', 'TeamName' => 'WTC Vigo']);
        DB::table('Team')->where('TeamNr', '=', 72)->update(['TeamCity' => 'Alicante', 'TeamName' => 'WTC Alicante']);
        DB::table('Team')->where('TeamNr', '=', 73)->update(['TeamCity' => 'Cartagena', 'TeamName' => 'WTC Catagena']);
        DB::table('Team')->where('TeamNr', '=', 74)->update(['TeamCity' => 'Badalona', 'TeamName' => 'WTC Badalona']);
        DB::table('Team')->where('TeamNr', '=', 75)->update(['TeamCity' => 'Burgos', 'TeamName' => 'WTC Burgos']);
        DB::table('Team')->where('TeamNr', '=', 76)->update(['TeamCity' => 'Santander', 'TeamName' => 'WTC Santander']);
        DB::table('Team')->where('TeamNr', '=', 77)->update(['TeamCity' => 'Murcia', 'TeamName' => 'WTC Murcia']);
        DB::table('Team')->where('TeamNr', '=', 78)->update(['TeamCity' => 'Getafe', 'TeamName' => 'WTC Getafe']);
        DB::table('Team')->where('TeamNr', '=', 79)->update(['TeamCity' => 'Lorca', 'TeamName' => 'WTC Lorca']);
        DB::table('Team')->where('TeamNr', '=', 80)->update(['TeamCity' => 'Toledo', 'TeamName' => 'WTC Toledo']);
        // Niederlande 81-99
        DB::table('Team')->where('TeamNr', '=', 81)->update(['TeamCity' => 'Utrecht', 'TeamName' => 'WTC Utrecht']);
        DB::table('Team')->where('TeamNr', '=', 82)->update(['TeamCity' => 'Amsterdam', 'TeamName' => 'WTC Amsterdam']);
        DB::table('Team')->where('TeamNr', '=', 83)->update(['TeamCity' => 'Alkmaar', 'TeamName' => 'WTC Alkmaar']);
        DB::table('Team')->where('TeamNr', '=', 84)->update(['TeamCity' => 'Twente', 'TeamName' => 'WTC Twente']);
        DB::table('Team')->where('TeamNr', '=', 85)->update(['TeamCity' => 'Rotterdam', 'TeamName' => 'WTC Rotterdam']);
        DB::table('Team')->where('TeamNr', '=', 86)->update(['TeamCity' => 'Groningen', 'TeamName' => 'WTC Groningen']);
        DB::table('Team')->where('TeamNr', '=', 87)->update(['TeamCity' => 'Breda', 'TeamName' => 'WTC Breda']);
        DB::table('Team')->where('TeamNr', '=', 88)->update(['TeamCity' => 'Den Haag', 'TeamName' => 'WTC Den Haag']);
        DB::table('Team')->where('TeamNr', '=', 89)->update(['TeamCity' => 'Eindhoven', 'TeamName' => 'WTC Eindhoven']);
        DB::table('Team')->where('TeamNr', '=', 90)->update(['TeamCity' => 'Haarlem', 'TeamName' => 'WTC Haarlem']);
        DB::table('Team')->where('TeamNr', '=', 91)->update(['TeamCity' => 'Arnhem', 'TeamName' => 'WTC Arnhem']);
        DB::table('Team')->where('TeamNr', '=', 92)->update(['TeamCity' => 'apeldoorn', 'TeamName' => 'WTC Apeldoorn']);
        DB::table('Team')->where('TeamNr', '=', 93)->update(['TeamCity' => 'Enschede', 'TeamName' => 'WTC Enschede']);
        DB::table('Team')->where('TeamNr', '=', 94)->update(['TeamCity' => 'Helmond', 'TeamName' => 'WTC Helmond']);
        DB::table('Team')->where('TeamNr', '=', 95)->update(['TeamCity' => 'Hoorn', 'TeamName' => 'WTC Hoorn']);
        DB::table('Team')->where('TeamNr', '=', 96)->update(['TeamCity' => 'Almelo', 'TeamName' => 'WTC Almelo']);
        // Dänemark 97-112
        DB::table('Team')->where('TeamNr', '=', 97)->update(['TeamCity' => 'Viborg', 'TeamName' => 'Victoria Viborg']);
        DB::table('Team')->where('TeamNr', '=', 98)->update(['TeamCity' => 'Kopenhagen', 'TeamName' => 'WTC Kopenhagen']);
        DB::table('Team')->where('TeamNr', '=', 99)->update(['TeamCity' => 'Odense', 'TeamName' => 'WTC Odense']);
        DB::table('Team')->where('TeamNr', '=', 100)->update(['TeamCity' => 'Aalborg', 'TeamName' => 'WTC Aalborg']);
        DB::table('Team')->where('TeamNr', '=', 101)->update(['TeamCity' => 'Aarhus', 'TeamName' => 'WTC Aarhus']);
        DB::table('Team')->where('TeamNr', '=', 102)->update(['TeamCity' => 'Randers', 'TeamName' => 'WTC Randers']);
        DB::table('Team')->where('TeamNr', '=', 103)->update(['TeamCity' => 'Vejle', 'TeamName' => 'WTC Vejle']);
        DB::table('Team')->where('TeamNr', '=', 104)->update(['TeamCity' => 'Roskilde', 'TeamName' => 'WTC Roskilde']);
        DB::table('Team')->where('TeamNr', '=', 105)->update(['TeamCity' => 'Taastrup', 'TeamName' => 'WTC Taastrup']);
        DB::table('Team')->where('TeamNr', '=', 106)->update(['TeamCity' => 'Svengorg', 'TeamName' => 'WTC Svendborg']);
        DB::table('Team')->where('TeamNr', '=', 107)->update(['TeamCity' => 'Ringsted', 'TeamName' => 'WTC Ringsted']);
        DB::table('Team')->where('TeamNr', '=', 108)->update(['TeamCity' => 'Farum', 'TeamName' => 'WTC Farum']);
        DB::table('Team')->where('TeamNr', '=', 109)->update(['TeamCity' => 'Skive', 'TeamName' => 'WTC Skive']);
        DB::table('Team')->where('TeamNr', '=', 110)->update(['TeamCity' => 'Albertslund', 'TeamName' => 'WTC Alberstslund']);
        DB::table('Team')->where('TeamNr', '=', 111)->update(['TeamCity' => 'Skanderborg', 'TeamName' => 'WTC Skanderborg']);
        DB::table('Team')->where('TeamNr', '=', 112)->update(['TeamCity' => 'Kolding', 'TeamName' => 'WTC Kolding']);
        // Kamerun 113-128
        DB::table('Team')->where('TeamNr', '=', 113)->update(['TeamCity' => 'Douala', 'TeamName' => 'Victoria Doula']);
        DB::table('Team')->where('TeamNr', '=', 114)->update(['TeamCity' => 'Yaoundé', 'TeamName' => 'WTC Yaoundé']);
        DB::table('Team')->where('TeamNr', '=', 115)->update(['TeamCity' => 'Garoua', 'TeamName' => 'WTC Garoua']);
        DB::table('Team')->where('TeamNr', '=', 116)->update(['TeamCity' => 'Bamenda', 'TeamName' => 'WTC Bamenda']);
        DB::table('Team')->where('TeamNr', '=', 117)->update(['TeamCity' => 'Maroua', 'TeamName' => 'WTC Maroua']);
        DB::table('Team')->where('TeamNr', '=', 118)->update(['TeamCity' => 'Bafoussam', 'TeamName' => 'WTC Bafoussam']);
        DB::table('Team')->where('TeamNr', '=', 119)->update(['TeamCity' => 'Kumba', 'TeamName' => 'WTC Kumba']);
        DB::table('Team')->where('TeamNr', '=', 120)->update(['TeamCity' => 'Limbe', 'TeamName' => 'WTC Limbe']);
        DB::table('Team')->where('TeamNr', '=', 121)->update(['TeamCity' => 'Foumban', 'TeamName' => 'WTC Foumban']);
        DB::table('Team')->where('TeamNr', '=', 122)->update(['TeamCity' => 'Mokolo', 'TeamName' => 'WTC Mokolo']);
        DB::table('Team')->where('TeamNr', '=', 123)->update(['TeamCity' => 'Bertoua', 'TeamName' => 'WTC Bertoua']);
        DB::table('Team')->where('TeamNr', '=', 124)->update(['TeamCity' => 'Nkoteng', 'TeamName' => 'WTC Nkoteng']);
        DB::table('Team')->where('TeamNr', '=', 125)->update(['TeamCity' => 'Bafang', 'TeamName' => 'WTC Bafang']);
        DB::table('Team')->where('TeamNr', '=', 126)->update(['TeamCity' => 'Ebolowa', 'TeamName' => 'WTC Ebolowa']);
        DB::table('Team')->where('TeamNr', '=', 127)->update(['TeamCity' => 'Guider', 'TeamName' => 'WTC Guider']);
        DB::table('Team')->where('TeamNr', '=', 128)->update(['TeamCity' => 'Wum', 'TeamName' => 'WTC Wum']);
        // Brasilien 129-144
        DB::table('Team')->where('TeamNr', '=', 129)->update(['TeamCity' => 'Campinas', 'TeamName' => 'FC Campinas']);
        DB::table('Team')->where('TeamNr', '=', 130)->update(['TeamCity' => 'Brasilia', 'TeamName' => 'WTC Brasilia']);
        DB::table('Team')->where('TeamNr', '=', 131)->update(['TeamCity' => 'Belo Horizonte', 'TeamName' => 'WTC Belo Horizonte']);
        DB::table('Team')->where('TeamNr', '=', 132)->update(['TeamCity' => 'Manaus', 'TeamName' => 'WTC Manaus']);
        DB::table('Team')->where('TeamNr', '=', 133)->update(['TeamCity' => 'Natal', 'TeamName' => 'WTC Natal']);
        DB::table('Team')->where('TeamNr', '=', 134)->update(['TeamCity' => 'Porto Alegre', 'TeamName' => 'WTC Porto Alegre']);
        DB::table('Team')->where('TeamNr', '=', 135)->update(['TeamCity' => 'Joinville', 'TeamName' => 'WTC Joinville']);
        DB::table('Team')->where('TeamNr', '=', 136)->update(['TeamCity' => 'Sorocaba', 'TeamName' => 'WTC Sorocaba']);
        DB::table('Team')->where('TeamNr', '=', 137)->update(['TeamCity' => 'Curitiba', 'TeamName' => 'WTC Curitiba']);
        DB::table('Team')->where('TeamNr', '=', 138)->update(['TeamCity' => 'Bauru', 'TeamName' => 'WTC Bauru']);
        DB::table('Team')->where('TeamNr', '=', 139)->update(['TeamCity' => 'Canoas', 'TeamName' => 'WTC Canoas']);
        DB::table('Team')->where('TeamNr', '=', 140)->update(['TeamCity' => 'Blumenau', 'TeamName' => 'WTC Blumenau']);
        DB::table('Team')->where('TeamNr', '=', 141)->update(['TeamCity' => 'Uberaba', 'TeamName' => 'WTC Uberaba']);
        DB::table('Team')->where('TeamNr', '=', 142)->update(['TeamCity' => 'Caruaru', 'TeamName' => 'WTC Caruaru']);
        DB::table('Team')->where('TeamNr', '=', 143)->update(['TeamCity' => 'Volta Redonda', 'TeamName' => 'WTC Volta Redonda']);
        DB::table('Team')->where('TeamNr', '=', 144)->update(['TeamCity' => 'Rio de Janeiro', 'TeamName' => 'WTC Rio de Janeiro']);
        // Argentinien 145-160
        DB::table('Team')->where('TeamNr', '=', 145)->update(['TeamCity' => 'Rosario', 'TeamName' => 'FC Rosario']);
        DB::table('Team')->where('TeamNr', '=', 146)->update(['TeamCity' => 'Buenos Aires', 'TeamName' => 'WTC Buenos Aires']);
        DB::table('Team')->where('TeamNr', '=', 147)->update(['TeamCity' => 'La Plata', 'TeamName' => 'WTC La Plata']);
        DB::table('Team')->where('TeamNr', '=', 148)->update(['TeamCity' => 'Salta', 'TeamName' => 'WTC Salta']);
        DB::table('Team')->where('TeamNr', '=', 149)->update(['TeamCity' => 'Santa Fe', 'TeamName' => 'WTC Santa Fe']);
        DB::table('Team')->where('TeamNr', '=', 150)->update(['TeamCity' => 'Merlo', 'TeamName' => 'WTC Merlo']);
        DB::table('Team')->where('TeamNr', '=', 151)->update(['TeamCity' => 'Tigre', 'TeamName' => 'WTC Tigre']);
        DB::table('Team')->where('TeamNr', '=', 152)->update(['TeamCity' => 'Posadas', 'TeamName' => 'WTC Posadas']);
        DB::table('Team')->where('TeamNr', '=', 153)->update(['TeamCity' => 'Pilar', 'TeamName' => 'WTC Pilar']);
        DB::table('Team')->where('TeamNr', '=', 154)->update(['TeamCity' => 'Corrientes', 'TeamName' => 'WTC Corrientes']);
        DB::table('Team')->where('TeamNr', '=', 155)->update(['TeamCity' => 'Formosa', 'TeamName' => 'WTC Formosa']);
        DB::table('Team')->where('TeamNr', '=', 156)->update(['TeamCity' => 'Moreno', 'TeamName' => 'WTC Moreno']);
        DB::table('Team')->where('TeamNr', '=', 157)->update(['TeamCity' => 'Las Heras', 'TeamName' => 'WTC Las Heras']);
        DB::table('Team')->where('TeamNr', '=', 158)->update(['TeamCity' => 'Mendoza', 'TeamName' => 'WTC Mendoza']);
        DB::table('Team')->where('TeamNr', '=', 159)->update(['TeamCity' => 'Paraná', 'TeamName' => 'WTC Paraná']);
        DB::table('Team')->where('TeamNr', '=', 160)->update(['TeamCity' => 'Olavarría', 'TeamName' => 'WTC Olavarría']);
        // Australien 161-176
        DB::table('Team')->where('TeamNr', '=', 161)->update(['TeamCity' => 'Orange', 'TeamName' => 'Orange Blues']);
        DB::table('Team')->where('TeamNr', '=', 162)->update(['TeamCity' => 'Sydney', 'TeamName' => 'Sydney Snakes']);
        DB::table('Team')->where('TeamNr', '=', 163)->update(['TeamCity' => 'Brisbane', 'TeamName' => 'Brisbane Peacocks']);
        DB::table('Team')->where('TeamNr', '=', 164)->update(['TeamCity' => 'Adelaide', 'TeamName' => 'Adelaide Ants']);
        DB::table('Team')->where('TeamNr', '=', 165)->update(['TeamCity' => 'Wollongong', 'TeamName' => 'Wollongong Wasps']);
        DB::table('Team')->where('TeamNr', '=', 166)->update(['TeamCity' => 'Geelong', 'TeamName' => 'Geelong Kangaroos']);
        DB::table('Team')->where('TeamNr', '=', 167)->update(['TeamCity' => 'Darwin', 'TeamName' => 'Darwin Sharks']);
        DB::table('Team')->where('TeamNr', '=', 168)->update(['TeamCity' => 'Toowoomba', 'TeamName' => 'Toowoomba Tigers']);
        DB::table('Team')->where('TeamNr', '=', 169)->update(['TeamCity' => 'Bunbury', 'TeamName' => 'Bunbury Bears']);
        DB::table('Team')->where('TeamNr', '=', 170)->update(['TeamCity' => 'Hobart', 'TeamName' => 'Hobart Hawks']);
        DB::table('Team')->where('TeamNr', '=', 171)->update(['TeamCity' => 'Warrnambool', 'TeamName' => 'Warrnambool Vipers']);
        DB::table('Team')->where('TeamNr', '=', 172)->update(['TeamCity' => 'Sunshine Coast', 'TeamName' => 'Sunshine Coast Dolphins']);
        DB::table('Team')->where('TeamNr', '=', 173)->update(['TeamCity' => 'Bundaberg', 'TeamName' => 'Bundaberg Eagles']);
        DB::table('Team')->where('TeamNr', '=', 174)->update(['TeamCity' => 'Coffs Harbour', 'TeamName' => 'CFT Coffs Harbour']);
        DB::table('Team')->where('TeamNr', '=', 175)->update(['TeamCity' => 'Bendigo', 'TeamName' => 'FC Bendigo Monkeys']);
        DB::table('Team')->where('TeamNr', '=', 176)->update(['TeamCity' => 'Townsvile', 'TeamName' => 'TC Townsvile Rabbits']);
        // Neuseeland 177-192
        DB::table('Team')->where('TeamNr', '=', 177)->update(['TeamCity' => 'Christchurch City', 'TeamName' => 'TCC Christchurch City']);
        DB::table('Team')->where('TeamNr', '=', 178)->update(['TeamCity' => 'Wellington', 'TeamName' => 'First Wellington Wasps']);
        DB::table('Team')->where('TeamNr', '=', 179)->update(['TeamCity' => 'Wellington', 'TeamName' => 'Wellington Eagles']);
        DB::table('Team')->where('TeamNr', '=', 180)->update(['TeamCity' => 'Hamilton', 'TeamName' => 'Hamilton Hawks']);
        DB::table('Team')->where('TeamNr', '=', 181)->update(['TeamCity' => 'Dunedin', 'TeamName' => 'Dunedin Dolphins']);
        DB::table('Team')->where('TeamNr', '=', 182)->update(['TeamCity' => 'Tauranga', 'TeamName' => 'Tauranga Tigers']);
        DB::table('Team')->where('TeamNr', '=', 183)->update(['TeamCity' => 'Lower Hutt City', 'TeamName' => 'LHC Lower Hutt City']);
        DB::table('Team')->where('TeamNr', '=', 184)->update(['TeamCity' => 'Napier City', 'TeamName' => 'Napier City']);
        DB::table('Team')->where('TeamNr', '=', 185)->update(['TeamCity' => 'Porirua City', 'TeamName' => 'Porirua City']);
        DB::table('Team')->where('TeamNr', '=', 186)->update(['TeamCity' => 'Invercargill City', 'TeamName' => 'United Invercargill City']);
        DB::table('Team')->where('TeamNr', '=', 187)->update(['TeamCity' => 'Nelson', 'TeamName' => 'Nelson Owls']);
        DB::table('Team')->where('TeamNr', '=', 188)->update(['TeamCity' => 'Upper Hutt City', 'TeamName' => 'UHC Eagles']);
        DB::table('Team')->where('TeamNr', '=', 189)->update(['TeamCity' => 'Blackpool', 'TeamName' => 'Sunshine Blackpool']);
        DB::table('Team')->where('TeamNr', '=', 190)->update(['TeamCity' => 'Albany', 'TeamName' => 'Albany Ants']);
        DB::table('Team')->where('TeamNr', '=', 191)->update(['TeamCity' => 'Clarksville', 'TeamName' => 'Clarksville Crocodiles']);
        DB::table('Team')->where('TeamNr', '=', 192)->update(['TeamCity' => 'Dobson', 'TeamName' => 'Dobson Monkeys']);
        // USA 193-208
        DB::table('Team')->where('TeamNr', '=', 193)->update(['TeamCity' => 'Jacksonville', 'TeamName' => 'TVJ Jacksonville']);
        DB::table('Team')->where('TeamNr', '=', 194)->update(['TeamCity' => 'Washington', 'TeamName' => 'Washington Lions']);
        DB::table('Team')->where('TeamNr', '=', 195)->update(['TeamCity' => 'Houston', 'TeamName' => 'Houston Peacocks']);
        DB::table('Team')->where('TeamNr', '=', 196)->update(['TeamCity' => 'Phoenix', 'TeamName' => 'Phoenix Owls']);
        DB::table('Team')->where('TeamNr', '=', 197)->update(['TeamCity' => 'Dallas', 'TeamName' => 'Dallas Dolphins']);
        DB::table('Team')->where('TeamNr', '=', 198)->update(['TeamCity' => 'Seattle', 'TeamName' => 'Seattle Skunks']);
        DB::table('Team')->where('TeamNr', '=', 199)->update(['TeamCity' => 'Boston', 'TeamName' => 'Boston Rabbits']);
        DB::table('Team')->where('TeamNr', '=', 200)->update(['TeamCity' => 'Los Angeles', 'TeamName' => 'Los Angeles Wasps']);
        DB::table('Team')->where('TeamNr', '=', 201)->update(['TeamCity' => 'Detroit', 'TeamName' => 'Detroit Snakes']);
        DB::table('Team')->where('TeamNr', '=', 202)->update(['TeamCity' => 'Baltimore', 'TeamName' => 'Baltimore Bulls']);
        DB::table('Team')->where('TeamNr', '=', 203)->update(['TeamCity' => 'Sacramento', 'TeamName' => 'Sacramento Tigers']);
        DB::table('Team')->where('TeamNr', '=', 204)->update(['TeamCity' => 'Atlanta', 'TeamName' => 'Atlanta Hawks']);
        DB::table('Team')->where('TeamNr', '=', 205)->update(['TeamCity' => 'Laredo', 'TeamName' => 'Laredo Snails']);
        DB::table('Team')->where('TeamNr', '=', 206)->update(['TeamCity' => 'Tuscon', 'TeamName' => 'Tuscon Cowboys']);
        DB::table('Team')->where('TeamNr', '=', 207)->update(['TeamCity' => 'Huntsville', 'TeamName' => 'WTC Huntsville']);
        DB::table('Team')->where('TeamNr', '=', 208)->update(['TeamCity' => 'Kansas City', 'TeamName' => 'WTC Kansas City']);
        // Mexiko 209-224
        DB::table('Team')->where('TeamNr', '=', 209)->update(['TeamCity' => 'Tijuana', 'TeamName' => 'FC Tijuana']);
        DB::table('Team')->where('TeamNr', '=', 210)->update(['TeamCity' => 'Mexiko-Stadt', 'TeamName' => 'WTC Mexiko-Stadt']);
        DB::table('Team')->where('TeamNr', '=', 211)->update(['TeamCity' => 'Guadalajara', 'TeamName' => 'WTC Guadalajara']);
        DB::table('Team')->where('TeamNr', '=', 212)->update(['TeamCity' => 'Puebla', 'TeamName' => 'WTC Puebla']);
        DB::table('Team')->where('TeamNr', '=', 213)->update(['TeamCity' => 'Zapopan', 'TeamName' => 'WTC Zapopan']);
        DB::table('Team')->where('TeamNr', '=', 214)->update(['TeamCity' => 'Morelia', 'TeamName' => 'WTC Morelia']);
        DB::table('Team')->where('TeamNr', '=', 215)->update(['TeamCity' => 'Monterrey', 'TeamName' => 'WTC Monterrey']);
        DB::table('Team')->where('TeamNr', '=', 216)->update(['TeamCity' => 'Saltillo', 'TeamName' => 'WTC Saltillo']);
        DB::table('Team')->where('TeamNr', '=', 217)->update(['TeamCity' => 'Mexicali', 'TeamName' => 'WTC Mexicali']);
        DB::table('Team')->where('TeamNr', '=', 218)->update(['TeamCity' => 'Veracriu', 'TeamName' => 'WTC Veracruz']);
        DB::table('Team')->where('TeamNr', '=', 219)->update(['TeamCity' => 'Reynosa', 'TeamName' => 'WTC Reynosa']);
        DB::table('Team')->where('TeamNr', '=', 220)->update(['TeamCity' => 'Hermosillo', 'TeamName' => 'WTC Hermosillo']);
        DB::table('Team')->where('TeamNr', '=', 221)->update(['TeamCity' => 'Ciudad Juárez', 'TeamName' => 'WTC Ciudad Juárez']);
        DB::table('Team')->where('TeamNr', '=', 222)->update(['TeamCity' => 'Ecatepec de Morelos', 'TeamName' => 'WTC Ecatepec de Morelos']);
        DB::table('Team')->where('TeamNr', '=', 223)->update(['TeamCity' => 'Tampico', 'TeamName' => 'WTC Tampico']);
        DB::table('Team')->where('TeamNr', '=', 224)->update(['TeamCity' => 'Tapachula', 'TeamName' => 'WTC Tapachula']);
        // Kanada 225-240
        DB::table('Team')->where('TeamNr', '=', 225)->update(['TeamCity' => 'Winnipeg', 'TeamName' => 'TC Winnipeg Bulls']);
        DB::table('Team')->where('TeamNr', '=', 226)->update(['TeamCity' => 'Ottawa', 'TeamName' => 'WTC Ottawa']);
        DB::table('Team')->where('TeamNr', '=', 227)->update(['TeamCity' => 'Vancouver', 'TeamName' => 'WTC Vancouver']);
        DB::table('Team')->where('TeamNr', '=', 228)->update(['TeamCity' => 'Montreal', 'TeamName' => 'Montreal Pelicans']);
        DB::table('Team')->where('TeamNr', '=', 229)->update(['TeamCity' => 'Victoria', 'TeamName' => 'WTC Victoria']);
        DB::table('Team')->where('TeamNr', '=', 230)->update(['TeamCity' => 'Windsor', 'TeamName' => 'WTC Windsor']);
        DB::table('Team')->where('TeamNr', '=', 231)->update(['TeamCity' => 'Saskatoon', 'TeamName' => 'Saskatoon Devils']);
        DB::table('Team')->where('TeamNr', '=', 232)->update(['TeamCity' => 'Calgary', 'TeamName' => 'Calgary Crocodiles']);
        DB::table('Team')->where('TeamNr', '=', 233)->update(['TeamCity' => 'Edmonton', 'TeamName' => 'Edmonton Hawks']);
        DB::table('Team')->where('TeamNr', '=', 234)->update(['TeamCity' => 'Barrie', 'TeamName' => 'Barrie Bears']);
        DB::table('Team')->where('TeamNr', '=', 235)->update(['TeamCity' => 'Red Deer', 'TeamName' => 'Red Deer Devils']);
        DB::table('Team')->where('TeamNr', '=', 236)->update(['TeamCity' => 'Brantford', 'TeamName' => 'Brantford Bears']);
        DB::table('Team')->where('TeamNr', '=', 237)->update(['TeamCity' => 'Lethbridge', 'TeamName' => 'Lethbridge Lions']);
        DB::table('Team')->where('TeamNr', '=', 238)->update(['TeamCity' => 'Kingston', 'TeamName' => 'Kingston Monkeys']);
        DB::table('Team')->where('TeamNr', '=', 239)->update(['TeamCity' => 'North Bay', 'TeamName' => 'North Bay']);
        DB::table('Team')->where('TeamNr', '=', 240)->update(['TeamCity' => 'Belleville', 'TeamName' => 'Belleville']);
        // Chile 241-256
        DB::table('Team')->where('TeamNr', '=', 241)->update(['TeamCity' => 'Valparaíso', 'TeamName' => 'Victoria  Valparaíso']);
        DB::table('Team')->where('TeamNr', '=', 242)->update(['TeamCity' => 'Santiago de Chile', 'TeamName' => 'Real Santiago de Chile']);
        DB::table('Team')->where('TeamNr', '=', 243)->update(['TeamCity' => 'Talca', 'TeamName' => 'WTC Talca']);
        DB::table('Team')->where('TeamNr', '=', 244)->update(['TeamCity' => 'La Serena', 'TeamName' => 'Real La Serena']);
        DB::table('Team')->where('TeamNr', '=', 245)->update(['TeamCity' => 'Puente Alto', 'TeamName' => 'WTC Puente Alto']);
        DB::table('Team')->where('TeamNr', '=', 246)->update(['TeamCity' => 'San Bernardo', 'TeamName' => 'Real San Bernardo']);
        DB::table('Team')->where('TeamNr', '=', 247)->update(['TeamCity' => 'Antofagasta', 'TeamName' => 'WTC Antofagasta']);
        DB::table('Team')->where('TeamNr', '=', 248)->update(['TeamCity' => 'Linares', 'TeamName' => 'WTC Linares']);
        DB::table('Team')->where('TeamNr', '=', 249)->update(['TeamCity' => 'Coronel', 'TeamName' => 'WTC Coronel']);
        DB::table('Team')->where('TeamNr', '=', 250)->update(['TeamCity' => 'Ovalle', 'TeamName' => 'WTC Ovalle']);
        DB::table('Team')->where('TeamNr', '=', 251)->update(['TeamCity' => 'Penco', 'TeamName' => 'WTC Penco']);
        DB::table('Team')->where('TeamNr', '=', 252)->update(['TeamCity' => 'Vallenar', 'TeamName' => 'WTC Vallenar']);
        DB::table('Team')->where('TeamNr', '=', 253)->update(['TeamCity' => 'Lota', 'TeamName' => 'WTC Lota']);
        DB::table('Team')->where('TeamNr', '=', 254)->update(['TeamCity' => 'Angol', 'TeamName' => 'WTC Angol']);
        DB::table('Team')->where('TeamNr', '=', 255)->update(['TeamCity' => 'San Felipe', 'TeamName' => 'Real San Felipe']);
        DB::table('Team')->where('TeamNr', '=', 256)->update(['TeamCity' => 'San Antonio', 'TeamName' => 'Real San Antonio']);
        //
        for ($i = 17; $i <= 256; $i++) {
            $team = DB::table('Team')->where('TeamNr', '=', $i)->first();
            $teamname = $team->TeamName;
            //
            $club = ermittle_Club(random_int(1, 10));
            $teamname_neu = str_replace("WTC", $club, $teamname);
            //
            $update = DB::table('Team')->where('TeamNr', '=', $i)->update(['TeamName' => $teamname_neu]);
        }
        // Passe einige Teams an
        // Alle Team mit 1 + i mal 16 (17,33,49,...)
        $update = DB::table('Team')->where('TeamNr', '=', 1)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 17)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 33)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 49)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 65)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 81)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 97)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 113)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 129)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 145)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 161)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 177)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 193)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 209)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 225)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
        $update = DB::table('Team')->where('TeamNr', '=', 241)->update(['TmAlg_Spiel' => 1, 'TmAlg_Kauf' => 4]);
    }
}
//
class PlayerTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Player')->insert([
            'PlayerNr' => 1,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Leo Lehmann',
            'PlayerVorName' => 'Leo',
            'PlayerNachName' => 'Lehmann',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 1,
            'PzugTypNr' => 1,
        ]);
        DB::table('Player')->insert([
            'PlayerNr' => 2,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Stephan Schumacher',
            'PlayerVorName' => 'Stephan',
            'PlayerNachName' => 'Schumacher',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 2,
            'PzugTypNr' => 2,
        ]);
        DB::table('Player')->insert([
            'PlayerNr' => 3,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Volker Vollack',
            'PlayerVorName' => 'Volker',
            'PlayerNachName' => 'Vollack',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 3,
            'PzugTypNr' => 2,
        ]);
        DB::table('Player')->insert([
            'PlayerNr' => 4,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Gerd Gehrke',
            'PlayerVorName' => 'Gerd',
            'PlayerNachName' => 'Gehrke',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 4,
            'PzugTypNr' => 2,
        ]);
        DB::table('Player')->insert([
            'PlayerNr' => 5,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Ben Burdenski',
            'PlayerVorName' => 'Ben',
            'PlayerNachName' => 'Burdenski',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 5,
            'PzugTypNr' => 2,
        ]);
        DB::table('Player')->insert([
            'PlayerNr' => 6,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Mio Mutibaric',
            'PlayerVorName' => 'Mio',
            'PlayerNachName' => 'Mutibaric',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 6,
            'PzugTypNr' => 2,
        ]);
        DB::table('Player')->insert([
            'PlayerNr' => 7,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Sven Schober',
            'PlayerVorName' => 'Sven',
            'PlayerNachName' => 'Schober',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 7,
            'PzugTypNr' => 4,
        ]);
        DB::table('Player')->insert([
            'PlayerNr' => 8,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Goran Groß',
            'PlayerVorName' => 'Goran',
            'PlayerNachName' => 'Groß',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 8,
            'PzugTypNr' => 3,
        ]);
        DB::table('Player')->insert([
            'PlayerNr' => 9,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Oliver Nigbur',
            'PlayerVorName' => 'Oliver',
            'PlayerNachName' => 'Nigbur',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 9,
            'PzugTypNr' => 4,
        ]);
        DB::table('Player')->insert([
            'PlayerNr' => 10,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Sam Sandhofe',
            'PlayerVorName' => 'Sam',
            'PlayerNachName' => 'Sandhofe',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 10,
            'PzugTypNr' => 3,
        ]);
        DB::table('Player')->insert([
            'PlayerNr' => 11,
            'PzugTeamNr' => 1,
            'PlayerName' => 'Johnny Junghans',
            'PlayerVorName' => 'Johnny',
            'PlayerNachName' => 'Junghans',
            'PlayerMailadresse' => null,
            'PlayerTrikotNr' => 11,
            'PzugTypNr' => 4,
        ]);
        //
        $faker = Faker\Factory::create();
        for ($i = 2; $i <= 256; $i++) {
            for ($j = 1; $j <= 11; $j++) {
                $k = (($i - 1) * 11) + $j;
                // ermittle typ (PzugTypNr)
                $typ = 0;
                if ($j == 1) {
                    $typ = 1;
                }
                if ($j >= 1 and $j <= 6) {
                    $typ = 2;
                }
                if ($j == 7) {
                    $typ = 4;
                }
                if ($j == 8) {
                    $typ = 3;
                }
                if ($j == 9) {
                    $typ = 4;
                }
                if ($j == 10) {
                    $typ = 3;
                }
                if ($j == 11) {
                    $typ = 4;
                }
                // ermittle PlayerName
                $landnr = intval(($i - 1) / 16) + 1;
                $startnr = 1;
                $endenr = 5065;
                //
                if ($landnr > 1) {
                    $startnr = 5066 + ($landnr - 2) * 200;
                    $endenr = $startnr + 200;
                }
                //
                $vorname = $faker->firstNameMale;
                $nachname = $faker->lastName;
                //
                $name = $vorname . ' ' . $nachname;
                //
                DB::table('Player')->insert([
                    'PlayerNr' => $k,
                    'PzugTeamNr' => $i,
                    'PlayerName' => $name,
                    'PlayerVorName' => $vorname,
                    'PlayerNachName' => $nachname,
                    'PlayerMailadresse' => '',
                    'PlayerTrikotNr' => $j,
                    'PzugTypNr' => $typ,
                ]);
            }
        }
    }
}
//
class SaisonTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Saison')->insert([
            'SaisonNr' => 1,
            'SaisonName' => '1. Saison',
        ]);
    }
}
//
class SpieltypTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 1,
            'SpielTypName' => '1.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 2,
            'SpielTypName' => '2.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 3,
            'SpielTypName' => '3.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 4,
            'SpielTypName' => '4.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 5,
            'SpielTypName' => '5.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 6,
            'SpielTypName' => '6.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 7,
            'SpielTypName' => '7.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 8,
            'SpielTypName' => '8.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 9,
            'SpielTypName' => '9.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 10,
            'SpielTypName' => '10.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 11,
            'SpielTypName' => '11.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 12,
            'SpielTypName' => '12.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 13,
            'SpielTypName' => '13.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 14,
            'SpielTypName' => '14.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 15,
            'SpielTypName' => '15.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 16,
            'SpielTypName' => '16.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 17,
            'SpielTypName' => '17.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 18,
            'SpielTypName' => '18.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 19,
            'SpielTypName' => '19.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 20,
            'SpielTypName' => '20.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 21,
            'SpielTypName' => '21.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 22,
            'SpielTypName' => '22.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 23,
            'SpielTypName' => '23.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 24,
            'SpielTypName' => '24.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 25,
            'SpielTypName' => '25.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 26,
            'SpielTypName' => '26.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 27,
            'SpielTypName' => '27.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 28,
            'SpielTypName' => '28.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 29,
            'SpielTypName' => '29.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 30,
            'SpielTypName' => '30.-ter Spieltag',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 101,
            'SpielTypName' => '1. Runde Pokal-Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 102,
            'SpielTypName' => '1. Runde Pokal-Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 103,
            'SpielTypName' => '2. Runde Pokal-Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 104,
            'SpielTypName' => '2. Runde Pokal-Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 105,
            'SpielTypName' => '3. Runde Pokal-Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 106,
            'SpielTypName' => '3. Runde Pokal-Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 107,
            'SpielTypName' => '4. Runde Pokal-Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 108,
            'SpielTypName' => '4. Runde Pokal-Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 109,
            'SpielTypName' => '5. Runde Pokal-Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 110,
            'SpielTypName' => '5. Runde Pokal-Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 111,
            'SpielTypName' => 'Pokal-Viertelfinale Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 112,
            'SpielTypName' => 'Pokal-Viertelfinale Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 113,
            'SpielTypName' => 'Pokal-Halbfinale Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 114,
            'SpielTypName' => 'Pokal-Halbfinale Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 115,
            'SpielTypName' => 'Pokal-Finale Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 116,
            'SpielTypName' => 'Pokal-Finale Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 201,
            'SpielTypName' => 'WM-Achtelfinale Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 202,
            'SpielTypName' => 'WM-Achtelfinale Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 203,
            'SpielTypName' => 'WM-Viertelfinale Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 204,
            'SpielTypName' => 'WM-Viertelfinale Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 205,
            'SpielTypName' => 'WM-Halbfinale Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 206,
            'SpielTypName' => 'WM-Halbfinale Rückspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 207,
            'SpielTypName' => 'WM-Finale Hinspiel',
        ]);
        DB::table('SpielTyp')->insert([
            'SpielTypNr' => 208,
            'SpielTypName' => 'WM-Finale Rückspiel',
        ]);
    }
}
//
class SpielplanTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 1,
            'SpieltagNr' => 1,
            'HeimNr' => 1,
            'GastNr' => 16,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 2,
            'SpieltagNr' => 1,
            'HeimNr' => 2,
            'GastNr' => 15,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 3,
            'SpieltagNr' => 1,
            'HeimNr' => 14,
            'GastNr' => 3,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 4,
            'SpieltagNr' => 1,
            'HeimNr' => 13,
            'GastNr' => 4,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 5,
            'SpieltagNr' => 1,
            'HeimNr' => 12,
            'GastNr' => 5,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 6,
            'SpieltagNr' => 1,
            'HeimNr' => 11,
            'GastNr' => 6,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 7,
            'SpieltagNr' => 1,
            'HeimNr' => 10,
            'GastNr' => 7,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 8,
            'SpieltagNr' => 1,
            'HeimNr' => 8,
            'GastNr' => 9,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 9,
            'SpieltagNr' => 2,
            'HeimNr' => 16,
            'GastNr' => 2,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 10,
            'SpieltagNr' => 2,
            'HeimNr' => 3,
            'GastNr' => 1,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 11,
            'SpieltagNr' => 2,
            'HeimNr' => 4,
            'GastNr' => 15,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 12,
            'SpieltagNr' => 2,
            'HeimNr' => 5,
            'GastNr' => 14,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 13,
            'SpieltagNr' => 2,
            'HeimNr' => 6,
            'GastNr' => 13,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 14,
            'SpieltagNr' => 2,
            'HeimNr' => 7,
            'GastNr' => 12,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 15,
            'SpieltagNr' => 2,
            'HeimNr' => 8,
            'GastNr' => 11,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 16,
            'SpieltagNr' => 2,
            'HeimNr' => 9,
            'GastNr' => 10,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 17,
            'SpieltagNr' => 3,
            'HeimNr' => 3,
            'GastNr' => 16,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 18,
            'SpieltagNr' => 3,
            'HeimNr' => 2,
            'GastNr' => 4,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 19,
            'SpieltagNr' => 3,
            'HeimNr' => 1,
            'GastNr' => 5,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 20,
            'SpieltagNr' => 3,
            'HeimNr' => 15,
            'GastNr' => 6,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 21,
            'SpieltagNr' => 3,
            'HeimNr' => 14,
            'GastNr' => 7,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 22,
            'SpieltagNr' => 3,
            'HeimNr' => 13,
            'GastNr' => 8,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 23,
            'SpieltagNr' => 3,
            'HeimNr' => 12,
            'GastNr' => 9,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 24,
            'SpieltagNr' => 3,
            'HeimNr' => 10,
            'GastNr' => 11,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 25,
            'SpieltagNr' => 4,
            'HeimNr' => 16,
            'GastNr' => 4,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 26,
            'SpieltagNr' => 4,
            'HeimNr' => 5,
            'GastNr' => 3,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 27,
            'SpieltagNr' => 4,
            'HeimNr' => 6,
            'GastNr' => 2,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 28,
            'SpieltagNr' => 4,
            'HeimNr' => 7,
            'GastNr' => 1,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 29,
            'SpieltagNr' => 4,
            'HeimNr' => 8,
            'GastNr' => 15,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 30,
            'SpieltagNr' => 4,
            'HeimNr' => 9,
            'GastNr' => 14,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 31,
            'SpieltagNr' => 4,
            'HeimNr' => 10,
            'GastNr' => 13,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 32,
            'SpieltagNr' => 4,
            'HeimNr' => 11,
            'GastNr' => 12,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 33,
            'SpieltagNr' => 5,
            'HeimNr' => 5,
            'GastNr' => 16,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 34,
            'SpieltagNr' => 5,
            'HeimNr' => 4,
            'GastNr' => 6,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 35,
            'SpieltagNr' => 5,
            'HeimNr' => 3,
            'GastNr' => 7,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 36,
            'SpieltagNr' => 5,
            'HeimNr' => 2,
            'GastNr' => 8,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 37,
            'SpieltagNr' => 5,
            'HeimNr' => 1,
            'GastNr' => 9,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 38,
            'SpieltagNr' => 5,
            'HeimNr' => 15,
            'GastNr' => 10,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 39,
            'SpieltagNr' => 5,
            'HeimNr' => 14,
            'GastNr' => 11,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 40,
            'SpieltagNr' => 5,
            'HeimNr' => 12,
            'GastNr' => 13,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 41,
            'SpieltagNr' => 6,
            'HeimNr' => 16,
            'GastNr' => 6,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 42,
            'SpieltagNr' => 6,
            'HeimNr' => 7,
            'GastNr' => 5,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 43,
            'SpieltagNr' => 6,
            'HeimNr' => 8,
            'GastNr' => 4,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 44,
            'SpieltagNr' => 6,
            'HeimNr' => 9,
            'GastNr' => 3,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 45,
            'SpieltagNr' => 6,
            'HeimNr' => 10,
            'GastNr' => 2,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 46,
            'SpieltagNr' => 6,
            'HeimNr' => 11,
            'GastNr' => 1,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 47,
            'SpieltagNr' => 6,
            'HeimNr' => 12,
            'GastNr' => 15,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 48,
            'SpieltagNr' => 6,
            'HeimNr' => 13,
            'GastNr' => 14,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 49,
            'SpieltagNr' => 7,
            'HeimNr' => 7,
            'GastNr' => 16,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 50,
            'SpieltagNr' => 7,
            'HeimNr' => 6,
            'GastNr' => 8,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 51,
            'SpieltagNr' => 7,
            'HeimNr' => 5,
            'GastNr' => 9,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 52,
            'SpieltagNr' => 7,
            'HeimNr' => 4,
            'GastNr' => 10,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 53,
            'SpieltagNr' => 7,
            'HeimNr' => 3,
            'GastNr' => 11,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 54,
            'SpieltagNr' => 7,
            'HeimNr' => 2,
            'GastNr' => 12,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 55,
            'SpieltagNr' => 7,
            'HeimNr' => 1,
            'GastNr' => 13,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 56,
            'SpieltagNr' => 7,
            'HeimNr' => 14,
            'GastNr' => 15,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 57,
            'SpieltagNr' => 8,
            'HeimNr' => 16,
            'GastNr' => 8,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 58,
            'SpieltagNr' => 8,
            'HeimNr' => 9,
            'GastNr' => 7,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 59,
            'SpieltagNr' => 8,
            'HeimNr' => 10,
            'GastNr' => 6,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 60,
            'SpieltagNr' => 8,
            'HeimNr' => 11,
            'GastNr' => 5,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 61,
            'SpieltagNr' => 8,
            'HeimNr' => 12,
            'GastNr' => 4,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 62,
            'SpieltagNr' => 8,
            'HeimNr' => 13,
            'GastNr' => 3,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 63,
            'SpieltagNr' => 8,
            'HeimNr' => 14,
            'GastNr' => 2,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 64,
            'SpieltagNr' => 8,
            'HeimNr' => 15,
            'GastNr' => 1,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 65,
            'SpieltagNr' => 9,
            'HeimNr' => 9,
            'GastNr' => 16,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 66,
            'SpieltagNr' => 9,
            'HeimNr' => 8,
            'GastNr' => 10,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 67,
            'SpieltagNr' => 9,
            'HeimNr' => 7,
            'GastNr' => 11,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 68,
            'SpieltagNr' => 9,
            'HeimNr' => 6,
            'GastNr' => 12,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 69,
            'SpieltagNr' => 9,
            'HeimNr' => 5,
            'GastNr' => 13,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 70,
            'SpieltagNr' => 9,
            'HeimNr' => 4,
            'GastNr' => 14,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 71,
            'SpieltagNr' => 9,
            'HeimNr' => 3,
            'GastNr' => 15,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 72,
            'SpieltagNr' => 9,
            'HeimNr' => 1,
            'GastNr' => 2,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 73,
            'SpieltagNr' => 10,
            'HeimNr' => 16,
            'GastNr' => 10,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 74,
            'SpieltagNr' => 10,
            'HeimNr' => 11,
            'GastNr' => 9,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 75,
            'SpieltagNr' => 10,
            'HeimNr' => 12,
            'GastNr' => 8,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 76,
            'SpieltagNr' => 10,
            'HeimNr' => 13,
            'GastNr' => 7,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 77,
            'SpieltagNr' => 10,
            'HeimNr' => 14,
            'GastNr' => 6,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 78,
            'SpieltagNr' => 10,
            'HeimNr' => 15,
            'GastNr' => 5,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 79,
            'SpieltagNr' => 10,
            'HeimNr' => 4,
            'GastNr' => 1,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 80,
            'SpieltagNr' => 10,
            'HeimNr' => 2,
            'GastNr' => 3,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 81,
            'SpieltagNr' => 11,
            'HeimNr' => 11,
            'GastNr' => 16,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 82,
            'SpieltagNr' => 11,
            'HeimNr' => 10,
            'GastNr' => 12,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 83,
            'SpieltagNr' => 11,
            'HeimNr' => 9,
            'GastNr' => 13,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 84,
            'SpieltagNr' => 11,
            'HeimNr' => 8,
            'GastNr' => 14,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 85,
            'SpieltagNr' => 11,
            'HeimNr' => 7,
            'GastNr' => 15,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 86,
            'SpieltagNr' => 11,
            'HeimNr' => 1,
            'GastNr' => 6,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 87,
            'SpieltagNr' => 11,
            'HeimNr' => 5,
            'GastNr' => 2,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 88,
            'SpieltagNr' => 11,
            'HeimNr' => 3,
            'GastNr' => 4,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 89,
            'SpieltagNr' => 12,
            'HeimNr' => 16,
            'GastNr' => 12,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 90,
            'SpieltagNr' => 12,
            'HeimNr' => 13,
            'GastNr' => 11,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 91,
            'SpieltagNr' => 12,
            'HeimNr' => 14,
            'GastNr' => 10,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 92,
            'SpieltagNr' => 12,
            'HeimNr' => 15,
            'GastNr' => 9,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 93,
            'SpieltagNr' => 12,
            'HeimNr' => 8,
            'GastNr' => 1,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 94,
            'SpieltagNr' => 12,
            'HeimNr' => 2,
            'GastNr' => 7,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 95,
            'SpieltagNr' => 12,
            'HeimNr' => 6,
            'GastNr' => 3,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 96,
            'SpieltagNr' => 12,
            'HeimNr' => 4,
            'GastNr' => 5,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 97,
            'SpieltagNr' => 13,
            'HeimNr' => 13,
            'GastNr' => 16,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 98,
            'SpieltagNr' => 13,
            'HeimNr' => 12,
            'GastNr' => 14,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 99,
            'SpieltagNr' => 13,
            'HeimNr' => 11,
            'GastNr' => 15,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 100,
            'SpieltagNr' => 13,
            'HeimNr' => 1,
            'GastNr' => 10,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 101,
            'SpieltagNr' => 13,
            'HeimNr' => 9,
            'GastNr' => 2,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 102,
            'SpieltagNr' => 13,
            'HeimNr' => 3,
            'GastNr' => 8,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 103,
            'SpieltagNr' => 13,
            'HeimNr' => 7,
            'GastNr' => 4,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 104,
            'SpieltagNr' => 13,
            'HeimNr' => 5,
            'GastNr' => 6,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 105,
            'SpieltagNr' => 14,
            'HeimNr' => 16,
            'GastNr' => 14,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 106,
            'SpieltagNr' => 14,
            'HeimNr' => 15,
            'GastNr' => 13,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 107,
            'SpieltagNr' => 14,
            'HeimNr' => 12,
            'GastNr' => 1,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 108,
            'SpieltagNr' => 14,
            'HeimNr' => 2,
            'GastNr' => 11,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 109,
            'SpieltagNr' => 14,
            'HeimNr' => 10,
            'GastNr' => 3,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 110,
            'SpieltagNr' => 14,
            'HeimNr' => 4,
            'GastNr' => 9,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 111,
            'SpieltagNr' => 14,
            'HeimNr' => 8,
            'GastNr' => 5,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 112,
            'SpieltagNr' => 14,
            'HeimNr' => 6,
            'GastNr' => 7,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 113,
            'SpieltagNr' => 15,
            'HeimNr' => 16,
            'GastNr' => 15,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 114,
            'SpieltagNr' => 15,
            'HeimNr' => 14,
            'GastNr' => 1,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 115,
            'SpieltagNr' => 15,
            'HeimNr' => 13,
            'GastNr' => 2,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 116,
            'SpieltagNr' => 15,
            'HeimNr' => 3,
            'GastNr' => 12,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 117,
            'SpieltagNr' => 15,
            'HeimNr' => 11,
            'GastNr' => 4,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 118,
            'SpieltagNr' => 15,
            'HeimNr' => 5,
            'GastNr' => 10,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 119,
            'SpieltagNr' => 15,
            'HeimNr' => 9,
            'GastNr' => 6,
        ]);
        DB::table('Spielplan')->insert([
            'SpielplanNr' => 120,
            'SpieltagNr' => 15,
            'HeimNr' => 7,
            'GastNr' => 8,
        ]);
    }
}
//
class LandTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Land')->insert([
            'LandNr' => 1,
            'LandName' => 'Deutschland',
            'LandChannelKZ' => false,
            'LandChannelID' => '-1001302226403'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 2,
            'LandName' => 'Italien'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 3,
            'LandName' => 'Frankreich'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 4,
            'LandName' => 'England'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 5,
            'LandName' => 'Spanien'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 6,
            'LandName' => 'Niederlande'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 7,
            'LandName' => 'Dänemark'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 8,
            'LandName' => 'Kamerun'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 9,
            'LandName' => 'Brasilien'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 10,
            'LandName' => 'Argentinien'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 11,
            'LandName' => 'Australien'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 12,
            'LandName' => 'Neuseeland'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 13,
            'LandName' => 'USA'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 14,
            'LandName' => 'Mexiko'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 15,
            'LandName' => 'Kanada'
        ]);
        DB::table('Land')->insert([
            'LandNr' => 16,
            'LandName' => 'Chile'
        ]);
    }
}
class AuslosungTabelleSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 256; $i++) {
            $zw1 = random_int(1, 10000);
            //
            DB::table('AuslosungTabelle')->insert([
                'ATNr' => $i,
                'ATZufallszahl' => $zw1
            ]);
        }
    }
}
class AktionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Aktion')->insert([
            'ANr' => 1,
            'AzugSpieltypNr' => 0,
            'AName' => 'Saisonanfang',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 2,
            'AzugSpieltypNr' => 1,
            'AName' => '1. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 3,
            'AzugSpieltypNr' => 2,
            'AName' => '2. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 4,
            'AzugSpieltypNr' => 3,
            'AName' => '3. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 5,
            'AzugSpieltypNr' => 4,
            'AName' => '4. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 6,
            'AzugSpieltypNr' => 5,
            'AName' => '5. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 7,
            'AzugSpieltypNr' => 6,
            'AName' => '6. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 8,
            'AzugSpieltypNr' => 101,
            'AName' => '1. Runde Pokal-Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 9,
            'AzugSpieltypNr' => 7,
            'AName' => '7. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 10,
            'AzugSpieltypNr' => 102,
            'AName' => '1. Runde Pokal-Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 11,
            'AzugSpieltypNr' => 8,
            'AName' => '8. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 12,
            'AzugSpieltypNr' => 9,
            'AName' => '9. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 13,
            'AzugSpieltypNr' => 103,
            'AName' => '2. Runde Pokal-Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 14,
            'AzugSpieltypNr' => 10,
            'AName' => '10. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 15,
            'AzugSpieltypNr' => 104,
            'AName' => '2. Runde Pokal-Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 16,
            'AzugSpieltypNr' => 11,
            'AName' => '11. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 17,
            'AzugSpieltypNr' => 12,
            'AName' => '12. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 18,
            'AzugSpieltypNr' => 13,
            'AName' => '13. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 19,
            'AzugSpieltypNr' => 105,
            'AName' => '3. Runde Pokal-Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 20,
            'AzugSpieltypNr' => 14,
            'AName' => '14. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 21,
            'AzugSpieltypNr' => 106,
            'AName' => '3. Runde Pokal-Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 22,
            'AzugSpieltypNr' => 15,
            'AName' => '15. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 23,
            'AzugSpieltypNr' => 16,
            'AName' => '16. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 24,
            'AzugSpieltypNr' => 107,
            'AName' => '4. Runde Pokal-Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 25,
            'AzugSpieltypNr' => 17,
            'AName' => '17. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 26,
            'AzugSpieltypNr' => 108,
            'AName' => '4. Runde Pokal-Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 27,
            'AzugSpieltypNr' => 18,
            'AName' => '18. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 28,
            'AzugSpieltypNr' => 19,
            'AName' => '19. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 29,
            'AzugSpieltypNr' => 109,
            'AName' => '5. Runde Pokal-Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 30,
            'AzugSpieltypNr' => 20,
            'AName' => '20. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 31,
            'AzugSpieltypNr' => 110,
            'AName' => '5. Runde Pokal-Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 32,
            'AzugSpieltypNr' => 21,
            'AName' => '21. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 33,
            'AzugSpieltypNr' => 22,
            'AName' => '22. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 34,
            'AzugSpieltypNr' => 111,
            'AName' => '6. Runde Pokal-Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 35,
            'AzugSpieltypNr' => 23,
            'AName' => '23. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 36,
            'AzugSpieltypNr' => 112,
            'AName' => '6. Runde Pokal-Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 37,
            'AzugSpieltypNr' => 24,
            'AName' => '24. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 38,
            'AzugSpieltypNr' => 25,
            'AName' => '25. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 39,
            'AzugSpieltypNr' => 113,
            'AName' => 'Pokalhalbfinal-Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 40,
            'AzugSpieltypNr' => 26,
            'AName' => '26. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 41,
            'AzugSpieltypNr' => 114,
            'AName' => 'Pokalhalbfinal-Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 42,
            'AzugSpieltypNr' => 27,
            'AName' => '27. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 43,
            'AzugSpieltypNr' => 28,
            'AName' => '28. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 44,
            'AzugSpieltypNr' => 115,
            'AName' => 'Pokalfinal-Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 45,
            'AzugSpieltypNr' => 29,
            'AName' => '29. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 46,
            'AzugSpieltypNr' => 116,
            'AName' => 'Pokalfinal-Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 47,
            'AzugSpieltypNr' => 30,
            'AName' => '30. Spieltag',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 48,
            'AzugSpieltypNr' => 0,
            'AName' => 'Saisonende',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 49,
            'AzugSpieltypNr' => 0,
            'AName' => 'WM-Auslosung',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 50,
            'AzugSpieltypNr' => 201,
            'AName' => 'WM-Achtelfinale Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 51,
            'AzugSpieltypNr' => 202,
            'AName' => 'WM-Achtelfinale Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 52,
            'AzugSpieltypNr' => 203,
            'AName' => 'WM-Viertelfinale Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 53,
            'AzugSpieltypNr' => 204,
            'AName' => 'WM-Viertelfinale Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 54,
            'AzugSpieltypNr' => 205,
            'AName' => 'WM-Halbfinale Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 55,
            'AzugSpieltypNr' => 206,
            'AName' => 'WM-Halbfinale Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 56,
            'AzugSpieltypNr' => 207,
            'AName' => 'WM-Finale Hinspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 57,
            'AzugSpieltypNr' => 208,
            'AName' => 'WM-Finale Rückspiel',
        ]);
        DB::table('Aktion')->insert([
            'ANr' => 58,
            'AzugSpieltypNr' => 0,
            'AName' => 'WM-Ende',
        ]);
    }
}

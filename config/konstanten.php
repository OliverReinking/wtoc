<?php

return array(
    'wtoc_version'                      => '3.0.0',
    'wtoc_aktuellesjahr'                => '2021',
    //
    'ereignis_spielpaarung'             => 1,
    'ereignis_heim_aufstellung'         => 2,
    'ereignis_gast_aufstellung'         => 3,
    'ereignis_torchance_heim'           => 11,
    'ereignis_torchance_vergeben_heim'  => 12,
    'ereignis_tor_erzielt_heim'         => 13,
    'ereignis_torchance_gast'           => 21,
    'ereignis_torchance_vergeben_gast'  => 22,
    'ereignis_tor_erzielt_gast'         => 23,
    'ereignis_verletzung_heim'          => 31,
    'ereignis_verletzung_gast'          => 41,
    'ereignis_endergebnis'              => 51,
    //
    'telegram' => [
        'eingeschaltet' => false,
        'api_token' => env('TELEGRAM_API_TOKEN', 'unbekannt'),
        'bot_username' => env('TELEGRAM_BOT_USERNAME', 'unbekannt'),
        'channel_username' => env('TELEGRAM_CHANNEL_USERNAME', 'unbekannt'),'', // -1001232774436 ist die ID vom Channel @wtoc
        'channel_signature' => env('TELEGRAM_CHANNELSIGNATURE', 'unbekannt'),
    ],

  );

?>

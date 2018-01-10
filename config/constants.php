<?php
/**
NOTE:-  1. Add "use Config", on the page, where you want to access the constants.
        2. Access like Config::get('constants.zozocoin.wallet_username')
*/
return [
    'zozocoin' => [
        'wallet_username' => 'zozocoin',
        'wallet_password' => '2082d77e9da45fbcff6edb2c3fdaa794',
        'wallet_ip' => "http://127.0.0.1",
        'port' => "9335",
        'test_wallet_address' => "Xq4tkBaXYTcbLZ14SwEi9fvx3DVaNPHxzo",
        // etc
    ],
    'bitcoin' => [
        'wallet_username' => '',
        'wallet_password' => '',
        'wallet_ip' => "http://127.0.0.1",
        'port' => "",
        'test_wallet_address' => "",
        // etc
    ],
    'sendgrid' => ["url"=>"https://api.sendgrid.com/","username"=>"","password"=>""],
    
    
];
<?php

namespace App\Http\Controllers\ApisControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Goutte\Client;
use Illuminate\Support\Facades\Http;

class APIFootballController extends Controller
{

    public static function get_headers()
    {
        return array(
            'x-rapidapi-key' => config('apis.football_api.api_football_key'),
            'x-rapidapi-host' => config('apis.football_api.api_football_host')
        );
    }

    public function test()
    {
        $response = Http::withHeaders(self::get_headers())->get('https://v3.football.api-sports.io/countries');
        $data = json_decode($response);
        dd($data);
    }
    
}

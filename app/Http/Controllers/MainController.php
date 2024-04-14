<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\ApisControllers\APIFootballController;
use App\Http\Controllers\ScrapingControllers\ScrapingController;

class MainController extends Controller
{
    public function test()
    {
        //$data = APIFootballController::matches_by_date();
        //$data = ScrapingController::bettingclosed_scraping();
        $data = APIFootballController::get_api_prediction();
        dd($data);
    }
}

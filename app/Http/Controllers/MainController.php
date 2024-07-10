<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Http\Controllers\ApisControllers\APIFootballController;
use App\Http\Controllers\ScrapingControllers\ScrapingController;

use App\Helpers\Helpers;

class MainController extends Controller
{
    public function test()
    {
        //$data = APIFootballController::matches_by_date();
        //$data = APIFootballController::get_api_prediction();

        //$data = ScrapingController::bettingclosed_scraping();
        
        //$data = self::get_matches();
        
        //dd($data);
    }

    /**
     * join the data from the apis and the scraper on one array
     * 
     * @return Array with the data from the scraper and the api together
     */
    public static function get_matches()
    {
        ini_set('max_execution_time', 3600);
        $api_data = APIFootballController::matches_by_date();
        $bettingclosed_scraping_data = array(); //ScrapingController::bettingclosed_scraping();
        $forebet_scraping_data = array(); //ScrapingController::forebet_scraping();
        
        foreach( $api_data['matches_by_league'] as $index => $league ) {
            foreach( $league['matches'] as $key => $match ) {
                
                foreach( $bettingclosed_scraping_data as $match_scraped ) {
                    if ( (Helpers::calculate_string_similarity($match['teams']->home->name, $match_scraped['home']) > 50) && (Helpers::calculate_string_similarity($match['teams']->away->name, $match_scraped['away']) > 50) ) {
                        $api_data['matches_by_league'][$index]['matches'][$key] = Arr::add($api_data['matches_by_league'][$index]['matches'][$key], 'bettingclosed_scraping_prediction', $match_scraped );
                        break;
                    }
                }
                
                foreach( $forebet_scraping_data as $match_scraped ) {
                    if ( (Helpers::calculate_string_similarity($match['teams']->home->name, $match_scraped['match_teams']['home']) > 50) && (Helpers::calculate_string_similarity($match['teams']->away->name, $match_scraped['match_teams']['away']) > 50 ) ) {
                        $api_data['matches_by_league'][$index]['matches'][$key] = Arr::add($api_data['matches_by_league'][$index]['matches'][$key], 'forebet_scraping_prediction', $match_scraped );
                        break;
                    }
                }
            }
        }

        return $api_data;
    }

}

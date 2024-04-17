<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Http\Controllers\ApisControllers\APIFootballController;
use App\Http\Controllers\ScrapingControllers\ScrapingController;

class MainController extends Controller
{
    public function test()
    {
        //$data = APIFootballController::matches_by_date();
        //$data = APIFootballController::get_api_prediction();

        //$data = ScrapingController::bettingclosed_scraping();
        
        //$data = self::get_matches();
        //$data = self::calculate_similarity("Bayern Munich'", "Bayern Munchen");
        
        //dd($data);
    }

    /**
     * join the data from the apis and the scraper on one array
     * 
     * @return Array with the data from the scraper and the api together
     */
    public static function get_matches()
    {
        $api_data = APIFootballController::matches_by_date();
        $scraping_data = ScrapingController::bettingclosed_scraping();
        
        foreach( $api_data['matches_by_league'] as $index => $league ) {
            foreach( $league['matches'] as $key => $match ) {
                foreach( $scraping_data as $match_scraped ) {
                    if ( (self::calculate_similarity($match['teams']->home->name, $match_scraped['home']) > 75) && (self::calculate_similarity($match['teams']->away->name, $match_scraped['away']) > 75) ) {
                        $api_data['matches_by_league'][$index]['matches'][$key] = Arr::add($api_data['matches_by_league'][$index]['matches'][$key], 'bettingclosed_scraping_prediction', $match_scraped );
                        break;
                    }
                }
            }
        }

        return $api_data;
    }


    public static function calculate_similarity($string_one, $string_two) {
        // calculate levenshtein distance between the two strings
        $distance = levenshtein($string_one, $string_two);
    
        // calculate maximum lenght of the two strings s
        $max_lenght = max(strlen($string_one), strlen($string_two));
    
        // calculate the level of similarity as a percentage
        $similarity = (1 - $distance / $max_lenght) * 100;
    
        return $similarity;
    }

}

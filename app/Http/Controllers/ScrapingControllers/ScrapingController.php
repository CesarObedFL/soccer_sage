<?php

namespace App\Http\Controllers\ScrapingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingController extends Controller
{

    public function test()
    {
        return 'testing!...';
    }
    
    /**
     * web scraping from bettingclosed.com scores by date
     */
    public static function bettingclosed_scraping() 
    {
        $date = date('Y-m-d');

        $client = new Client(HttpClient::create(['timeout' => 60])); // create the scraping request

        $predictions = array();

        $crawler = $client->request('GET', "https://www.bettingclosed.com/predictions/date-matches/$date/bet-type/correct-scores");

        // extracting the matches table
        $matches_table = $crawler->filter('[class="tbmatches table"]')->filter('tr')->each(function($tr, $i) use (&$predictions) {
            $match_td = $tr->filter('td')->each(function($td, $i) {

                $match_date = $td->filter('[class="dataMt"]')->each(function($class, $i) {
                    return $class->text();
                });
                $team_home = $td->filter('[class="teamAmatch hidden-phone hidden-tablet"]')->each(function($class, $i) {
                    return $class->text();
                });
                $team_away = $td->filter('[class="teamBmatch hidden-phone hidden-tablet"]')->each(function($class, $i) {
                    return $class->text();
                });
                $score_prediction = $td->filter('[class="predMt"]')->each(function($class, $i) {
                    return $class->text();
                });

                // return table data founded
                return [ 'home' => $team_home, 'score_prediction' => $score_prediction, 'away' => $team_away, 'match_date' => $match_date ];
            });
            
            // extracting the empty data and pushing to the predictions array only the got data
            if(count($match_td) > 0) { 
                $team_home = ''; $team_away = ''; $score_prediction = ''; $match_date = '';
                foreach( $match_td as $key => $_match ) {
                    if (count($_match['match_date']) > 0) {
                        $match_date = $_match['match_date'][0] ?? '-';
                    }
                    if (count($_match['home']) > 0) {
                        $team_home = $_match['home'][0] ?? '-';
                    }
                    if (count($_match['score_prediction']) > 0) {
                        $score_prediction = $_match['score_prediction'][0] ?? '-';
                    }
                    if (count($_match['away']) > 0) {
                        $team_away = $_match['away'][0] ?? '-';
                    }
                }

                if ( !empty($team_home) && !empty($score_prediction) && !empty($team_away) ) {
                    array_push($predictions, [ 'home' => $team_home, 'score_prediction' => $score_prediction, 'away' => $team_away, 'date' => $match_date ]); 
                }
            }

            return $match_td;

        });

        dd($predictions);
        return $predictions;

    }
}

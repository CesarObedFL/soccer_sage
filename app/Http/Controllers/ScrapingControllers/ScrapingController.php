<?php

namespace App\Http\Controllers\ScrapingControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

use App\Helpers\Helpers;

class ScrapingController extends Controller
{

    public function test()
    {
        $data = null;//self::pronosticosfutbol365_scraping();
        dd($data);
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

                // return found table data
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

        return $predictions;
        
    }


    /**
     * web scraping from forebet.com today's scores 
     */
    public static function forebet_scraping()
    {
        $date = date('Y-m-d');
        $client = new Client(HttpClient::create(['timeout' => 60])); // create the scraping request
        $predictions = array();
        $crawler = $client->request('GET', "https://www.forebet.com/es/predicciones-para-hoy"); // https://www.forebet.com/es/predicciones-de-futbol/predicciones-1x2/$date

        // extracting the matches table
        $matches_table = $crawler->filter('[class="rcnt tr_0"]')->each(function($div, $i) use (&$predictions) {
            $match_scraped_teams = $div->filter('[class="tnms"]')->each(function($span, $i) {
                $team_home = $span->filter('[class="homeTeam"] > span')->each(function($class, $i) { return $class->text(); });
                $team_away = $span->filter('[class="awayTeam"] > span')->each(function($class, $i) { return $class->text(); });
                $match_date = $span->filter('[class="date_bah"]')->each(function($class, $i) { return $class->text(); });
                return [ 'home' => $team_home, 'away' => $team_away, 'match_date' => $match_date ];
            });

            $exact_scraped_score = $div->filter('[class="ex_sc tabonly"]')->first()->count() > 0 ? $div->filter('[class="ex_sc tabonly"]')->text() : ' - ';

            $scraped_probabilities_in_percentage = $div->filter('[class="fprc"]')->each(function($span, $i) { 
                $data = $span->filter('span')->each(function($data, $i) { return $data->text(); });
                return $data;
            });

            $match = array();
            $probabilities_in_percentage = array();
            $array_temp = Helpers::flatten_array($match_scraped_teams);
            $match = Arr::add($match, 'home', $array_temp[0]);
            $match = Arr::add($match, 'away', $array_temp[1]);
            $match = Arr::add($match, 'date', $array_temp[2]);
            $match = Arr::add($match, 'exact_score', $exact_scraped_score);
            $array_temp = Helpers::flatten_array($scraped_probabilities_in_percentage);
            if ( count($array_temp) == 3 ) {
                $probabilities_in_percentage = Arr::add($probabilities_in_percentage, 'home', $array_temp[0]);
                $probabilities_in_percentage = Arr::add($probabilities_in_percentage, 'draw', $array_temp[1]);
                $probabilities_in_percentage = Arr::add($probabilities_in_percentage, 'away', $array_temp[2]);
            }
            $match = Arr::add($match, 'probabilities_in_percentage', $probabilities_in_percentage);
    
            array_push($predictions, [ 'match_teams' => $match ]); 
    
            return $match;
        });

        // extracting the matches table
        $matches_table = $crawler->filter('[class="rcnt tr_1"]')->each(function($div, $i) use (&$predictions) {
            $match_scraped_teams = $div->filter('[class="tnms"]')->each(function($span, $i) {
                $team_home = $span->filter('[class="homeTeam"] > span')->each(function($class, $i) { return $class->text(); });
                $team_away = $span->filter('[class="awayTeam"] > span')->each(function($class, $i) { return $class->text(); });
                $match_date = $span->filter('[class="date_bah"]')->each(function($class, $i) { return $class->text(); });
                return [ 'home' => $team_home, 'away' => $team_away, 'match_date' => $match_date ];
            });

            $exact_scraped_score = $div->filter('[class="ex_sc tabonly"]')->first()->count() > 0 ? $div->filter('[class="ex_sc tabonly"]')->text() : ' - ';

            $scraped_probabilities_in_percentage = $div->filter('[class="fprc"]')->each(function($span, $i) { 
                $data = $span->filter('span')->each(function($data, $i) { return $data->text(); });
                return $data;
            });

            $match = array();
            $probabilities_in_percentage = array();
            $array_temp = Helpers::flatten_array($match_scraped_teams);
            $match = Arr::add($match, 'home', $array_temp[0]);
            $match = Arr::add($match, 'away', $array_temp[1]);
            $match = Arr::add($match, 'date', $array_temp[2]);
            $match = Arr::add($match, 'exact_score', $exact_scraped_score);
            $array_temp = Helpers::flatten_array($scraped_probabilities_in_percentage);
            if ( count($array_temp) == 3 ) {
                $probabilities_in_percentage = Arr::add($probabilities_in_percentage, 'home', $array_temp[0]);
                $probabilities_in_percentage = Arr::add($probabilities_in_percentage, 'draw', $array_temp[1]);
                $probabilities_in_percentage = Arr::add($probabilities_in_percentage, 'away', $array_temp[2]);
            }
            $match = Arr::add($match, 'probabilities_in_percentage', $probabilities_in_percentage);
    
            array_push($predictions, [ 'match_teams' => $match ]); 
    
            return $match;
        });

        return $predictions;
    }
    
    /**
     * web scraping from pronosticosfutbol365.com today's scores 
     */
    public static function pronosticosfutbol365_scraping()
    {
        $client = new Client(HttpClient::create(['timeout' => 60])); // create the scraping request

        $predictions = array();

        $crawler = $client->request('GET', "https://pronosticosfutbol365.com/predicciones-de-futbol/");  
        
        // extracting the matches table
        $matches_table = $crawler->filter('[class="match"]')->each(function($div, $i) use (&$predictions) {
            $match_scraped_teams = $div->filter('[class="matchrow"]')->filter('[class="teams"]')->each(function($div_teams, $i) {
                $team_home = $div_teams->filter('[class="hostteam"]')->filter('[class="name"]')->each(function($class, $i) { return $class->text(); });
                $team_away = $div_teams->filter('[class="guestteam"]')->filter('[class="name"]')->each(function($class, $i) { return $class->text(); });
                return [ 'home' => $team_home, 'away' => $team_away, 'match_date' => null ];
            });

            $scraped_probabilities_in_percentage = $div->filter('[class="inforow"]')->each(function($span, $i) { 
                //$data = $span->filter('[class="coefbox separate"]')->filter('div')->each(function($data, $i) { return $data->text(); });
                $data = $span->filter('div')->each(function($data, $i) { return $data->text(); });
                return $data[0];
            });

            $match = array();
            $probabilities_in_percentage = array();
            $array_temp = Helpers::flatten_array($match_scraped_teams);
            $match = Arr::add($match, 'home', $array_temp[0]);
            $match = Arr::add($match, 'away', $array_temp[1]);
            $match = Arr::add($match, 'date', $array_temp[2]);
            $match = Arr::add($match, 'exact_score', null); 
            $array_temp = explode(" ", $scraped_probabilities_in_percentage[0]);
            if ( count($array_temp) >= 21 ) {
                $probabilities_in_percentage = Arr::add($probabilities_in_percentage, 'home', $array_temp[11]);
                $probabilities_in_percentage = Arr::add($probabilities_in_percentage, 'draw', $array_temp[12]);
                $probabilities_in_percentage = Arr::add($probabilities_in_percentage, 'away', $array_temp[13]);
            }
            $match = Arr::add($match, 'probabilities_in_percentage', $probabilities_in_percentage);
    
            array_push($predictions, [ 'match_teams' => $match ]); 
    
            return $match;
        });

        return $predictions;
    }


}

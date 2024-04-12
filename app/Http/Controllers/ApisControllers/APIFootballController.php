<?php

namespace App\Http\Controllers\ApisControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Goutte\Client;
use Illuminate\Support\Facades\Http;

class APIFootballController extends Controller
{
    protected static $SAVED_TEAMS = array(
        /* Austria */ 'Red Bull Salzburg', 'Sturm Graz', 
        /* Azerbaidjan */ 'Qarabag',
        /* Belgium */ 'Club Brugge KV', 'Standard Liege', 'Anderlecht', 'Genk', 
        /* Belarus */ 'Bate Borisov', 'Dinamo Brest', 'Shakhter Soligorsk', 
        /* Bulgaria */ 'Ludogorets', 'Spartak Varna',
        /* China */ '',
        /* Croatia */ 'Dinamo Zagreb', 'NK Osijek', 'HNK Hajduk Split', 'HNK Rijeka',
        /* Czech-Republic */ 'Sparta Praha', 'Plzen',
        /* Denmark */ 'FC Copenhagen', 'FC Midtjylland',
        /* England */ 'Manchester City', 'Liverpool', 'Tottenham', 'Arsenal', 'Chelsea',
        /* Estonia */ 'Paide', 'Flora Tallinn', 'FC Levadia Tallinn', 
        /* Finland */ 'HJK helsinki',
        /* France */ 'Paris Saint Germain', 'Monaco', 'Lyon', 'Marseille', 'Lille',
        /* Germany */ 'Bayern Munich', 'Borussia Dortmund', 'Bayer Leverkusen', 
        /* Greece */ 'Panathinaikos', 'AEK Athens FC', 'PAOK', 'Olympiakos Piraeus',
        /* Hungary */ 'Ferencvarosi TC',
        /* Iceland */ 'Fram Reykjavik', 'Thor Akureyri', 'IR Reykjavik', 'KR Reykjavik', 'Breidablik', 
        /* Ireland */ 'Bohemians',
        /* Italy */ 'Juventus', 'AS Roma', 'Atalanta', 'Napoli', 'Inter', 'AC Milan',
        /* Japan */ 'V-varen Nagasaki', 'Nagoya Grampus', 'Yokohama F. Marinos', 'FC Ryukyu', 'Kawasaki Frontale', 'Albirex Niigata', 
        /* Kazakhstan */ 'FC Astana',
        /* Lithuania */ 'Kauno Žalgiris', 'Suduva Marijampole',
        /* Luxembourg */ 'Fola Esch',
        /* Moldova */ 'Sheriff Tiraspol',
        /* Netherlands */ 'Ajax', 'PSV Eindhoven', 'Feyenoord', 'AZ Alkmaar', 
        /* Norway */ 'Molde', 'Bodo/Glimt', 'Rosenborg', 
        /* Portugal */ 'Benfica', 'FC Porto', 'Sporting CP',
        /* Romania */ 'FCSB', 'CFR 1907 Cluj', 'Rapid',
        /* Russia */ 'CSKA Moscow', 'Dinamo Moscow', 'PFC Sochi', 'Spartak Moscow', 'Zenit Saint Petersburg', 
        /* Scotland */ 'Rangers', 'Celtic', 'Hibernian', 
        /* Serbia */ 'FK Crvena Zvezda', 'FK Partizan',
        /* Singapore */ 'Albirex Niigata S',
        /* Slovakia */ 'Spartak Trnava', 'Slovan Bratislava', 'Žilina',
        /* Slovenia */ 'Maribor',
        /* South-Korea */ 'Jeonbuk Motors', 'Ulsan Hyundai FC', 
        /* Spain */ 'Real Madrid', 'Sevilla', 'Barcelona', 'Real Betis', 'Villarreal', 'Atletico Madrid',
        /* Sweden */ 'Malmo FF', 
        /* Switzerland */ 'FC Basel 1893', 'BSC Young Boys', 
        /* Turkey */ 'Fenerbahce', 'Galatasaray',
        /* Ukraine */ 'Dynamo Kyiv', 'Shakhtar Donetsk', 
        /* Wales */ 'The New Saints',
        /* */
    );

    public static function get_headers()
    {
        return array(
            'x-rapidapi-key' => config('apis.football_api.api_football_key'),
            'x-rapidapi-host' => config('apis.football_api.api_football_host')
        );
    }

    public function test()
    {
        //$response = Http::withHeaders(self::get_headers())->get('https://v3.football.api-sports.io/countries');
        $data = json_decode($response);
        dd($data);
    }

    /**
     * get the matches from the API by date
     * 
     * @param Date the matches date
     */
    public static function matches_by_date(/*$date*/)
    {
        ini_set('max_execution_time', 360);
        $date = date('Y-m-d');
        $response = Http::withHeaders( self::get_headers() )->get('https://v3.football.api-sports.io/fixtures?date='.$date.'&timezone=America/Mexico_City');
        $data = json_decode($response);
        
        $matches_by_league = array();
        $matches = array();
        $is_bet_oportunity = false; // if a saved team is home it's == true
        $is_home_team_saved = false;  // if home team is in the saved teams array it´s == true
        $is_away_team_saved = false;  // if away team is in the saved teams array it´s == true

        // stored in the array the matches by league and country
        foreach($data->response as $match_one) {
            foreach($data->response as $match_two) {
                if ($match_one->league->name === $match_two->league->name) {
                    if ($match_one->league->country === $match_two->league->country) {
                        if( in_array( $match_two->teams->home->name, self::$SAVED_TEAMS ) ) {
                            $is_bet_oportunity = true;
                        }

                        if( in_array( $match_two->teams->home->name, self::$SAVED_TEAMS ) ) {
                            $is_home_team_saved = true;
                        }

                        if( in_array( $match_two->teams->away->name, self::$SAVED_TEAMS )) {
                            $is_away_team_saved = true;
                        }

                        array_push($matches, array(
                                'fixture_id' => $match_one->fixture->id, // to get api predictions
                                'date' => $match_two->fixture->date,
                                'status' => $match_two->fixture->status,
                                'teams'=> $match_two->teams,
                                'score' => $match_two->score,
                                'is_bet_oportunity' => $is_bet_oportunity,
                                'is_home_team_saved' => $is_home_team_saved,
                                'is_away_team_saved' => $is_away_team_saved 
                            )
                        );
                    } // endif ($match_one->league->country === $match_two->league->country)
                    $is_bet_oportunity = false;
                    $is_home_team_saved = false;
                    $is_away_team_saved = false;
                } // endif ($match_one->league->name === $match_two->league->name)

            } // endforeach($data->response as $match_two)

            // matches by league array
            array_push($matches_by_league, array(
                                                'league' => $match_one->league->name,
                                                'league_logo' => $match_one->league->logo,
                                                'country' => $match_one->league->country,
                                                'country_flag' => $match_one->league->flag,
                                                'total_matches' => count($matches),
                                                'season' => $match_one->league->season,
                                                'round' => $match_one->league->round,
                                                'matches' => $matches
                                            ));
            $matches = array(); // reinitializing matches array...

        } // endforeach($data->response as $match_one)

        // removing duplicate objects 
        $matches_by_league = array_map("unserialize", array_unique(array_map("serialize", $matches_by_league)));
        
        // sorting by country
        usort($matches_by_league, function ($match_a, $match_b) {
                                    if ($match_a['country'] == $match_b['country']) {
                                        return 0;
                                    }
                                    return ($match_a['country'] < $match_b['country']) ? -1 : 1;
                                });

        return [
                    'total' => count($matches_by_league),
                    'matches_by_league' => $matches_by_league
                ];
    }

    /**
     * get the prediction of one matche from the API by fixture (match id)
     * 
     * @param Integer the matches fixture id
     */
    public static function get_api_prediction($match_fixture)
    {
        $response = Http::withHeaders( self::get_headers() )->get('https://v3.football.api-sports.io/predictions', [ 'fixture' => $match_fixture ]);
        $data = json_decode($response);
        dd($data);
    }
    
}

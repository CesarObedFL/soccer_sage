<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matches') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <!-- container for all cards -->
            <div class="container w-100 lg:w-4/5 mx-auto flex flex-col">

                <div class="relative max-w-sm">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select matchs date">
                </div>

                <!-- card -->
                <div class="flex flex-col md:flex-row overflow-hidden bg-white rounded-lg shadow-xl mt-4 w-100 mx-2">
                    <ul>
                        @forelse ($matches_by_league as $league_index => $league)
                            <!-- content -->
                            <div class="w-full py-4 px-6 text-gray-800 flex flex-col justify-between">
                                <!-- league/competence info -->
                                <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700">
                                    <img class="object-cover w-50 px-10 rounded-t-lg h-30 md:rounded-none md:rounded-s-lg" src="{{ $league['league_logo'] }}" alt="">
                                    <div class="flex flex-col justify-between p-8 leading-normal">
                                        <h3 class="font-semibold text-lg leading-tight truncate">{{ $league['league'] }}</h3>
                                        <p class="text-sm text-gray-700 uppercase tracking-wide font-semibold mt-2">
                                            {{ $league['country'] }} &bull; {{ $league['season'] }} &bull; {{ $league['round'] }} 
                                        </p>
                                    </div>
                                </div>  
                                <!-- league/competence info -->

                                <p class="mt-2">
                                    <ul>
                                        <table class="w-full">
                                            <thead>
                                                <tr class="w-96 border-b border-gray-200">
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">Match ID</th>
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">Date</th>
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">Status</th>
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">Match</th>
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">Score</th>
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">Home Team Saved</th>
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">Away Team Saved</th>
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">Bet Oportunity</th>
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">Bettingclosed Prediction</th>
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">Forebet Prediction</th>
                                                    <th class="bg-emerald-400 !important text-center font-bold py-4 px-3">PronosticosFutbol365 Prediction</th>
                                                </tr>
                                            </thead>
                                            <tbody class="w-96">
                                            @forelse ($league['matches'] as $match_index => $match)

                                                    <tr wire:key="league-{{ $match_index }}" class="w-96 hover:bg-gray-100 transition-colors group">
                                                        <td class="py-4 px-4 text-center">
                                                            <button type="button" 
                                                                class="bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                                                                wire:click="$dispatch('openModal', { component: 'MatchPrediction', arguments: { fixture: {{ $match['fixture_id'] }} }})">{{ $match['fixture_id'] }}
                                                            </button>
                                                        </td>
                                                        <td class="py-4 px-4 text-center">{{ $match['date'] }}</td>
                                                        <td class="py-4 px-4 text-center"> 
                                                            @if ($match['status']->long == 'Match Finished') 
                                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2 py-1.5 rounded border border-red-400 uppercase">{{ $match['status']->long }}</span> 
                                                            @elseif ($match['status']->long == 'Not Started') 
                                                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2 py-1.5 rounded border border-green-400 uppercase">{{ $match['status']->long }}</span> 
                                                            @else
                                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-yellow-300">{{ $match['status']->long }}</span>
                                                            @endif
                                                                {{ ' min: ' . $match['status']->elapsed }}
                                                            </td>
                                                        <td class="py-4 px-4 text-center">{{ $match['teams']->home->name }} <b><i>vs</i></b> {{ $match['teams']->away->name }}</td>
                                                        <td class="py-4 px-4 text-center">{{ ($match['score']->fulltime->home) ? ($match['score']->fulltime->home) . ':' . ($match['score']->fulltime->away) : ($match['score']->halftime->home) . ':' . ($match['score']->halftime->home)}}</td>
                                                        <td class="py-4 px-4 text-center">
                                                            @if ($match['is_home_team_saved'])
                                                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2 py-1.5 rounded border border-green-400 uppercase">true</span> 
                                                            @else 
                                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2 py-1.5 rounded border border-red-400 uppercase">false</span> 
                                                            @endif
                                                        </td>
                                                        <td class="py-4 px-4 text-center">
                                                            @if ($match['is_away_team_saved']) 
                                                                <span class="bg-green-300 text-green-800 text-xs font-medium me-2 px-2 py-1.5 rounded border border-green-400 uppercase">true</span> 
                                                            @else 
                                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2 py-1.5 rounded border border-red-400 uppercase">false</span> 
                                                            @endif
                                                        </td>
                                                        <td class="py-4 px-4 text-center">
                                                            @if ($match['is_bet_oportunity'])
                                                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2 py-1.5 rounded border border-green-400 uppercase">true</span> 
                                                            @else 
                                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2 py-1.5 rounded border border-red-400 uppercase">false</span> 
                                                            @endif
                                                        </td>
                                                        <td class="py-4 px-4 text-center">
                                                            @if( isset($match['bettingclosed_scraping_prediction']) ) 
                                                                {{ $match['bettingclosed_scraping_prediction']['home'] . ' ' . $match['bettingclosed_scraping_prediction']['score_prediction'] . ' ' . $match['bettingclosed_scraping_prediction']['away']  }} 
                                                            @else 
                                                                {{ ' - ' }} 
                                                            @endif
                                                        </td>
                                                        <td class="py-4 px-4 text-center">
                                                            @if( isset($match['forebet_scraping_prediction']) ) 
                                                                {{ $match['forebet_scraping_prediction']['match_teams']['home'] . ' ' . $match['forebet_scraping_prediction']['match_teams']['exact_score'] . ' ' . $match['forebet_scraping_prediction']['match_teams']['away']  }} 
                                                            @else 
                                                                {{ ' - ' }} 
                                                            @endif
                                                        </td> 
                                                        <td class="py-4 px-4 text-center">
                                                            @if( isset($match['pronosticosfutbol365_scraping_data']) ) 
                                                                {{ $match['pronosticosfutbol365_scraping_data']['match_teams']['home'] . ' ' . 
                                                                    $match['pronosticosfutbol365_scraping_data']['match_teams']['probabilities_in_percentage']['home'] . ':' . 
                                                                    $match['pronosticosfutbol365_scraping_data']['match_teams']['probabilities_in_percentage']['draw'] . ':' . 
                                                                    $match['pronosticosfutbol365_scraping_data']['match_teams']['probabilities_in_percentage']['away']  . ' ' . 
                                                                    $match['pronosticosfutbol365_scraping_data']['match_teams']['away']  
                                                                }} 
                                                            @else 
                                                                {{ ' - ' }} 
                                                            @endif
                                                        </td> 
                                                    </tr>
                                                
                                            @empty
                                                <tr><td class="py-4 px-4 text-center">No Matches</td></tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </ul>
                                </p>
                            </div>
                        @empty
                            <li>No Leagues</li>
                        @endforelse
                    </ul>
                </div><!--/ card-->
            </div><!--/ flex-->
        </div>
    </div>


</div>



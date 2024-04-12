<div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matches') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="pt-6 pb-12 bg-gray-300">  
                <h2 class="text-center font-serif  uppercase text-4xl xl:text-5xl">Recent Matches</h2>
                <!-- container for all cards -->
                <div class="container w-100 lg:w-4/5 mx-auto flex flex-col">
                    <!-- card -->
                    <div class="flex flex-col md:flex-row overflow-hidden bg-white rounded-lg shadow-xl  mt-4 w-100 mx-2">
                        <ul>
                            @forelse ($matches_by_league as $league_index => $league)
                                <!-- media -->
                                <div class="h-64 w-auto md:w-1/2">
                                    <!-- <img class="inset-0 h-full w-full object-cover object-center" width="50" src="{{ $league['league_logo'] }}"/> -->
                                </div>
                                <!-- content -->
                                <div class="w-full py-4 px-6 text-gray-800 flex flex-col justify-between">
                                    <h3 class="font-semibold text-lg leading-tight truncate">{{ $league['league'] }}</h3>
                                    <p class="text-sm text-gray-700 uppercase tracking-wide font-semibold mt-2">
                                        {{ $league['country'] }} &bull; {{ $league['season'] }} &bull; {{ $league['round'] }} 
                                    </p>
                                    <p class="mt-2">
                                        <ul>
                                            @forelse ($league['matches'] as $match_index => $match)
                                                <li wire:key="league-{{ $match_index }}">
                                                    {{ $match['fixture_id'] }} &bull;
                                                    {{ $match['date'] }} &bull;
                                                    {{ $match['status']->long . ' - ' . 'min: ' . $match['status']->elapsed }} &bull;
                                                    {{ $match['teams']->home->name }} <b><i>vs</i></b> {{ $match['teams']->away->name }} &bull; 
                                                    {{ ($match['score']->fulltime->home) ? ($match['score']->fulltime->home) . ':' . ($match['score']->fulltime->away) : ($match['score']->halftime->home) . ':' . ($match['score']->halftime->home)}} &bull;
                                                    is_home_team_saved: {{ ($match['is_home_team_saved']) ? 'true' : 'false' }} &bull; 
                                                    is_away_team_saved: {{ ($match['is_away_team_saved']) ? 'true' : 'false' }} &bull; 
                                                    bet_oportunity: {{ ($match['is_bet_oportunity']) ? 'true' : 'false' }}
                                                </li>
                                            @empty
                                                <li>No Matches</li>
                                            @endforelse
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


</div>
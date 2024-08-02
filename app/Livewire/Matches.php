<?php

namespace App\Livewire;

use Livewire\Component;

use App\Http\Controllers\MainController;

class Matches extends Component
{



    public function render()
    {
        $data = MainController::get_matches();
        //dd($data['matches_by_league'][145]);
        return view('livewire.matches', [ 'matches_by_league' => $data['matches_by_league'], 'total_matches' => $data['total'] ])->layout('layouts.app');
    }
}

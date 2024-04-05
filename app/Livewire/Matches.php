<?php

namespace App\Livewire;

use Livewire\Component;

use App\Http\Controllers\ApisControllers\APIFootballController;

class Matches extends Component
{



    public function render()
    {
        $data = APIFootballController::matches_by_date();
        //dd($data['matches_by_league'][0]);
        return view('livewire.matches', [ 'matches_by_league' => $data['matches_by_league'] ])->layout('layouts.app');
    }
}

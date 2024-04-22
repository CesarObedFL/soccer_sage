<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

use App\Http\Controllers\ApisControllers\APIFootballController;

class MatchPrediction extends ModalComponent
{

    public $fixture;
    public $data;
    public $prediction;

    public function mount($fixture)
    {
        $this->fixture = $fixture;
        $this->data = APIFootballController::get_api_prediction($this->fixture);
        $this->prediction = $this->data->response[0]->predictions;
    }

    public function render()
    {
        return view('livewire.match-prediction');
    }

    public function close()
    {
        $this->fixture = '';
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '3xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }
}

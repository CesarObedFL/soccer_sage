<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

use App\Http\Controllers\ApisControllers\APIFootballController;

class ApiMatchPrediction extends ModalComponent
{

    public $fixture;
    public $data;

    public function mount($fixture)
    {
        $this->fixture = $fixture;
        $this->data = APIFootballController::get_api_prediction($this->fixture);
    }

    public function render()
    {
        return view('livewire.api-match-prediction');
    }

    public function close()
    {
        $this->fixture = '';
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }
}

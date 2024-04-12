<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;

class ApiMatchPrediction extends ModalComponent
{

    public $fixture;

    public function mount($fixture)
    {
        $this->fixture = $fixture;
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

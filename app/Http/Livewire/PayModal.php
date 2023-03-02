<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PayModal extends Component
{
    public $Credito = false;
    public $Debito = false;

    public function render()
    {
        return view('livewire.pay-modal');
    }

}

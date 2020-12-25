<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\Store;
use Livewire\Component;

class CreateInvoice extends Component
{

    public function create()
    {
       Invoice::create([
        'store_id' => auth()->user()->store->id,
        'balance' => 0
       ]);

        $this->emit('created_invoice');
    }



    public function render()
    {
        return view('livewire.invoices.create-invoice');
    }


}

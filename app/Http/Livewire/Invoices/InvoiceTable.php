<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class InvoiceTable extends Component
{

    protected $listeners = [
        'created_invoice'  => '$refresh'
     ];



    public function getInvoicesProperty()
    {
        //admin = all voices
        // customers = their invoices

        if (auth()->user()->hasRole('admin')) {
           return Invoice::where('status' , '!=', 0)->get();
        } else {
            return Invoice::where('store_id', auth()->user()->store->id)->get();
        }

    }




    public function render()
    {
        return view('livewire.invoices.invoice-table', [
            'invoices' => $this->getInvoicesProperty()
        ]);
    }
}

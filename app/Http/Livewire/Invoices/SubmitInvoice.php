<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;

class SubmitInvoice extends Component
{

    public Invoice $invoice;

    public function submit()
    {
       $this->invoice->update([
        'status' => 1
       ]);

       return redirect(route(
           'invoices.view', $this->invoice
       ));
    }

    public function render()
    {
        return view('livewire.invoices.submit-invoice');
    }
}

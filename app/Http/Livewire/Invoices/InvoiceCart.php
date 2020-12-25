<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use PhpParser\Node\Stmt\If_;

class InvoiceCart extends Component
{
    public Invoice $invoice;

    protected $listeners = ['refresh' => '$refresh'];

    public function getProductsProperty(){
        return $this->invoice->products;
    }


    public function minus($product)
    {

        // if the number is 1
        // delete this product
        // refresh

        if($product['pivot']['quantity'] == 1){
            $this->invoice->products()->detach($product['id']);

        } else {
            $newQty = $product['pivot']['quantity'] - 1;
            $this->invoice->products()->updateExistingPivot($product['id'], ['quantity' => $newQty]);
        }

        $this->invoice->refresh();
        $this->calculateBalance();

    }


    public function add($product)
    {
        $newQty = $product['pivot']['quantity'] + 1;


      $this->invoice->products()->updateExistingPivot($product['id'], ['quantity' => $newQty]);
      $this->invoice->refresh();
      $this->calculateBalance();
    }


    public function calculateBalance()
    {
        $sum = 0;
        //foreach all the products
        // add the sum
        // save it into the invoice
        // refrehs invoice

        foreach ($this->invoice->products as $product) {
             $sum += $product->price * $product->pivot->quantity;
        }

        $this->invoice->update([
            'balance' => $sum
        ]);


    }



    public function render()
    {
        return view('livewire.invoices.invoice-cart', [
            'products' => $this->getProductsProperty()
        ]);
    }
}

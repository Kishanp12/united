<?php

namespace App\Http\Livewire\Products;

use App\Models\Invoice;
use App\Models\Product;
use App\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ProductsTable extends LivewireDatatable
{
    public $model = Product::class;

    public Invoice $invoice;


    public function addProduct($product_id, $price)
    {
        $this->invoice->products()->attach($product_id, ['quantity' => 1]);

        $this->invoice->update([
            'balance' => $this->invoice->balance + $price
        ]);


        $this->emit('refresh');
    }

    public function columns()
    {

        $col = [
             NumberColumn::name('id'),
             Column::name('name')->filterable()->searchable()
        ];

        if ($this->invoice->status == 0) {

            $col[] = Column::callback(['id', 'price'], function ($id, $price) {
                return view('products.table-actions', ['id' => $id, 'price' => $price]);
            });
        }

        return $col;


        // return [
        //     NumberColumn::name('id'),

        //     Column::name('name')->filterable()->searchable(),

        //     Column::callback(['id', 'price'], function ($id, $price) {
        //         return view('products.table-actions', ['id' => $id, 'price' => $price]);
        //     })
        // ];
    }
}

<?php

namespace Tests\Feature\Http\Livewire\Invoices;

use App\Http\Livewire\Invoices\CreateInvoice;
use App\Http\Livewire\Invoices\InvoiceTable;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateInvoiceTest extends TestCase
{

    use RefreshDatabase;

    public function test_invoice_is_being_created()
    {
        $this->seed();

        $user = User::factory()->hasStore()->create();

        $this->assertDatabaseCount('invoices', 0);

        $user->assignRole('customer');

        $this->actingAs($user);

        Livewire::actingAs($user)
        ->test(CreateInvoice::class)
        ->call('create')
        ->assertEmitted('created_invoice');

        $this->assertDatabaseHas('invoices' , [
            'store_id' => $user->store->id,
            'balance' => 0
        ]);



    }

    public function test_correct_view_is_being_returned()
    {
        Livewire::test(CreateInvoice::class)
        ->assertViewIs('livewire.invoices.create-invoice');
    }


}

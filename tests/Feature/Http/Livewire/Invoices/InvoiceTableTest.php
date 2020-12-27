<?php

namespace Tests\Feature\Http\Livewire\Invoices;

use App\Http\Livewire\Invoices\InvoiceTable;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class InvoiceTableTest extends TestCase
{
    use RefreshDatabase;


    public function test_invoice_table_loading()
    {

        $this->seed();

        $user = User::factory()->hasStore()->create();
        $user->assignRole('customer');

        $this->actingAs($user);

        Livewire::actingAs($user)
        ->test(InvoiceTable::class)
        ->assertViewIs('livewire.invoices.invoice-table')
        ->assertStatus(200);
    }

    public function test_invoices_are_showing_for_customer()
    {

        //create a user
        //create a store
        //create an invoice
        $this->seed();

        $user = User::factory()->hasStore()->create();
        $user->assignRole('customer');

        $invoice = Invoice::factory()->create([
            'store_id' => $user->store->id,
            'balance' => 100
        ]);


        $invoice2 = Invoice::factory()->create([
            'store_id' => 12323,
            'balance' => 99
        ]);



        Livewire::actingAs($user)
        ->test(InvoiceTable::class)
        ->assertSee($user->store->address)
        ->assertSee($user->store->name)
        ->assertSee('$'.$invoice->balance)
        ->assertDontSee('99');




        //load livewire
        //check if we see that invoice in the screen


    }

    public function test_invoices_are_showing_for_admin()
    {
        $this->seed();

        $admin = User::factory()->create();
        $admin->assignRole('admin');


        //Customer1
        $cus1 = User::factory()->hasStore()->create();
        $cus1->assignRole('customer');

        $invoice1 = Invoice::factory()->create([
            'store_id' => $cus1->store->id,
            'balance' => 10,
            'status' => 1
        ]);

        //Customer2
        $cus2 = User::factory()->hasStore()->create();
        $cus2->assignRole('customer');

        $invoice2 = Invoice::factory()->create([
            'store_id' => $cus2->store->id,
            'balance' => 100,
            'status' => 1
        ]);

        Livewire::actingAs($admin)
        ->test(InvoiceTable::class)
        ->assertSee($invoice1->balance)
        ->assertSee($invoice2->balance);


    }

    public function test_invoices_admin_doesnt_see_preparing_status()
    {
        $this->seed();

        $admin = User::factory()->create();
        $admin->assignRole('admin');


        //Customer1
        $cus1 = User::factory()->hasStore()->create();
        $cus1->assignRole('customer');

        $invoice1 = Invoice::factory()->create([
            'store_id' => $cus1->store->id,
            'balance' => 87,
            'status' => 0
        ]);

        //Customer2
        $cus2 = User::factory()->hasStore()->create();
        $cus2->assignRole('customer');

        $invoice2 = Invoice::factory()->create([
            'store_id' => $cus2->store->id,
            'balance' => 100,
            'status' => 1
        ]);

        Livewire::actingAs($admin)
        ->test(InvoiceTable::class)
        ->assertDontSee($invoice1->balance)
        ->assertSee($invoice2->balance);


    }
}

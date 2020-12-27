<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceControllerTest extends TestCase
{
   use RefreshDatabase;

   public function test_page_is_being_loaded()
   {

    $this->withoutExceptionHandling();
        $this->seed();

        $user = User::factory()->hasStore()->create();

        $user->assignRole('customer');

        $this->actingAs($user)
        ->get(route('invoices.index'))
       ->assertViewIs('invoices.index')
       ->assertSeeLivewire('invoices.create-invoice')
       ->assertSeeLivewire('invoices.invoice-table');
   }

   public function test_page_loads_without_any_stores()
   {
    $this->seed();

    $user = User::factory()->create();

    $user->assignRole('admin');

    $this->actingAs($user)
    ->get(route('invoices.index'))
   ->assertViewIs('invoices.index')
   ->assertDontSeeLivewire('invoices.create-invoice')
   ->assertSeeLivewire('invoices.invoice-table');

   }
}

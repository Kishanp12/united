<?php

namespace Tests\Feature\Http\Livewire\Stores;

use App\Http\Livewire\Stores\StoresTable;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class StoresTableTest extends TestCase
{

    use RefreshDatabase;


    public function test_table_shows_store_details()
    {

        $store = Store::factory()->create([
          'name'  =>   'kishan'
        ]);

        Livewire::test(StoresTable::class)
        ->assertViewIs('livewire.stores.stores-table')
        ->assertSee('kishan')
        ->assertSee($store->address)
        ->assertSee($store->user->email);
    }


    public function test_store_can_be_approved()
    {

        $store = Store::factory()->create([
            'name'  =>   'kishan',
            'approved' => 0
          ]);


          $this->assertDatabaseHas('stores', [
            'name' => 'kishan',
            'approved' => 0
        ]);


          Livewire::test(StoresTable::class)
          ->call('changeStatus', $store);


          $this->assertDatabaseHas('stores', [
              'name' => 'kishan',
              'approved' => 1
          ]);


    }



}

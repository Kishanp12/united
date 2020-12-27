<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_view_is_being_displayed()
    {
       $this->get(route('stores.register'))
       ->assertViewIs('stores.register');
    }

    public function test_has_livewire_component()
    {

         // Run the DatabaseSeeder...
         $this->seed();

        $user = User::factory()->create();

        $user->assignRole('admin');

        $this->actingAs($user)
            ->get(route('stores.index'))
            ->assertViewIs('stores.index')
            ->assertSeeLivewire('stores.stores-table');
    }


    public function test_a_customer_cannot_view_stores()
    {

         // Run the DatabaseSeeder...
         $this->seed();

        $user = User::factory()->create();

        $user->assignRole('customer');

        $this->actingAs($user)
            ->get(route('stores.index'))
            ->assertStatus(403);

     }


}

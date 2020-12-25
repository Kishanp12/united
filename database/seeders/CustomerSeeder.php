<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->hasStore()->create([
            'email' => 'cus@gmail.com'
        ]);
        $user->assignRole('customer');
    }
}

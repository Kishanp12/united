<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $handle = fopen(storage_path('app/products/products.csv'), "r");
        $header = true;

        $products = [];

        while ($csvLine = fgetcsv($handle, 1000, ",")) {

            //ignore the headers
            if ($header) {
                $header = false;
            } else {
                //Create a product
                $products[] = [
                    'name' => $csvLine[0],
                    'brand' => $csvLine[1],
                    'category' => $csvLine[2],
                    'price' => 1.00,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        //Now the save products
        Product::insert($products);

    }
}

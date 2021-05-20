<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('toppings')->insert([
            'id' => 1,
            'name' => "Cheese"
        ]);
        DB::table('toppings')->insert([
            'id' => 2,
            'name' => "Tomato Sauce"
        ]);
        DB::table('toppings')->insert([
            'id' => 3,
            'name' => "Pepperoni"
        ]);
        DB::table('toppings')->insert([
            'id' => 4,
            'name' => "Ham"
        ]);
        DB::table('toppings')->insert([
            'id' => 5,
            'name' => "Chicken"
        ]);
        DB::table('toppings')->insert([
            'id' => 6,
            'name' => "Minced Beef"
        ]);
        DB::table('toppings')->insert([
            'id' => 7,
            'name' => "Onions"
        ]);
        DB::table('toppings')->insert([
            'id' => 8,
            'name' => "Green Peppers"
        ]);
        DB::table('toppings')->insert([
            'id' => 9,
            'name' => "Mushrooms"
        ]);
        DB::table('toppings')->insert([
            'id' => 10,
            'name' => "Sweetcorn"
        ]);
        DB::table('toppings')->insert([
            'id' => 11,
            'name' => "Jalapeno Peppers"
        ]);
        DB::table('toppings')->insert([
            'id' => 12,
            'name' => "Pineapple"
        ]);
        DB::table('toppings')->insert([
            'id' => 13,
            'name' => "Sausage"
        ]);
        DB::table('toppings')->insert([
            'id' => 14,
            'name' => "Bacon"
        ]);
    }
}

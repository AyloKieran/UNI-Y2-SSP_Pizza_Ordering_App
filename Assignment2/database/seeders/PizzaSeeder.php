<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pizzas')->insert([
            'id' => 1,
            'name' => "Original",
            'toppings' => "cheese,tomato sauce",
            'smallprice' => 8.00,
            'mediumprice' => 9.00,
            'largeprice' => 11.00,
        ]);
        DB::table('pizzas')->insert([
            'id' => 2,
            'name' => "Gimme the Meat",
            'toppings' => "pepperoni,ham,chicken,minced beef,sausage,bacon",
            'smallprice' => 11.00,
            'mediumprice' => 14.50,
            'largeprice' => 16.50,
        ]);
        DB::table('pizzas')->insert([
            'id' => 3,
            'name' => "Veggie Delight",
            'toppings' => "onions,green peppers,mushrooms,sweetcorn",
            'smallprice' => 10.00,
            'mediumprice' => 13.00,
            'largeprice' => 15.00,
        ]);
        DB::table('pizzas')->insert([
            'id' => 4,
            'name' => "Make Mine Hot",
            'toppings' => "chicken,onions,green peppers,jalapeno peppers",
            'smallprice' => 11.00,
            'mediumprice' => 13.00,
            'largeprice' => 15.00,
        ]);
        DB::table('pizzas')->insert([
            'id' => 5,
            'name' => "Create Your Own",
            'toppings' => "",
            'smallprice' => 8.00,
            'mediumprice' => 9.00,
            'largeprice' => 11.00,
        ]);
        
    }
}

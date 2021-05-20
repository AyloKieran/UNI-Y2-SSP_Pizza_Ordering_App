<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class DealsTest extends TestCase
{

    public function testAuthenticatedCartSpecial()
    {
        $this->followingRedirects()
            ->withSession(['order' => ['a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}'], 'deals' => 'a:1:{i:0;s:20:"Two for One Tuesdays";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertViewIs('auth.login');
    }

    public function testTwoForOneTuesdaysNormal()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}'], 'deals' => 'a:1:{i:0;s:20:"Two for One Tuesdays";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 14.5);
    }

    public function testTwoForOneTuesdaysInvalid()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"small";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"8.00";}', 'a:4:{s:4:"name";s:14:"Veggie Delight";s:4:"size";s:5:"small";s:8:"toppings";a:4:{i:0;s:6:"onions";i:1;s:13:"green peppers";i:2;s:9:"mushrooms";i:3;s:9:"sweetcorn";}s:5:"price";s:5:"10.00";}'], 'deals' => 'a:1:{i:0;s:20:"Two for One Tuesdays";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 18);
    }

    public function testTwoForOneTuesdaysBoundary()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}', 'a:4:{s:4:"name";s:14:"Veggie Delight";s:4:"size";s:5:"large";s:8:"toppings";a:4:{i:0;s:6:"onions";i:1;s:13:"green peppers";i:2;s:9:"mushrooms";i:3;s:9:"sweetcorn";}s:5:"price";s:5:"15.00";}'], 'deals' => 'a:1:{i:0;s:20:"Two for One Tuesdays";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 15);
    }

    public function testThreeForTwoThursdaysNormal()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}', 'a:4:{s:4:"name";s:14:"Veggie Delight";s:4:"size";s:6:"medium";s:8:"toppings";a:4:{i:0;s:6:"onions";i:1;s:13:"green peppers";i:2;s:9:"mushrooms";i:3;s:9:"sweetcorn";}s:5:"price";s:5:"13.00";}'], 'deals' => 'a:1:{i:0;s:23:"Three for Two Thursdays";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 27.5);
    }

    public function testThreeForTwoThursdaysInvalid()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}'], 'deals' => 'a:1:{i:0;s:23:"Three for Two Thursdays";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 11.0);
    }

    public function testThreeForTwoThursdaysBoundary()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}', 'a:4:{s:4:"name";s:14:"Veggie Delight";s:4:"size";s:6:"medium";s:8:"toppings";a:4:{i:0;s:6:"onions";i:1;s:13:"green peppers";i:2;s:9:"mushrooms";i:3;s:9:"sweetcorn";}s:5:"price";s:5:"13.00";}', 'a:4:{s:4:"name";s:13:"Make Mine Hot";s:4:"size";s:6:"medium";s:8:"toppings";a:4:{i:0;s:7:"chicken";i:1;s:6:"onions";i:2;s:13:"green peppers";i:3;s:16:"jalapeno peppers";}s:5:"price";s:5:"13.00";}'], 'deals' => 'a:1:{i:0;s:23:"Three for Two Thursdays";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 36.5);
    }

    public function testFamilyFridayNormal()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}', 'a:4:{s:4:"name";s:14:"Veggie Delight";s:4:"size";s:6:"medium";s:8:"toppings";a:4:{i:0;s:6:"onions";i:1;s:13:"green peppers";i:2;s:9:"mushrooms";i:3;s:9:"sweetcorn";}s:5:"price";s:5:"13.00";}', 'a:4:{s:4:"name";s:13:"Make Mine Hot";s:4:"size";s:6:"medium";s:8:"toppings";a:4:{i:0;s:7:"chicken";i:1;s:6:"onions";i:2;s:13:"green peppers";i:3;s:16:"jalapeno peppers";}s:5:"price";s:5:"13.00";}'], 'deals' => 'a:1:{i:0;s:13:"Family Friday";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 30.0);
    }

    public function testFamilyFridayInvalid()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
        ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}', 'a:4:{s:4:"name";s:14:"Veggie Delight";s:4:"size";s:6:"medium";s:8:"toppings";a:4:{i:0;s:6:"onions";i:1;s:13:"green peppers";i:2;s:9:"mushrooms";i:3;s:9:"sweetcorn";}s:5:"price";s:5:"13.00";}', 'a:4:{s:4:"name";s:13:"Make Mine Hot";s:4:"size";s:6:"medium";s:8:"toppings";a:4:{i:0;s:7:"chicken";i:1;s:6:"onions";i:2;s:13:"green peppers";i:3;s:16:"jalapeno peppers";}s:5:"price";s:5:"13.00";}'], 'deals' => 'a:1:{i:0;s:13:"Family Friday";}'])
        ->post('/cart', ['deliverytype' => 'Delivery'])
            ->assertSessionHas('total', 49.5);
    }

    public function testFamilyFridayBoundaryOne()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:6:"medium";s:8:"toppings";a:1:{i:0;s:5:"Bacon";}s:5:"price";d:10;}', 'a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:6:"medium";s:8:"toppings";a:1:{i:0;s:5:"Bacon";}s:5:"price";d:10;}', 'a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:6:"medium";s:8:"toppings";a:1:{i:0;s:5:"Bacon";}s:5:"price";d:10;}', 'a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:6:"medium";s:8:"toppings";a:1:{i:0;s:5:"Bacon";}s:5:"price";d:10;}'], 'deals' => 'a:1:{i:0;s:13:"Family Friday";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 40.0);
    }

    public function testFamilyFridayBoundaryTwo()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:6:"medium";s:8:"toppings";a:1:{i:0;s:5:"Bacon";}s:5:"price";d:10;}', 'a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:6:"medium";s:8:"toppings";a:1:{i:0;s:5:"Bacon";}s:5:"price";d:10;}', 'a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:6:"medium";s:8:"toppings";a:1:{i:0;s:5:"Bacon";}s:5:"price";d:10;}', 'a:4:{s:4:"name";s:13:"Make Mine Hot";s:4:"size";s:6:"medium";s:8:"toppings";a:4:{i:0;s:7:"chicken";i:1;s:6:"onions";i:2;s:13:"green peppers";i:3;s:16:"jalapeno peppers";}s:5:"price";s:5:"13.00";}'], 'deals' => 'a:1:{i:0;s:13:"Family Friday";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 43.0);
    }

    public function testTwoLargeNormal()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}'], 'deals' => 'a:1:{i:0;s:9:"Two Large";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 25.0);
    }

    public function testTwoLargeInvalid()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}'], 'deals' => 'a:1:{i:0;s:9:"Two Large";}'])
            ->post('/cart', ['deliverytype' => 'Delivery'])
            ->assertSessionHas('total', 22.0);
    }

    public function testTwoLargeBoundaryOne()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:5:"large";s:8:"toppings";a:1:{i:0;s:6:"Cheese";}s:5:"price";d:12.15;}', 'a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:5:"large";s:8:"toppings";a:1:{i:0;s:6:"Cheese";}s:5:"price";d:12.15;}'], 'deals' => 'a:1:{i:0;s:9:"Two Large";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 24.3);
    }

    public function testTwoLargeBoundaryTwo()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:5:"large";s:8:"toppings";a:1:{i:0;s:6:"Cheese";}s:5:"price";d:12.15;}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}'], 'deals' => 'a:1:{i:0;s:9:"Two Large";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 23.15);
    }

    public function testTwoMediumNormal()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}', 'a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}'], 'deals' => 'a:1:{i:0;s:10:"Two Medium";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 18.0);
    }

    public function testTwoMediumInvalid()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}', 'a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}'], 'deals' => 'a:1:{i:0;s:10:"Two Medium";}'])
            ->post('/cart', ['deliverytype' => 'Delivery'])
            ->assertSessionHas('total', 29.0);
    }

    public function testTwoMediumBoundaryOne()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:6:"medium";s:8:"toppings";a:1:{i:0;s:6:"Cheese";}s:5:"price";d:10;}', 'a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:6:"medium";s:8:"toppings";a:1:{i:0;s:6:"Cheese";}s:5:"price";d:10;}'], 'deals' => 'a:1:{i:0;s:10:"Two Medium";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 20.0);
    }

    public function testTwoMediumBoundaryTwo()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:6:"medium";s:8:"toppings";a:1:{i:0;s:6:"Cheese";}s:5:"price";d:10;}', 'a:4:{s:4:"name";s:14:"Gimme the Meat";s:4:"size";s:6:"medium";s:8:"toppings";a:6:{i:0;s:9:"pepperoni";i:1;s:3:"ham";i:2;s:7:"chicken";i:3;s:11:"minced beef";i:4;s:7:"sausage";i:5;s:5:"bacon";}s:5:"price";s:5:"14.50";}'], 'deals' => 'a:1:{i:0;s:10:"Two Medium";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 24.5);
    }

    public function testTwoSmallNormal()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"small";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"8.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"small";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"8.00";}'], 'deals' => 'a:1:{i:0;s:9:"Two Small";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 12.0);
    }

    public function testTwoSmallInvalid()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"small";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"8.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"small";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"8.00";}'], 'deals' => 'a:1:{i:0;s:9:"Two Small";}'])
            ->post('/cart', ['deliverytype' => 'Delivery'])
            ->assertSessionHas('total', 16.0);
    }

    public function testTwoSmallBoundaryOne()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:5:"small";s:8:"toppings";a:1:{i:0;s:6:"Cheese";}s:5:"price";d:8.9;}', 'a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:5:"small";s:8:"toppings";a:1:{i:0;s:6:"Cheese";}s:5:"price";d:8.9;}'], 'deals' => 'a:1:{i:0;s:9:"Two Small";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 17.8);
    }

    public function testTwoSmallBoundaryTwo()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:15:"Create Your Own";s:4:"size";s:5:"small";s:8:"toppings";a:1:{i:0;s:6:"Cheese";}s:5:"price";d:8.9;}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"small";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"8.00";}'], 'deals' => 'a:1:{i:0;s:9:"Two Small";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 16.9);
    }

    public function testMultipleDealsPass()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}'], 'deals' => 'a:2:{i:0;s:20:"Two for One Tuesdays";i:1;s:9:"Two Large";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 36.0);
    }

    public function testMultipleDealsPassFail()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"large";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:5:"11.00";}'], 'deals' => 'a:2:{i:0;s:20:"Two for One Tuesdays";i:1;s:9:"Two Large";}'])
            ->post('/cart', ['deliverytype' => 'Delivery'])
            ->assertSessionHas('total', 33.0);
    }

    public function testMultipleDealsFail()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:5:"small";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"8.00";}'], 'deals' => 'a:2:{i:0;s:20:"Two for One Tuesdays";i:1;s:9:"Two Large";}'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 8.0);
    }

    public function testNoDeals()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}'], 'deals' => 'N;'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertSessionHas('total', 18.0);
    }

    public function testAuthenticatedSaveOrder()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}'], 'deals' => 'N;'])
            ->post('/cart/save')
            ->assertOk();
    }

    public function testUnauthenticatedSaveOrder()
    {

        $this->followingRedirects()
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}'], 'deals' => 'N;'])
            ->post('/cart/save')
            ->assertViewIs('auth.login');
    }

    public function testAuthenticatedRetrieveOrder()
    {
        $user = User::factory()->create();

        $this->followingRedirects()->actingAs($user)
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}'], 'deals' => 'N;'])
            ->post('/cart/save');
            
        $this->followingRedirects()->actingAs($user)
            ->post('/cart/clear');

        $this->followingRedirects()->actingAs($user)
            ->post('/cart/load')
            ->assertSessionHas('order', ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}']);
    }

    public function testUnauthenticatedRetrieveOrder()
    {

        $this->followingRedirects()
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}'], 'deals' => 'N;'])
            ->post('/cart/load')
            ->assertViewIs('auth.login');
    }

    public function testUnauthenticatedCheckout()
    {
        $this->followingRedirects()
            ->withSession(['order' => ['a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}', 'a:4:{s:4:"name";s:8:"Original";s:4:"size";s:6:"medium";s:8:"toppings";a:2:{i:0;s:6:"cheese";i:1;s:12:"tomato sauce";}s:5:"price";s:4:"9.00";}'], 'deals' => 'N;'])
            ->post('/cart', ['deliverytype' => 'Collection'])
            ->assertViewIs('auth.login');
    }
}

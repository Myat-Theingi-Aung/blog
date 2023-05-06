<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Factory::create();

        $admin           = new Admin();
        $admin->name     = 'Admin';
        $admin->email    = 'admin@gmail.com';
        $admin->phone    = '09 123123123';
        $admin->address  = 'Yangon';
        $admin->password = Hash::make('admin');
        $admin->save();

        // Category
        $category = new Category();
        $category->name = 'Laptop';
        $category->save();

        $category = new Category();
        $category->name = 'Watch';
        $category->save();

        $category = new Category();
        $category->name = 'Phone';
        $category->save();

        $category = new Category();
        $category->name = 'Car';
        $category->save();

        $category = new Category();
        $category->name = 'Bag';
        $category->save();

        //User
        User::factory(6)->has(
            Product::factory()->count(2)
        )->create();

        $categories = Category::all();

        //Populate the pivot table
        Product::all()->each(function ($product) use ($categories) { 
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            ); 
        });
    }
}

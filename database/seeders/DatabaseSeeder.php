<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use App\Models\Country;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);
         Country::create(['name' => 'United Kingdom']);
         Country::create(['name' => 'Ukraine']);
         City::create(['country_id'=> 1,'name' => 'London']);
         City::create(['country_id'=> 1,'name' => 'Liverpool']);
         City::create(['country_id'=> 1,'name' => 'Leicester']);
         City::create(['country_id'=> 2,'name' => 'Kiev']);
         City::create(['country_id'=> 2,'name' => 'Lviv']);
         City::create(['country_id'=> 2,'name' => 'Sambir']);

         Tag::create(['name' => 'Laravel','slug' => 'Laravel']);
         Tag::create(['name' => 'Vue JS','slug' => 'Vue JS']);
         Tag::create(['name' => 'TailwindCSS','slug' => 'TailwindCSS']);
    }
}

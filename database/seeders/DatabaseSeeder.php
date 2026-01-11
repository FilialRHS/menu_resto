<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::factory()->create([
            'name' => 'Admin Restaurant',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Create Categories
        $food = Category::create(['name' => 'Makanan Utama', 'description' => 'Hidangan utama yang lezat']);
        $drink = Category::create(['name' => 'Minuman', 'description' => 'Minuman segar pelepas dahaga']);
        $snack = Category::create(['name' => 'Cemilan', 'description' => 'Cemilan ringan']);

        // 3. Create Menu Items
        Menu::create([
            'name' => 'Nasi Goreng Spesial',
            'description' => 'Nasi goreng dengan topping ayam, telur mata sapi, dan kerupuk udang.',
            'price' => 25000,
            'category_id' => $food->id,
            // 'image' => left null to test the placeholder
        ]);

        Menu::create([
            'name' => 'Ayam Bakar Madu',
            'description' => 'Ayam bakar dengan olesan madu murni, disajikan dengan lalapan segar.',
            'price' => 30000,
            'category_id' => $food->id,
        ]);

        Menu::create([
            'name' => 'Es Teh Manis Jumbo',
            'description' => 'Teh manis dingin ukuran jumbo yang menyegarkan.',
            'price' => 5000,
            'category_id' => $drink->id,
        ]);

        Menu::create([
            'name' => 'Jus Alpukat',
            'description' => 'Jus alpukat kental dengan susu cokelat.',
            'price' => 15000,
            'category_id' => $drink->id,
        ]);
        
        Menu::create([
            'name' => 'Kentang Goreng',
            'description' => 'Kentang goreng renyah dengan bumbu bbq.',
            'price' => 12000,
            'category_id' => $snack->id,
        ]);

        // 4. Create Normal Customer (optional, just for testing auth)
        User::factory()->create([
            'name' => 'Customer 1',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'pembeli',
        ]);
    }
}

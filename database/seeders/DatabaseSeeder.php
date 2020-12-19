<?php

namespace Database\Seeders;

use App\Models\Dealings;
use App\Models\Merchant;
use App\Models\Receiver;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'User',
            'mobile' => 8977999999,
            'email_verified_at' => now(),
            'role' => 'user',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        User::create([
            'name' => 'Mechant',
            'mobile' => 8999999997,
            'email_verified_at' => now(),
            'role' => 'merchant',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        $reciever = User::create([
            'name' => 'Reciever',
            'mobile' => 8999,
            'email_verified_at' => now(),
            'role' => 'reciever',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        $reciever->deposit('50');
        Merchant::create([
            'shop_name' => 'NGO',
            'shop_type' => 'food',
            'city' => 'Mumbai',
            'user_id' => 2
        ]);
        Receiver::create([
            'age' => 54,
            'merchants_by' => 1,
            'user_id' => 3,
        ]);
        Dealings::create([
            'reciever_id' => 3,
            'user_or_merchant_id' => 1,
            'type' => 'donation',
            'amount' => 50
        ]);
    }
}

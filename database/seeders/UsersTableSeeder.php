<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => env('SUPERADMIN_LOGIN', 'admin'),
            'email' => env('SUPERADMIN_EMAIL', 'admin@admin.ndd'),
            'password' => Hash::make(env('SUPERADMIN_PASSWORD', 'admin')),
            'is_admin' => true
        ]);
    }
}

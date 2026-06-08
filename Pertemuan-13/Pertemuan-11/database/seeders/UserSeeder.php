<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run(): void
    {
       User::firstOrCreate(
    ['email' => 'admin1@gmail.com'],
    [
        'name' => 'Admin Satu',
        'password' => Hash::make('admin123'),
    ]
);

User::firstOrCreate(
    ['email' => 'admin2@gmail.com'],
    [
        'name' => 'Admin Dua',
        'password' => Hash::make('admin123'),
    ]
);

User::firstOrCreate(
    ['email' => 'admin3@gmail.com'],
    [
        'name' => 'Admin Tiga',
        'password' => Hash::make('admin123'),
    ]
);
    }
}
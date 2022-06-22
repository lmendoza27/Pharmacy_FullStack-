<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Luis Angel Mendoza Chate', 'email' => 'lmendoza@autonoma.edu.pe', 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'],
        ];
        foreach ($data as $value) {
            DB::table('users')->insert(
                [
                    'name' => $value['name'],
                    'email' => $value['email'],
                    'password' => $value['password']
                ]
                );
        }
    }
}

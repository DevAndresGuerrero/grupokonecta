<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gk.com',
            'password' => '$2y$10$kSUx82IxHy2uS6CjHEvKlu1bqlwGq5JUFZ85iUGEOVarEx2ZjY3BS',
            'role' => 'ADMINISTRATOR'
        ]);

        User::create([
            'name' => 'Seller',
            'email' => 'seller@gk.com',
            'password' => '$2y$10$f0BttVhTJtRkwQQtB3n.R.Tj0MdHGFUFyNsQvUexgghmo/5ir5fse',
            'role' => 'SELLER'
        ]);
    }
}

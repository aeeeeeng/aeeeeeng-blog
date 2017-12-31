<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        Admin::create([
          'name' => 'Syahril Ardi',
          'email' => 'aeeeeeng@gmail.com',
          'password' => bcrypt("aengganteng"),
          'admin_image' => '20171231101818.png',
        ])
    }
}

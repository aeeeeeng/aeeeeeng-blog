<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Category::create([
          "category_name" => "Tes ayah",
          "category_image" => "20180102090918.jpg",
          "parent_of_category" => 0,
        ]);
    }
}

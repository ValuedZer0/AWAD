<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Fiction', 'slug' => 'fiction', 'description' => 'Novels and fictional stories'],
            ['name' => 'Non-Fiction', 'slug' => 'non-fiction', 'description' => 'Educational and informative books'],
            ['name' => 'Science Fiction', 'slug' => 'science-fiction', 'description' => 'Science fiction and fantasy novels'],
            ['name' => 'Mystery', 'slug' => 'mystery', 'description' => 'Mystery and thriller books'],
            ['name' => 'Romance', 'slug' => 'romance', 'description' => 'Romance and love stories'],
            ['name' => 'Biography', 'slug' => 'biography', 'description' => 'Biographies and memoirs'],
            ['name' => 'Self-Help', 'slug' => 'self-help', 'description' => 'Personal development books'],
            ['name' => 'Children', 'slug' => 'children', 'description' => 'Books for children'],
            ['name' => 'Young Adult', 'slug' => 'young-adult', 'description' => 'Young adult fiction'],
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Technology and programming books'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

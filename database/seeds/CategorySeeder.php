<?php

use Domain\Category\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $clothing = Category::create([
            'slug' => 'clothing',
            'en' => ['name' => 'Clothing'],
            'se' => ['name' => 'Kläder'],
            'tl' => ['name' => 'Damit'],
        ]);

        Category::create([
            'slug' => 'dresses',
            'en' => ['name' => 'Dresses'],
            'se' => ['name' => 'Klänningar'],
            'tl' => ['name' => 'Dresses'],
        ], $clothing);

        Category::create([
            'slug' => 'sweaters',
            'en' => ['name' => 'Sweaters'],
            'se' => ['name' => 'Tröjor'],
            'tl' => ['name' => 'Sweaters'],
        ], $clothing);

        Category::create([
            'slug' => 'shirts',
            'en' => ['name' => 'Shirts'],
            'se' => ['name' => 'Skjortor'],
            'tl' => ['name' => 'Shirts'],
        ], $clothing);

        Category::create([
            'slug' => 't-shirts',
            'en' => ['name' => 'T-shirts'],
            'se' => ['name' => 'T-shirts'],
            'tl' => ['name' => 'T-shirts'],
        ], $clothing);

        Category::create([
            'slug' => 'shorts',
            'en' => ['name' => 'Shorts'],
            'se' => ['name' => 'Shorts'],
            'tl' => ['name' => 'Shorts'],
        ], $clothing);

        $pants = Category::create([
            'slug' => 'pants',
            'en' => ['name' => 'Pants'],
            'se' => ['name' => 'Byxor'],
            'tl' => ['name' => 'Pantalon'],
        ], $clothing);

        Category::create([
            'slug' => 'jeans',
            'en' => ['name' => 'Jeans'],
            'se' => ['name' => 'Jeans'],
            'tl' => ['name' => 'Jeans'],
        ], $pants);

        Category::create([
            'slug' => 'slacks',
            'en' => ['name' => 'Slacks'],
            'se' => ['name' => 'Slacks'],
            'tl' => ['name' => 'Slacks'],
        ], $pants);
    }
}

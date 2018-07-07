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
            'sv' => ['name' => 'Kläder'],
            'tl' => ['name' => 'Damit'],
        ]);

        Category::create([
            'slug' => 'dresses',
            'en' => ['name' => 'Dresses'],
            'sv' => ['name' => 'Klänningar'],
            'tl' => ['name' => 'Dresses'],
        ], $clothing);

        Category::create([
            'slug' => 'sweaters',
            'en' => ['name' => 'Sweaters'],
            'sv' => ['name' => 'Tröjor'],
            'tl' => ['name' => 'Sweaters'],
        ], $clothing);

        Category::create([
            'slug' => 'shirts',
            'en' => ['name' => 'Shirts'],
            'sv' => ['name' => 'Skjortor'],
            'tl' => ['name' => 'Shirts'],
        ], $clothing);

        Category::create([
            'slug' => 't-shirts',
            'en' => ['name' => 'T-shirts'],
            'sv' => ['name' => 'T-shirts'],
            'tl' => ['name' => 'T-shirts'],
        ], $clothing);

        Category::create([
            'slug' => 'shorts',
            'en' => ['name' => 'Shorts'],
            'sv' => ['name' => 'Shorts'],
            'tl' => ['name' => 'Shorts'],
        ], $clothing);

        $pants = Category::create([
            'slug' => 'pants',
            'en' => ['name' => 'Pants'],
            'sv' => ['name' => 'Byxor'],
            'tl' => ['name' => 'Pantalon'],
        ], $clothing);

        Category::create([
            'slug' => 'jeans',
            'en' => ['name' => 'Jeans'],
            'sv' => ['name' => 'Jeans'],
            'tl' => ['name' => 'Jeans'],
        ], $pants);

        Category::create([
            'slug' => 'slacks',
            'en' => ['name' => 'Slacks'],
            'sv' => ['name' => 'Slacks'],
            'tl' => ['name' => 'Slacks'],
        ], $pants);
    }
}

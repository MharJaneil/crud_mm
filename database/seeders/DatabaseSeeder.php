<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Devices and gadgets'],
            ['name' => 'Furniture', 'description' => 'Household items and furnishings'],
            ['name' => 'Clothing', 'description' => 'Apparel and accessories'],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);

            $items = [
                ['name' => 'Laptop', 'description' => 'A high-performance laptop', 'price' => 999.99, 'quantity' => 10, 'category_id' => $category->id],
                ['name' => 'Smartphone', 'description' => 'A latest model smartphone', 'price' => 799.99, 'quantity' => 20, 'category_id' => $category->id],
                ['name' => 'Sofa', 'description' => 'Comfortable three-seater sofa', 'price' => 499.99, 'quantity' => 5, 'category_id' => $category->id],
                ['name' => 'Dining Table', 'description' => 'Wooden dining table for six', 'price' => 299.99, 'quantity' => 3, 'category_id' => $category->id],
                ['name' => 'T-shirt', 'description' => 'Cotton t-shirt in various colors', 'price' => 19.99, 'quantity' => 50, 'category_id' => $category->id],
                ['name' => 'Jeans', 'description' => 'Denim jeans available in different sizes', 'price' => 39.99, 'quantity' => 30, 'category_id' => $category->id],
            ];

            foreach ($items as $itemData) {
                Item::create($itemData);
            }
        }
    }
}
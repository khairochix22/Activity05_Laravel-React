<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory(5)->create();
        $products = Product::factory(2000)
            ->recycle($categories)
            ->create();

        $users = User::factory(20)->create();

        $users->each(function (User $user): void {
            Address::factory(random_int(1, 2))
                ->for($user)
                ->create();
        });

        $orders = $users->flatMap(function (User $user) {
            return Order::factory(random_int(0, 5))
                ->for($user)
                ->create();
        });

        $orders->each(function (Order $order) use ($products): void {
            $products->random(random_int(1, 4))->each(function (Product $product) use ($order): void {
                OrderProduct::factory()
                    ->for($order)
                    ->for($product)
                    ->create();
            });
        });

        $products->each(function (Product $product) use ($users): void {
            $users->random(random_int(0, 8))->each(function (User $user) use ($product): void {
                Review::factory()
                    ->for($user)
                    ->for($product)
                    ->create();
            });
        });
    }
}

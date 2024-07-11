<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\CookingMethod;
use App\Models\Dish;
use App\Models\Branch;
use App\Models\Kitchen;
use App\Models\Table;
use App\Models\User;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\KitchenCookingMethod;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jsonFilePath = './database/seeders/data.json';
        $jsonContent = file_get_contents($jsonFilePath);
        $dataArray = json_decode($jsonContent, true);

        foreach ($dataArray['categories'] as $row) {
            Category::create([
                "name" => $row['name'],
                "image" => $row['image'],
            ]);
        }

        foreach ($dataArray['foods'] as $row) {
            Food::create([
                "category_id" => $row['category_id'],
                "name" => $row['name'],
                "price" => $row['price'],
                "image" => $row['image'],
            ]);
        }

        foreach ($dataArray['cooking_methods'] as $row) {
            CookingMethod::create([
                "name" => $row['name'],
            ]);
        }

        foreach ($dataArray['dishes'] as $row) {
            Dish::create([
                "food_id" => $row['food_id'],
                "cooking_method_id" => $row['cooking_method_id'],
                "additional_price" => $row['additional_price'],
                "note" => $row['note'],
            ]);
        }

        foreach ($dataArray['branches'] as $row) {
            Branch::create([
                "name" => $row['name'],
            ]);
        }

        foreach ($dataArray['kitchens'] as $row) {
            Kitchen::create([
                "name" => $row['name'],
                "image" => $row['image'],
                "branch_id" => $row['branch_id'],
            ]);
        }

        $recordCount = 0;
        foreach ($dataArray['tables'] as $row) {
            $recordCount++; // Tăng biến đếm
            $id = $recordCount <= 2 ? $row['id'] : \Ramsey\Uuid\Uuid::uuid4()->toString();
                Table::create([
                    "id" => $id,
                    "table_number" => $row['tables_number'],
                    "branch_id" => $row['branch_id'],
                    "status" => isset($row['status']) ? $row['status'] : 0,
                ]);
        }

        foreach ($dataArray['users'] as $row) {
            User::create([
                "branch_id" => $row['branch_id'],
                "username" => $row['username'],
                "password" => Hash::make($row['password']),
                "role" => $row['role'],
            ]);
        }

        foreach ($dataArray['bills'] as $row) {
            Bill::create([
                "table_id" => $row['table_id'],
                "branch_id" => $row['branch_id'],
                "user_id" => $row['user_id'],
                "time_in" => $row['time_in'],
                'total' => $row['total'],
                "pay_status" => $row['pay_status']
            ]);
        }

        foreach ($dataArray['bill_details'] as $row) {
            BillDetail::create([
                "bill_id" => $row['bill_id'],
                "dish_id" => $row['dish_id'],
                "quantity" => $row['quantity'],
                "price" => $row['price'],
                "status" => $row['status'],
            ]);
        }

        foreach ($dataArray['kitchen_cooking_method'] as $row) {
            KitchenCookingMethod::create([
                'kitchen_id' => $row['kitchen_id'],
                'cooking_method_id' => $row['cooking_method_id']
            ]);
        }
    }
}

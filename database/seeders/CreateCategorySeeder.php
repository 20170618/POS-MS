<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CreateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'CategoryName' => 'Frozen Food',
                'Description' => 'This category contains food that are frozen.'
            ],
            [
                'CategoryName' => 'Dairy',
                'Description' => 'This category contains dairy products.'
            ],
            [
                'CategoryName' => 'Prime Commodities',
                'Description' => 'This category contains prime commodities.'
            ],
            [
                'CategoryName' => 'Laundry',
                'Description' => 'This category contains laundry products.'
            ],
            [
                'CategoryName' => 'Personal Care',
                'Description' => 'This category contains personal care products.'
            ],
            [
                'CategoryName' => 'School Supplies',
                'Description' => 'This category contains school supply products.'
            ],
            [
                'CategoryName' => 'Liquor',
                'Description' => 'This category contains liquor products.'
            ],
            [
                'CategoryName' => 'Cigarettes',
                'Description' => 'This category contains cigarette products.'
            ],
            [
                'CategoryName' => 'E-Load & SIM',
                'Description' => 'This category contains E-Load and SIM products.'
            ],
        ];

        foreach ($category as $key => $value) {
            Category::create($value);
        }
    }
}

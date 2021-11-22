<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class CreateProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
            Category:
            E-Load Regular
            E-load Promo
            Consumable
            Non-
        */
        $product = [

            [
                'ProductName' => 'Porkchop',
                'Category' => '1', //CategoryID
                'Price' => '90',
                'Stock' => '50',
                'Description' => 'a loin cut taken perpendicular to the spine of the pig and is usually a rib or part of a vertebra.',
            ],
            [
                'ProductName' => 'Half Chicken',
                'Category' => '1', //CategoryID
                'Price' => '85',
                'Stock' => '50',
                'Description' => 'Frozen half of a chicken.',
            ],
            [
                'ProductName' => 'Sliced Ham',
                'Category' => '1', //CategoryID
                'Price' => '60',
                'Stock' => '50',
                'Description' => '1/2 inch thick slices of ham.',
            ],
            [
                'ProductName' => 'Dari Creme',
                'Category' => '2', //CategoryID
                'Price' => '37',
                'Stock' => '50',
                'Description' => 'a Premium table refrigerated margarine made from special oil blends.',
            ],
            [
                'ProductName' => 'Fresh Milk',
                'Category' => '2', //CategoryID
                'Price' => '45',
                'Stock' => '50',
                'Description' => 'milk which has not been dehydrated, rehydrated or reconstituted in whole or in part',
            ],
            [
                'ProductName' => 'Evaporated Milk',
                'Category' => '2', //CategoryID
                'Price' => '15',
                'Stock' => '50',
                'Description' => 'unsweetened condensed milk.',
            ],
            [
                'ProductName' => 'Lard',
                'Category' => '3', //CategoryID
                'Price' => '26',
                'Stock' => '50',
                'Description' => 'a semi-solid white fat product.',
            ],
            [
                'ProductName' => 'White Sugar',
                'Category' => '3', //CategoryID
                'Price' => '32',
                'Stock' => '50',
                'Description' => 'Refined sugar grinded into smaller sizes.',
            ],
            [
                'ProductName' => 'Rose Vinegar',
                'Category' => '3', //CategoryID
                'Price' => '10',
                'Stock' => '50',
                'Description' => 'a mild vinegar.',
            ],
            [
                'ProductName' => 'Tide',
                'Category' => '4', //CategoryID
                'Price' => '12',
                'Stock' => '50',
                'Description' => 'a type of laundry detergent',
            ],
            [
                'ProductName' => 'Surf',
                'Category' => '4', //CategoryID
                'Price' => '10',
                'Stock' => '50',
                'Description' => 'a type of powdered detergent',
            ],
            [
                'ProductName' => 'Breeze',
                'Category' => '4', //CategoryID
                'Price' => '10',
                'Stock' => '50',
                'Description' => 'a type of laundry detergent',
            ],
            [
                'ProductName' => 'Safeguard',
                'Category' => '5', //CategoryID
                'Price' => '20',
                'Stock' => '50',
                'Description' => 'a soap that eliminates 99% of bacteria.',
            ],
            [
                'ProductName' => 'Rexona Deo Sachet',
                'Category' => '5', //CategoryID
                'Price' => '10',
                'Stock' => '50',
                'Description' => 'A type of deo lotion.',
            ],
            [
                'ProductName' => 'Ph Care Sachet',
                'Category' => '5', //CategoryID
                'Price' => '8',
                'Stock' => '50',
                'Description' => 'A brand of intimate wash.',
            ],
            [
                'ProductName' => 'Masking Tape',
                'Category' => '6', //CategoryID
                'Price' => '50',
                'Stock' => '50',
                'Description' => 'a type of pressure-sensitive tape made of a thin and easy-to-tear paper, and an easily released pressure-sensitive adhesive. It is available in a variety of widths.',
            ],
            [
                'ProductName' => 'Short Bond Paper',
                'Category' => '6', //CategoryID
                'Price' => '0.75',
                'Stock' => '50',
                'Description' => 'Paper used for printing that has a size of 8.5″ x 11″ in inches.',
            ],
            [
                'ProductName' => 'Long Bond Paper',
                'Category' => '6', //CategoryID
                'Price' => '1',
                'Stock' => '50',
                'Description' => 'Paper used for printing that has a size of 8.5" x 14" in inches.',
            ],
            [
                'ProductName' => 'Ginebra San Miguel Gin',
                'Category' => '7', //CategoryID
                'Price' => '65',
                'Stock' => '50',
                'Description' => 'a type of gin.',
            ],
            [
                'ProductName' => 'The Bar Pink',
                'Category' => '7', //CategoryID
                'Price' => '120',
                'Stock' => '50',
                'Description' => 'a brand of flavored gin.',
            ],
            [
                'ProductName' => 'GSM Blue Mojito',
                'Category' => '7', //CategoryID
                'Price' => '125',
                'Stock' => '50',
                'Description' => 'a brand of flavored light gin.',
            ],
            [
                'ProductName' => 'Marlboro Red',
                'Category' => '8', //CategoryID
                'Price' => '8',
                'Stock' => '50',
                'Description' => 'a brand of cigarette.',
            ],
            [
                'ProductName' => 'Fortune Red',
                'Category' => '8', //CategoryID
                'Price' => '7',
                'Stock' => '50',
                'Description' => 'a brand of cigarette.',
            ],
            [
                'ProductName' => 'Fortune Green',
                'Category' => '8', //CategoryID
                'Price' => '7',
                'Stock' => '50',
                'Description' => 'a brand of cigarette.',
            ],
            [
                'ProductName' => 'AT10',
                'Category' => '9', //CategoryID
                'Price' => '15',
                'Stock' => '50',
                'Description' => 'Unli SMS to all networks + 100MB of Facebook + Unli Viber, valid for 1 day.',
            ],
            [
                'ProductName' => 'UTP15',
                'Category' => '9', //CategoryID
                'Price' => '20',
                'Stock' => '50',
                'Description' => 'Unli SMS and calls to TNT/Smart/Sun Cellular + 50 texts to all networks + 30MB per day mobile data allowance.',
            ],
            [
                'ProductName' => 'UCT25',
                'Category' => '9', //CategoryID
                'Price' => '30',
                'Stock' => '50',
                'Description' => 'unlimited calls & texts to Smart/TNT/Sun, 50 texts to other networks, Free FB & Viber, valid for 1 day.',
            ],
            [
                'ProductName' => 'Coke Mismo',
                'Category' => '10', //CategoryID
                'Price' => '15',
                'Stock' => '50',
                'Description' => 'Solo-sized coke.',
            ],
            [
                'ProductName' => 'Sprite Mismo',
                'Category' => '10', //CategoryID
                'Price' => '15',
                'Stock' => '50',
                'Description' => 'Solo-sized sprite.',
            ],
            [
                'ProductName' => 'C2 Solo',
                'Category' => '10', //CategoryID
                'Price' => '12',
                'Stock' => '50',
                'Description' => 'Solo-sized C2.',
            ],



        ];

        foreach ($product as $key => $value) {
            Product::create($value);
        }
    }
}

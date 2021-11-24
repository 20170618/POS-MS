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
            Non-Consumable
        */
        $product = [
            [
                'ProductName' => 'Smart/TNT Regular Load',
                'Category' => 'E-Load Regular', //CategoryID
                'Price' => null,
                'Stock' => '25000',
            ],
            [
                'ProductName' => 'Globe/TM Regular Load',
                'Category' => 'E-Load Regular', //CategoryID
                'Price' => null,
                'Stock' => '25000',
            ],
            [
                'ProductName' => 'Sun Regular Load',
                'Category' => 'E-Load Regular', //CategoryID
                'Price' => null,
                'Stock' => '25000',
            ],
            [
                'ProductName' => 'Porkchop Loin 1KG',
                'Category' => 'Consumable', //CategoryID
                'Price' => '90',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'Half Chicken 1/2KG',
                'Category' => 'Consumable', //CategoryID
                'Price' => '85',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'Cooked Ham 250g',
                'Category' => 'Consumable', //CategoryID
                'Price' => '60',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'Dari Creme 100g',
                'Category' => 'Consumable', //CategoryID
                'Price' => '37',
                'Stock' => '50',
                
            ],
            [
                'ProductName' => 'Fresh Milk 250ml',
                'Category' => 'Consumable', //CategoryID
                'Price' => '45',
                'Stock' => '50',
              
            ],
            [
                'ProductName' => 'Evaporated Milk 140ml',
                'Category' => 'Consumable', //CategoryID
                'Price' => '15',
                'Stock' => '50',
                
            ],
            [
                'ProductName' => 'Lard 1/4kg',
                'Category' => 'Consumable', //CategoryID
                'Price' => '26',
                'Stock' => '50',
                
            ],
            [
                'ProductName' => 'White Sugar 1/4kg',
                'Category' => 'Consumable', //CategoryID
                'Price' => '32',
                'Stock' => '50',
                
            ],
            [
                'ProductName' => 'Rose Vinegar 200ml',
                'Category' => 'Consumable', //CategoryID
                'Price' => '10',
                'Stock' => '50',
                
            ],
            [
                'ProductName' => 'Tide Powder Detergent 80g',
                'Category' => 'Non-Consumable', //CategoryID
                'Price' => '12',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'Surf Powder Detergent 74g',
                'Category' => 'Non-Consumable', //CategoryID
                'Price' => '10',
                'Stock' => '50',
                
            ],
            [
                'ProductName' => 'Breeze Powder Detergent 66g',
                'Category' => 'Non-Consumable', //CategoryID
                'Price' => '10',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'Safeguard Bar Soap 60g (Sachet)',
                'Category' => 'Non-Consumable', //CategoryID
                'Price' => '20',
                'Stock' => '50',
                
            ],
            [
                'ProductName' => 'Rexona Deodorant Sachet 3ml',
                'Category' => 'Non-Consumable', //CategoryID
                'Price' => '10',
                'Stock' => '50',
                
            ],
            [
                'ProductName' => 'Ph Care intimate wash Sachet 5ml',
                'Category' => 'Non-Consumable', //CategoryID
                'Price' => '8',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'Masking Tape 1.5 inch',
                'Category' => 'Non-Consumable', //CategoryID
                'Price' => '50',
                'Stock' => '50',
            
            ],
            [
                'ProductName' => 'Short Bond Paper (1 sheet)',
                'Category' => 'Non-Consumable', //CategoryID
                'Price' => '0.75',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'Long Bond Paper (1 sheet)',
                'Category' => 'Non-Consumable', //CategoryID
                'Price' => '1',
                'Stock' => '50',
              
            ],
            [
                'ProductName' => 'Ginebra San Miguel Gin 350ml',
                'Category' => 'Consumable', //CategoryID
                'Price' => '65',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'The Bar Pink 700ml',
                'Category' => 'Consumable', //CategoryID
                'Price' => '120',
                'Stock' => '50',
            
            ],
            [
                'ProductName' => 'GSM Blue Mojito 700ml',
                'Category' => 'Consumable', //CategoryID
                'Price' => '125',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'Marlboro Red (1 Stick)',
                'Category' => 'Consumable', //CategoryID
                'Price' => '8',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'Fortune Red (1 Stick)',
                'Category' => 'Consumable', //CategoryID
                'Price' => '7',
                'Stock' => '50',
                
            ],
            [
                'ProductName' => 'Fortune Green (1 Stick)',
                'Category' => 'Consumable', //CategoryID
                'Price' => '7',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'SMART AT10',
                'Category' => 'E-Load Promo', //CategoryID
                'Price' => '15',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'TNT UTP15',
                'Category' => 'E-Load Promo', //CategoryID
                'Price' => '20',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'SMART UCT25',
                'Category' => 'E-Load Promo', //CategoryID
                'Price' => '30',
                'Stock' => '50',
                
            ],
            [
                'ProductName' => 'Coke Mismo 295ml',
                'Category' => 'Consumable', //CategoryID
                'Price' => '15',
                'Stock' => '50',
             
            ],
            [
                'ProductName' => 'Sprite Mismo 295ml',
                'Category' => 'Consumable', //CategoryID
                'Price' => '15',
                'Stock' => '50',
               
            ],
            [
                'ProductName' => 'C2 Solo 295ml',
                'Category' => 'Consumable', //CategoryID
                'Price' => '12',
                'Stock' => '50',
                
            ],



        ];

        foreach ($product as $key => $value) {
            Product::create($value);
        }

    }
}

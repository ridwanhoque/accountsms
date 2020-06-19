<?php

use App\Color;
use App\Product;
use App\RawMaterial;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $raw_materials = ['PET', 'PP', 'PPF', 'HIPS', 'LDPE', 'PVC'];

        //products made of PET raw material

        //products made of raw material PP

        //products made of raw material PPF

        //products made of raw material HIPS

        //products made of raw material LDPE

        //products made of raw material HDPE

        //products made of raw amterial PVC
        $product_colors =
            [
            'PET' => [
                ['Ice Cup Lid New-3F1140', 'Natural-0'], ['Sauce Cup Lid-3F10.30', 'Natural-0'],
                ['½-¼ kg Bati Lid-3F13.50', 'Natural-0'], ['½-¼ kg Bati Lid-3F13.51', 'White-1'],
                ['350ml Cool Cop Lid -12.50', 'Natural-0'], ['Dom Lid-PET(PUNCH)-3F140', 'Natural-0'],
                ['Desert Cup-3F160', 'Natural-0'], ['250ml Glass Lid(Normal)- 3F11.50', 'Natural-0'],
                ['3 Chamber Cookies-IF140', 'Natural-0'], ['Bengle Pineappel-IF140', 'Natural-0'],
                ['3 Chamber Pineapple -IF140(Partison)', 'Natural-0'], ['3 Chamber Pineapple-IF150', 'Natural-0'],
                ['All Time-3F13.50', 'Natural-0'], ['Big Dry Cake-IF1160', 'Natural-0'],
                ['Small Dry Cake-IF170', 'Natural-0'], ['Choco Fudge- IF1100', 'Natural-0'],
                ['Cookies Tray-3F14.50', 'Natural-0'], ['Energy Haque-IF190', 'Natural-0'],
                ['Energy-CF190', 'Natural-0'], ['First Choice-CF1120', 'Natural-0'],
                ['Horlickes-CF1100', 'Natural-0'], ['Horlickes-CF1120', 'Natural-0'],
                ['Horlickes-CF190', 'Natural-0'], ['Kheer Malai- CF1130', 'Natural-0'],
                ['Kinder Joy Tray-IF1100', 'Natural-0'], ['Lunch Box Big (Premium)-CF1200', 'Natural-0'],
                ['Lunch Box Small (Premium)-3F1130', 'Natural-0'], ['Magic Ball Small-IF1180', 'Natural-0'],
                ['Marie Gold-IF1120', 'Natural-0'], ['Nutty(Partison)-IF1120', 'Natural-0'],
                ['Nutty-CF1100', 'Natural-0'], ['Plane Toast-IF1130', 'Natural-0'],
                ['Sauce Cup-TF11.50', 'Natural-0'], ['Sauce Cup-TF11.51', 'White-1'],
                ['Slice Cake -3F13.250', 'Natural-0'], ['Soft Cake 45-CF130', 'Natural-0'],
                ['Soft Cake 90-3F15.50', 'Natural-0'], ['Solto-CF161', 'White-1'],
                ['Sor Malai-CF1100', 'Natural-0'], ['Tik Tok(Pran)-CF15.20', 'Natural-0'],
                ['All Time -IF140', 'Natural-0'], ['4 Chember Cookies -IF1100', 'Natural-0'],
                ['Egg Tray (Small) -CF1300', 'Natural-0'], ['Kishowan Dry Cake -IF1120', 'Natural-0'],
                ['Nutty Romania -IF1121', 'White-1'], ['Butter Toast -IF1100', 'Natural-0'],
                ['Weafer Tray -3F120', 'Natural-0'], ['Plate 11(INCH) -PF1160', 'Natural-0'],
                ['Desert Cup Lid -IF161', 'Natural-0'], ['Ice Cup Lid (Polar) -3F11.50', 'Natural-0'],
                ['Dum Lid(Pet Glass) -3F140', 'Natural-0'], ['Milk Cookies - CF1100', 'Natural-0'],
                ['Coil Tray -IF140', 'Natural-0'], ['Toy Tray(Front Part) -CF1190', 'Natural-0'],
                ['Toy Tray(Back Part) -CF1290', 'Natural-0'], ['Toy Tray(Bottom Part) -CF120', 'Natural-0'],
                ['Big Baby Tray -1601', 'White-1'], ['Small Baby Tray-1351', 'White-1'],
            ],
            'PP' => [
                ['½ kg Bati(Design)-TF5101', 'White-1'], ['½ kg Bati(Design)-TF5102', 'Black-2'], ['½ kg Bati-TF590', 'Natural-0'], ['½ kg Bati-TF591', 'White-1'], ['½ kg Bati-TF592', 'Black-2'], ['¼ kg Bati-TF570', 'Natural-0'], ['¼ kg Bati-TF571', 'White-1'], ['100ml Coffee Cup-TF51.80', 'Natural-0'], ['180ml glass-TF52.11', 'White-1'], ['180ml glass-TF52.50 Mota', 'Natural-0'], ['200ml Glass(US BANGLA)-TF54.50', 'Natural-0'], ['350ml glass-TF590', 'Natural-0'], ['450ml glass-TF590', 'Natural-0'], ['70ml Ice Cup -52.50', 'Natural-0'], ['80ml coffee cup(TANIA)-TF52.50', 'Natural-0'], ['80ml Ice Cup-TF52.41', 'White-1'], ['90 ml Ice Cup Premium-TF52.70', 'Natural-0'], ['90ml Coffee Cup-TF51.80', 'Natural-0'], ['IGLOO Ice Cup Print-PP541', 'White-1'], ['POLAR Ice cup Print-TF540', 'Natural-0'],
            ],
            'PPF' => [
                ['3 Chember Plate -PF9101', 'White-1'], ['4 Chember Chicken Tray -PF9251', 'White-1'], ['4 Chember Chicken Tray -PF9254', 'Red-4'],
                ['4 Chember Lunch Box Big-PF9353', 'Green-3'], ['4 Chember Lunch Box Small -PF9301', 'White-1'], ['4 Chember Plate -PF9101', 'White-1'],
                ['4 Chember With Lid -PF9261', 'White-1'], ['5 Chamber Lunch Box -PF9461', 'White-1'], ['5 Chamber Lunch Box -PF9601', 'White-1'],
                ['5 Chember Lunch Box Lid-PF9201', 'White-1'], ['Burger Box-PF9201', 'White-1'], ['Burger Box-PF9253', 'Green-3'],
                ['First Food Tray -PF9101', 'White-1'], ['Grill Box -PF9251(Premium)', 'White-1'], ['Lunch Box Big (Premium)-PF9201', 'White-1'],
                ['Lunch Box(M) -PF9151', 'White-1'], ['Lunch Box(M) -PF9165', 'Yellow-5'], ['Lunch Box(S)-PF981', 'White-1'], ['Noodles Box -991', 'White-1'],
                ['Plate 10.5(Inch)-PF9121', 'White-1'], ['Plate 10.5(Inch)-PF9144', 'Red/White'], ['Plate 10.5(Inch)-PF9184', 'Red/White'], ['Plate 8(Inch) 18 GM', 'White-1'],
                ['T-Burger -PF9241', 'White-1'], ['T-Burger -PF9243', 'Green-3'], ['Thai Burger -9121', 'White-1'], ['Misty Tray  -PF9271', 'White-1'],
                ['Plate 11 (Inch) -PF9153', 'Green-3'], ['4 Chember Lunch Box -2 -PF9351', 'White-1'], ['Grill Box (Premium) -PF9305', 'Yellow-5'],
                ['Plate 6(Inch) -PF941', 'White-1'], ['Plate 6(Inch) -PF9051', 'White-1'], ['Plate 8 (Inch) -PF9081', 'White-1'], ['Plate 10.5(Inch) -PF9281', 'White-1'],
                ['4 Chamber Lunch Box -PF9354', 'Red-4'], ['Burger Box (Premium) -PF9211', 'White-1'], ['First Food Tray -PF9123', 'Green-3'],
                ['4 Chamber Lid -PF9201', 'White-1'], ['4 Chamber Lid -PF9204', 'Red-4'], ['Plate 10.5"(INCH) -PF9281', 'White-1'],
            ],
            'HIPS' => [
                ['½-¼ kg Bati Lid-3F63.51', 'White-1'], ['250ml Hot Cup Lid Big -3F631', 'White-1'], ['350ml Hot Cup Lid -3F642', 'Black-2'], ['350ml Hot Cup Lid -3F641', 'White-1'], ['Agriculture Tray(104)-IF61002', 'Black-2'], ['Big Dry Cake-IF6161', 'White-1'], ['Big Nuddles-CF6111', 'White-1'], ['Bisconi Chocolate Chips Cookies-IF6221', 'White-1'], ['Chocko fun-3F68.51', 'White-1'], ['Coil Tray -IF65.52', 'Black-2'], ['Ice Cup Lid New-3F61.41', 'White-1'], ['Ice Cup Lid Old -3F611', 'White-1'], ['Nice Tray -IF681', 'White-1'], ['Small Dry Cake-IF671', 'White-1'], ['Go Nut Tray -IF6161', 'White-1'], ['Sup Spoon -3F61.71', 'White-1'], ['4 Pocket Cookies Tray -671', 'White-1'], ['Desert Cup -661', 'White-1'],
            ],
            'LDPE' => [
                ['Ice Loly Big -LDPE', 'Natural-1'],
                ['Ice Loly Small -BM42.30', 'Natural-1'],

            ],
            'HDPE' => [
                ['Lichy Drink Bollol Big -BM280', 'Natural-1'],
                ['Lichy Drink Bollol Small -HDPE', 'Natural-1'],

            ],
            'PVC' => [
                ['210 mm container -CN3400', 'Natural-0'], ['120 mm(5.25 (Inch) container  -CN3300', 'Natural-0'], ['120 mm(6.25 (Inch) container -CN3350', 'Natural-0'],
                ['105 mm Container -CN3250', 'Natural-0'],
            ],
        ];

        // $product_colors = array_merge($pet_product_colors, $pp_product_colors, $ppf_product_colors, $hips_product_colors, $ldpe_product_colors, $hdpe_products_colors, $pvc_product_colors);

        foreach ($product_colors as $key => $product_color) {
            foreach($product_color as $prod_color){
                $color_id = Color::where('name', $prod_color[1])->first()->id;
                $raw_material_id = RawMaterial::where('name', $key)->first()->id;
                Product::create([
                    'company_id' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                    'raw_material_id' => $raw_material_id,
                    'machine_id' => 1,
                    'color_id' => $color_id,
                    'expected_quantity' => 0,
                    'standard_weight' => 0,
                    'name' => $prod_color[0]
                ]);    
            }
        }

    }
}

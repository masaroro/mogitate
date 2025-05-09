<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class ProductSeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        $seasons = Season::all()->keyBy('name');

        $productSeasons = [
            'キウイ' => ['秋', '冬'],
            'ストロベリー' => ['春'],
            'オレンジ' => ['冬'],
            'スイカ' => ['夏'],
            'ピーチ' => ['夏'],
            'シャインマスカット' => ['夏', '秋'],
            'パイナップル' => ['春', '夏'],
            'ブドウ' => ['夏', '秋'],
            'バナナ' => ['春', '夏', '秋', '冬'],
            'メロン' => ['夏'],
        ];

        foreach ($products as $product) {
            $seasonNames = $productSeasons[$product->name] ?? [];
            foreach ($seasonNames as $seasonName) {
                $seasonId = $seasons[$seasonName]->id ?? null;
                if ($seasonId) {
                    DB::table('product_season')->insert([
                        'product_id' => $product->id,
                        'season_id' => $seasonId,
                    ]);
                }
            }
        }

    }
}

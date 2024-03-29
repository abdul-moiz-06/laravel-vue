<?php

namespace Database\Seeders;

use App\Models\ExtraItem;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Console',
                'price' => 100,
                'max_extras' => 4
            ],
            [
                'name' => 'Microwave',
                'price' => 150,
                'max_extras' => 0
            ],
            [
                'name' => 'Television',
                'price' => 200,
                'max_extras' => '-1'
            ]
        ];

        foreach ($items as $item) {
            $model = Item::whereName($item['name'])->first();
            if ($model){
                $model->price = $item['price'];
                $model->max_extras = $item['max_extras'];
                $model->save();
            }else{
                $model = new Item();
                $model->name = $item['name'];
                $model->price = $item['price'];
                $model->max_extras = $item['max_extras'];
                $model->save();
            }
        }

        $extraItems = [
            [
                'name' => 'Remote Controller',
                'price' => 20
            ],
            [
                'name' => 'Wired Controller',
                'price' => 15
            ]
        ];

        foreach ($extraItems as $extraItem) {
            $model = ExtraItem::whereName($extraItem['name'])->first();
            if ($model){
                $model->price = $extraItem['price'];
                $model->max_extras = $extraItem['max_extras'];
                $model->save();
            }else{
                $model = new ExtraItem();
                $model->name = $extraItem['name'];
                $model->price = $extraItem['price'];
                $model->save();
            }
        }
    }
}

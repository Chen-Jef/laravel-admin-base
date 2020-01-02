<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->delete();
        for($i = 0; $i < 3; $i++ ){
            DB::table('categories')->insert(
                [
                    'name' => 'CAT'.$i,
                    'description' => 'desc_'.$i,
                    'order' => $i,
                    'parent_id' => null
                ]
            );
        }

    }
}

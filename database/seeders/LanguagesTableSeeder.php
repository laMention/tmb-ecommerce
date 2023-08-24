<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    { 
        // \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'English',
                'flag' => 'en',
                'code' => 'en',
                'is_rtl' => '0',
                'is_active' => '1'
            ),
            1 => array (
                'id' => 2,
                'name' => 'Français',
                'flag' => 'fr',
                'code' => 'fr',
                'is_rtl' => '0',
                'is_active' => '1'
            ),
        )); 
    }
}
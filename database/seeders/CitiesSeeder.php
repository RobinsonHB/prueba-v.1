<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_cities=[
            "Barranquilla",
            "Bogota",
            "Medellin",
            "Cali",
            "Bucaramanga",
            "Pereira",
            "Tunja"
        
        ];

        foreach ($array_cities as  $value) {
            \App\Models\Cities::create([
                "name" => $value
            ]); 
        } 
    }
}

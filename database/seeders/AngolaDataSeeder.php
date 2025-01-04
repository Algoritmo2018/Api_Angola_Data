<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AngolaDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bengo = Province::create([
            'name' => "Bengo"
        ]);
        $benguela = Province::create([
            'name' => "Benguela"
        ]);
        $bie = Province::create([
            'name' => "Bié"
        ]);
        $cabinda = Province::create([
            'name' => "Cabinda"
        ]);
        $cuando = Province::create([
            'name' => "Cuando"
        ]);
        $cubango = Province::create([
            'name' => "Cubango"
        ]);
        $cuanza_norte = Province::create([
            'name' => "Cuanza norte"
        ]);
        $cuanza_sul = Province::create([
            'name' => "Cuanza sul"
        ]);
        $cunene = Province::create([
            'name' => "Cunene"
        ]);
        $huila = Province::create([
            'name' => "Huíla"
        ]);
        $Icolo = Province::create([
            'name' => "Icolo"
        ]);
        $Bengo = Province::create([
            'name' => "Bengo"
        ]);
        $Luanda = Province::create([
            'name' => "Luanda"
        ]);
        $Lunda_norte = Province::create([
            'name' => "Lunda norte"
        ]);
        $Lunda_sul = Province::create([
            'name' => "Lunda sul"
        ]);
        $Malanje = Province::create([
            'name' => "Malanje"
        ]);
        $Moxico = Province::create([
            'name' => "Moxico"
        ]);
        $Moxico_leste = Province::create([
            'name' => "Moxico Leste"
        ]);
        $Namibe = Province::create([
            'name' => "Namibe"
        ]);
        $Uige = Province::create([
            'name' => "Uige"
        ]);
        $Zaire = Province::create([
            'name' => "Zaire"
        ]);
    }
}

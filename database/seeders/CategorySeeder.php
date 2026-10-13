<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            'Arredamento',
            'Elettrodomestici',
            'Informatica',
            'Abbigliamento',
            'Sport e Tempo Libero',
            'Giardinaggio',
            'Libri e Riviste',
            'Giochi e Videogiochi',
            'Motori',
            'Strumenti Musicali'
        ];


        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName
            ]);
        }
    }
}

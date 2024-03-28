<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /*
     * Run the database seeds.
     */
    public function run(): void
    {
        // untuk mengkosongkan data yang ada pada table dan mengisi kembali
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'komik', 'novel', 'fantasi', 'horor', 'romantis'
        ];

        foreach($data as $item) {
            Category::insert([
                'name' => $item,
            ]);
        };
    }
}

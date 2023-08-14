<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as data;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Barang::create([
            'judul' => 'Iphone Rusak',
            'laporan' => 'Rusak ketika sedang di sortir barang akan dibatalkan pengiriman',
            'status' => 'DIBATALKAN',
            'no_seri' => 'BB00030290CBIP'
        ]);
    }
}

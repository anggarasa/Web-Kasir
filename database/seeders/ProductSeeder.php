<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'nama_produk' => 'Produk 1',
                'harga_produk' => 10000,
                'stok' => 10,
            ],
            [
                'nama_produk' => 'Produk 2',
                'harga_produk' => 20000,
                'stok' => 20,
            ],
            [
                'nama_produk' => 'Produk 3',
                'harga_produk' => 30000,
                'stok' => 30,
            ],
            [
                'nama_produk' => 'Produk 4',
                'harga_produk' => 40000,
                'stok' => 40,
            ],
            [
                'nama_produk' => 'Produk 5',
                'harga_produk' => 50000,
                'stok' => 50,
            ],
            [
                'nama_produk' => 'Produk 6',
                'harga_produk' => 60000,
                'stok' => 60,
            ],
            [
                'nama_produk' => 'Produk 7',
                'harga_produk' => 70000,
                'stok' => 70,
            ],
            [
                'nama_produk' => 'Produk 8',
                'harga_produk' => 80000,
                'stok' => 80,
            ],
            [
                'nama_produk' => 'Produk 9',
                'harga_produk' => 90000,
                'stok' => 90,
            ],
            [
                'nama_produk' => 'Produk 10',
                'harga_produk' => 100000,
                'stok' => 100,
            ],
            [
                'nama_produk' => 'Produk 11',
                'harga_produk' => 110000,
                'stok' => 110,
            ],
            [
                'nama_produk' => 'Produk 12',
                'harga_produk' => 120000,
                'stok' => 120,
            ],
            [
                'nama_produk' => 'Produk 13',
                'harga_produk' => 130000,
                'stok' => 130,
            ],
            [
                'nama_produk' => 'Produk 14',
                'harga_produk' => 140000,
                'stok' => 140,
            ],
            [
                'nama_produk' => 'Produk 15',
                'harga_produk' => 150000,
                'stok' => 150,
            ],
        ]);
    }
}

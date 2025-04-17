<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'nama_produk' => 'Produk 2',
                'harga_produk' => 20000,
                'stok' => 20,
                'created_at' => Carbon::now()->subWeeks(1),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'nama_produk' => 'Produk 3',
                'harga_produk' => 30000,
                'stok' => 30,
                'created_at' => Carbon::now()->subMonths(1),
                'updated_at' => Carbon::now()->subWeeks(3),
            ],
            [
                'nama_produk' => 'Produk 4',
                'harga_produk' => 40000,
                'stok' => 40,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(8),
            ],
            [
                'nama_produk' => 'Produk 5',
                'harga_produk' => 50000,
                'stok' => 50,
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()->subMonths(1),
            ],
            [
                'nama_produk' => 'Produk 6',
                'harga_produk' => 60000,
                'stok' => 60,
                'created_at' => Carbon::now()->subWeeks(2),
                'updated_at' => Carbon::now()->subWeeks(1)->subDays(2),
            ],
            [
                'nama_produk' => 'Produk 7',
                'harga_produk' => 70000,
                'stok' => 70,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'nama_produk' => 'Produk 8',
                'harga_produk' => 80000,
                'stok' => 80,
                'created_at' => Carbon::now()->subMonths(1)->subDays(2),
                'updated_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'nama_produk' => 'Produk 9',
                'harga_produk' => 90000,
                'stok' => 90,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'nama_produk' => 'Produk 10',
                'harga_produk' => 100000,
                'stok' => 100,
                'created_at' => Carbon::now()->subWeeks(3),
                'updated_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'nama_produk' => 'Produk 11',
                'harga_produk' => 110000,
                'stok' => 110,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_produk' => 'Produk 12',
                'harga_produk' => 120000,
                'stok' => 120,
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(2)->subDays(4),
            ],
            [
                'nama_produk' => 'Produk 13',
                'harga_produk' => 130000,
                'stok' => 130,
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(18),
            ],
            [
                'nama_produk' => 'Produk 14',
                'harga_produk' => 140000,
                'stok' => 140,
                'created_at' => Carbon::now()->subWeeks(4),
                'updated_at' => Carbon::now()->subWeeks(3),
            ],
            [
                'nama_produk' => 'Produk 15',
                'harga_produk' => 150000,
                'stok' => 150,
                'created_at' => Carbon::now()->subMonths(1)->subWeeks(1),
                'updated_at' => Carbon::now()->subWeeks(1),
            ],
        ]);
    }
}

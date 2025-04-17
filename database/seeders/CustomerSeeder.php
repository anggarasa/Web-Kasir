<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggans')->insert([
            [
                'nama' => 'John Doe',
                'username' => 'johndoe',
                'alamat' => 'Jalan Raya No. 1',
                'no_hp' => '08123456789',
                'tgl_lahir' => '1990-01-01',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'nama' => 'Jane Doe',
                'username' => 'janedoe',
                'alamat' => 'Jalan Raya No. 2',
                'no_hp' => '08123456780',
                'tgl_lahir' => '1991-02-02',
                'created_at' => Carbon::now()->subWeeks(1),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'nama' => 'Richard Lee',
                'username' => 'richardlee',
                'alamat' => 'Jalan Raya No. 3',
                'no_hp' => '08123456781',
                'tgl_lahir' => '1992-03-03',
                'created_at' => Carbon::now()->subMonths(1),
                'updated_at' => Carbon::now()->subWeeks(3),
            ],
            [
                'nama' => 'Emily Chen',
                'username' => 'emilychen',
                'alamat' => 'Jalan Raya No. 4',
                'no_hp' => '08123456782',
                'tgl_lahir' => '1993-04-04',
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(8),
            ],
            [
                'nama' => 'Michael Brown',
                'username' => 'michaelbrown',
                'alamat' => 'Jalan Raya No. 5',
                'no_hp' => '08123456783',
                'tgl_lahir' => '1994-05-05',
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()->subMonths(1),
            ],
            [
                'nama' => 'Sarah Taylor',
                'username' => 'sarahtaylor',
                'alamat' => 'Jalan Raya No. 6',
                'no_hp' => '08123456784',
                'tgl_lahir' => '1995-06-06',
                'created_at' => Carbon::now()->subWeeks(2),
                'updated_at' => Carbon::now()->subWeeks(1)->subDays(2),
            ],
            [
                'nama' => 'William White',
                'username' => 'williamwhite',
                'alamat' => 'Jalan Raya No. 7',
                'no_hp' => '08123456785',
                'tgl_lahir' => '1996-07-07',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'nama' => 'Olivia Martin',
                'username' => 'oliviamartin',
                'alamat' => 'Jalan Raya No. 8',
                'no_hp' => '08123456786',
                'tgl_lahir' => '1997-08-08',
                'created_at' => Carbon::now()->subMonths(1)->subDays(2),
                'updated_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'nama' => 'James Davis',
                'username' => 'jamesdavis',
                'alamat' => 'Jalan Raya No. 9',
                'no_hp' => '08123456787',
                'tgl_lahir' => '1998-09-09',
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'nama' => 'Ava Garcia',
                'username' => 'avgarcia',
                'alamat' => 'Jalan Raya No. 10',
                'no_hp' => '08123456788',
                'tgl_lahir' => '1999-10-10',
                'created_at' => Carbon::now()->subWeeks(3),
                'updated_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'nama' => 'Ethan Hall',
                'username' => 'ethanhall',
                'alamat' => 'Jalan Raya No. 11',
                'no_hp' => '08123456789',
                'tgl_lahir' => '2000-11-11',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Lily Patel',
                'username' => 'lilypatel',
                'alamat' => 'Jalan Raya No. 12',
                'no_hp' => '08123456780',
                'tgl_lahir' => '2001-12-12',
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subMonths(2)->subDays(4),
            ],
            [
                'nama' => 'Noah Kim',
                'username' => 'noahkim',
                'alamat' => 'Jalan Raya No. 13',
                'no_hp' => '08123456781',
                'tgl_lahir' => '2002-01-01',
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(18),
            ],
            [
                'nama' => 'Sophia Lee',
                'username' => 'sophialee',
                'alamat' => 'Jalan Raya No. 14',
                'no_hp' => '08123456782',
                'tgl_lahir' => '2003-02-02',
                'created_at' => Carbon::now()->subWeeks(4),
                'updated_at' => Carbon::now()->subWeeks(3),
            ],
            [
                'nama' => 'Alexander Brooks',
                'username' => 'alexanderbrooks',
                'alamat' => 'Jalan Raya No. 15',
                'no_hp' => '08123456783',
                'tgl_lahir' => '2004-03-03',
                'created_at' => Carbon::now()->subMonths(1)->subWeeks(1),
                'updated_at' => Carbon::now()->subWeeks(1),
            ],
        ]);
    }
}

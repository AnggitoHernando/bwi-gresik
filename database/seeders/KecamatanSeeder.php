<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kecamatans')->insert(
            [
                [
                    'nama_kecamatan' => 'Gresik',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Kebomas',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Duduksampeyan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Cerme',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Menganti',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Kedamean',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Wringinanom',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Driyorejo',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Manyar',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Bungah',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Sidayu',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Panceng',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Ujungpangkah',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Dukun',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Tambak',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Sangkapura',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Benjeng',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_kecamatan' => 'Balongpanggang',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]

        );
    }
}

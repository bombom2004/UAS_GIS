<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Add Data User
        User::create([
            'name' => 'Jihadul Akbar',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        // Add Data Pengaturan
        Pengaturan::create([
            'nama_app' => "Peta Lombok Tengah",
            'singkatan' => "PLT",
            'logo' => "1701154338.png",
            'latitude' => "-8.6631487",
            'longitude' => "116.2848176",
            'zoom' => "9",
        ]);
        //Add Data Kategori
        $kategoriData = [
            [
                'id' => 1, 
                'kategori'=> 'Umum', 
                'icon' => 'fa fa-bookmark', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2, 
                'kategori'=> 'Infrastruktur', 
                'icon' => 'fa fa-road', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3, 
                'kategori'=> 'Tanggap Covid-19', 
                'icon' => 'fa fa-safari', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4, 
                'kategori'=> 'Pariwisata', 
                'icon' => 'fa fa-diamond', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5, 
                'kategori'=> 'Pertanian dan Perkebunan', 
                'icon' => 'fa fa-tree', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6, 
                'kategori'=> 'Perikanan dan Peternakan', 
                'icon' => 'fa fa-codepen', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7, 
                'kategori'=> 'Lalu Lintas', 
                'icon' => 'fa fa-car', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8, 
                'kategori'=> 'Ekonomi', 
                'icon' => 'fa fa-bar-chart', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 9, 
                'kategori'=> 'Pendidikan', 
                'icon' => 'fa fa-book', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 10, 
                'kategori'=> 'Sosial', 
                'icon' => 'fa fa-smile-o', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 11, 
                'kategori'=> 'Kesehatan', 
                'icon' => 'fa fa-hospital-o', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 12, 
                'kategori'=> 'Seni dan Budaya', 
                'icon' => 'fa fa-tencent-weibo', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 13, 
                'kategori'=> 'Tempat Ibadah', 
                'icon' => 'fa fa fa-university', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 14, 
                'kategori'=> 'Setra/Kuburan', 
                'icon' => 'fa fa-stop', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 15, 
                'kategori'=> 'SD', 
                'icon' => 'fa fa-home', 
                'parent_id' => 9, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 16, 
                'kategori'=> 'SMP', 
                'icon' => 'fa fa-home', 
                'parent_id' => 9, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 17, 
                'kategori'=> 'SMA', 
                'icon' => 'fa fa-home', 
                'parent_id' => 9, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 18, 
                'kategori'=> 'SMK', 
                'icon' => 'fa fa-home', 
                'parent_id' => 9, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 19, 
                'kategori'=> 'TK / PAUD', 
                'icon' => 'fa fa-home', 
                'parent_id' => 0, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 20, 
                'kategori'=> 'SLB', 
                'icon' => 'fa fa-home', 
                'parent_id' => 9, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'id' => 21, 
                'kategori'=> 'Kursus / Privat', 
                'icon' => 'fa fa-home', 
                'parent_id' => 9, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 22, 
                'kategori'=> 'Rumah Sakit', 
                'icon' => 'fa fa-home', 
                'parent_id' => 11, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 23, 
                'kategori'=> 'Puskesmas', 
                'icon' => 'fa fa-home', 
                'parent_id' => 11, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 24, 
                'kategori'=> 'Klinik / Praktik Dokter', 
                'icon' => 'fa fa-home', 
                'parent_id' => 11, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 25, 
                'kategori'=> 'Farmasi', 
                'icon' => 'fa fa-home', 
                'parent_id' => 11, 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        Kategori::insert($kategoriData);
    }
}

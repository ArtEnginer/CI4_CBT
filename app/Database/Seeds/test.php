<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;
use Myth\Auth\Password;

class Test extends Seeder
{
    public function run()
    {
        // mahasiswa
        $faker = Factory::create('id_ID');
        $nim = 42419001;
        for ($i = 0; $i < 30; $i++) {
            $data[] = [
                'nim'           => $nim++,
                'nama'          => $faker->name(),
                'alamat'        => $faker->address(),
                'tahun_masuk'   => 2019,
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ];
        }
        $nim = 42420001;
        for ($i = 0; $i < 30; $i++) {
            $data[] = [
                'nim'           => $nim++,
                'nama'          => $faker->name(),
                'alamat'        => $faker->address(),
                'tahun_masuk'   => 2020,
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ];
        }
        $this->db->table('cbt_mahasiswa')->insertBatch($data);

        // Dosen
        $data = [];
        $nip = 1002001;
        for ($i = 0; $i < 15; $i++) {
            $data[] = [
                'nip'           => $nip++,
                'nama'          => $faker->name(),
                'alamat'        => $faker->address(),
                'created_at'    => Time::now(),
                'updated_at'    => Time::now(),
            ];
        }
        $this->db->table('cbt_dosen')->insertBatch($data);

        // Admin
        $data = [
            [
                'nama' => 'Admin',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];
        $this->db->table('cbt_admin')->insertBatch($data);

        // matkul
        $data = [
            [
                'sks' => '3',
                'nama' => 'Dasar Pemrograman',
                'semester' => '4',
                'ruang_id' => '1',
                'dosen_id' => '1',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'sks' => '3',
                'nama' => 'Pemrograman Berorientasi Objek',
                'semester' => '4',
                'ruang_id' => '3',
                'dosen_id' => '2',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'sks' => '4',
                'nama' => 'Pemrograman Terstruktur',
                'semester' => '6',
                'ruang_id' => '3',
                'dosen_id' => '3',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'sks' => '3',
                'nama' => 'Rangkaian Digital',
                'semester' => '6',
                'ruang_id' => '4',
                'dosen_id' => '4',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];
        $this->db->table('cbt_matakuliah')->insertBatch($data);

        // ruang
        $data = [
            [
                'nama' => 'R201',
                'tampung' => '25',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'R202',
                'tampung' => '25',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'R301',
                'tampung' => '25',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'R302',
                'tampung' => '25',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];
        $this->db->table('cbt_ruang')->insertBatch($data);

        // Kuliah
        $data = [];
        for ($j = 0; $j < 2; $j++) {
            $matkul = $j == 0 ? 3 : 4;
            for ($i = 1; $i <= 30; $i++) {
                $data[] = [
                    'mahasiswa_id'  => $i,
                    'matakuliah_id' => $matkul,
                    'tahun'         => 2022,
                    'created_at'    => Time::now(),
                    'updated_at'    => Time::now(),
                ];
            }
        }
        for ($j = 0; $j < 2; $j++) {
            $matkul = $j == 0 ? 1 : 2;
            for ($i = 31; $i <= 60; $i++) {
                $data[] = [
                    'mahasiswa_id'  => $i,
                    'matakuliah_id' => $matkul,
                    'tahun'         => 2022,
                    'created_at'    => Time::now(),
                    'updated_at'    => Time::now(),
                ];
            }
        }
        $this->db->table('cbt_kuliah')->insertBatch($data);


        // Ujian
        $data = [
            [
                'matkul_id' => '1',
                'ruang_id' => '1',
                'waktu' => '2022-08-11 18:30:00',
                'tenggat' => 120,
                'tipe' => 'UTS',
                'soal_pilgan' => null,
                'soal_essay' => null,
                'token_ujian' => bin2hex(random_bytes(16)),
                'token_akses' => strtoupper(bin2hex(random_bytes(4))),
                'status' => 0,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'matkul_id' => '2',
                'ruang_id' => '2',
                'waktu' => '2022-08-11 18:30:00',
                'tenggat' => 120,
                'tipe' => 'UTS',
                'soal_pilgan' => null,
                'soal_essay' => null,
                'token_ujian' => bin2hex(random_bytes(16)),
                'token_akses' => strtoupper(bin2hex(random_bytes(4))),
                'status' => 0,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'matkul_id' => '3',
                'ruang_id' => '3',
                'waktu' => '2022-08-11 18:30:00',
                'tenggat' => 120,
                'tipe' => 'UTS',
                'soal_pilgan' => null,
                'soal_essay' => null,
                'token_ujian' => bin2hex(random_bytes(16)),
                'token_akses' => strtoupper(bin2hex(random_bytes(4))),
                'status' => 0,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],

        ];
        $this->db->table('cbt_ujian')->insertBatch($data);


        // group users
        $data = [
            [
                'name' => 'Admin',
                'description' => 'Administrator',
            ],
            [
                'name' => 'Mahasiswa',
                'description' => 'Mahasiswa',
            ],
            [
                'name' => 'Dosen',
                'description' => 'Dosen Pengajar',
            ],
        ];

        // Using Query Builder
        $this->db->table('auth_groups')->insertBatch($data);

        // USERS
        $data = [
            [
                'detail_id'     => 1,
                'email'         => 'admin@cbt.com',
                'username'      => 'admin',
                'password_hash' => Password::hash('12345'),
                'active'        => 1,
                'created_at'    => Time::now('Asia/Jakarta', 'id_ID'),
                'updated_at'    => Time::now('Asia/Jakarta', 'id_ID')
            ],
        ];
        $nim = 42419001;
        for ($i = 1; $i <= 60; $i++) {
            $nim = $i == 31 ? 42420001 : $nim;
            $data[] = [
                'detail_id'     => $i,
                'email'         => $faker->freeEmail(),
                'username'      => $nim++,
                'password_hash' => Password::hash('12345'),
                'active'        => 1,
                'created_at'    => Time::now('Asia/Jakarta', 'id_ID'),
                'updated_at'    => Time::now('Asia/Jakarta', 'id_ID')
            ];
        }
        $nip = 1002001;
        for ($i = 1; $i <= 15; $i++) {
            $data[] = [
                'detail_id'     => $i,
                'email'         => $faker->freeEmail(),
                'username'      => $nip++,
                'password_hash' => Password::hash('12345'),
                'active'        => 1,
                'created_at'    => Time::now('Asia/Jakarta', 'id_ID'),
                'updated_at'    => Time::now('Asia/Jakarta', 'id_ID')
            ];
        }

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);

        $data = [
            [
                'group_id'   => 1,
                'user_id'    => 1
            ],
        ];
        $g = 2;
        for ($i = 2; $i <= 76; $i++) {
            $g = $i == 62 ? 3 : $g;
            $data[] = [
                'group_id'   => $g,
                'user_id'    => $i
            ];
        }

        // Using Query Builder
        $this->db->table('auth_groups_users')->insertBatch($data);
    }
}
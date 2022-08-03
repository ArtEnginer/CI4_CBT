<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Myth\Auth\Password;

class Test extends Seeder
{
    public function run()
    {
        // mahasiswa
        $data = [
            [
                'nim' => '42421676',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'tahun_masuk' => '2020',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nim' => '42421677',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'tahun_masuk' => '2020',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nim' => '42421678',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'tahun_masuk' => '2020',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nim' => '42421679',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'tahun_masuk' => '2020',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nim' => '42421680',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'tahun_masuk' => '2020',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nim' => '42421681',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'tahun_masuk' => '2020',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nim' => '42421682',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'tahun_masuk' => '2020',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];
        $this->db->table('cbt_mahasiswa')->insertBatch($data);

        // Dosen
        $data = [
            [
                'nip' => '123456789',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nip' => '123456789',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nip' => '123456789',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nip' => '123456789',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nip' => '123456789',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nip' => '123456789',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nip' => '123456789',
                'nama' => 'Rizki',
                'alamat' => 'Jl. Raya',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];
        $this->db->table('cbt_dosen')->insertBatch($data);

        // matkul
        $data = [
            [
                'sks' => '3',
                'nama' => 'Dasar Pemrograman',
                'semester' => '1',
                'ruang_id' => '1',
                'dosen_id' => '1',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'sks' => '3',
                'nama' => 'Pemrograman OOP',
                'semester' => '1',
                'ruang_id' => '2',
                'dosen_id' => '1',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];
        $this->db->table('cbt_matakuliah')->insertBatch($data);

        // ruang
        $data = [
            [
                'nama' => 'R1',
                'tampung' => '25',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'R2',
                'tampung' => '25',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
            [
                'nama' => 'R3',
                'tampung' => '25',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ],
        ];
        $this->db->table('cbt_ruang')->insertBatch($data);

        // Kuliah
        $data = [
            [
                'mahasiswa_id' => '1',
                'matakuliah_id' => '1',
                'tahun' => '2020',
                'uas' => '80',
                'uts' => '80',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),

            ],
            [
                'mahasiswa_id' => '2',
                'matakuliah_id' => '2',
                'tahun' => '2020',
                'uas' => '80',
                'uts' => '80',
                'created_at' => Time::now(),
                'updated_at' => Time::now(),

            ],

        ];
        $this->db->table('cbt_kuliah')->insertBatch($data);


        // Ujian
        $data = [
            [
                'kuliah_id' => '1',
                'ruang_id' => '1',
                'ruang_id' => '1',
                'waktu' => '2020-01-01',
                'tenggat' => 100,
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
                'kuliah_id' => '2',
                'ruang_id' => '2',
                'ruang_id' => '2',
                'waktu' => '2020-06-01',
                'tenggat' => 100,
                'tipe' => 'UAS',
                'soal_pilgan' => null,
                'soal_essay' => null,
                'token_ujian' => bin2hex(random_bytes(16)),
                'token_akses' => strtoupper(bin2hex(random_bytes(4))),
                'status' => 0,
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ]

        ];
        $this->db->table('cbt_ujian')->insertBatch($data);


        // group users
        $data = [
            [
                'name' => 'Admin',
                'description' => 'Administrator',
            ],
            [
                'name' => 'User',
                'description' => 'Mahasiswa',
            ],
        ];

        // Using Query Builder
        $this->db->table('auth_groups')->insertBatch($data);

        // USERS
        $data = [
            [
                'email'         => 'hrd@sipk.com',
                'username'      => 'hrd',
                'user_id'      => '1',
                'password_hash' => Password::hash('12345'),
                'active'        => 1,
                'created_at'    => Time::now('Asia/Jakarta', 'id_ID'),
                'updated_at'    => Time::now('Asia/Jakarta', 'id_ID')
            ],
            [
                'email'         => 'admin@sipk.com',
                'username'      => 'admin',
                'user_id'      => '2',
                'password_hash' => Password::hash('12345'),
                'active'        => 1,
                'created_at'    => Time::now('Asia/Jakarta', 'id_ID'),
                'updated_at'    => Time::now('Asia/Jakarta', 'id_ID')
            ],


        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);

        $data = [
            [
                'group_id'   => 1,
                'user_id'    => 2
            ],
            [
                'group_id'   => 2,
                'user_id'    => 1
            ],

        ];

        // Using Query Builder
        $this->db->table('auth_groups_users')->insertBatch($data);
    }
}
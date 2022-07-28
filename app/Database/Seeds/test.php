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
                'fullname'      => 'Awaldin zaman',
                'password_hash' => Password::hash('12345'),
                'active'        => 1,
                'created_at'    => Time::now('Asia/Jakarta', 'id_ID'),
                'updated_at'    => Time::now('Asia/Jakarta', 'id_ID')
            ],
            [
                'email'         => 'admin@sipk.com',
                'username'      => 'admin',
                'fullname'      => 'Tedi Sujana',
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
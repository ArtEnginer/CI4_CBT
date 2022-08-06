<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tablecbt extends Migration
{
    public function up()
    {
        //Mahasiswa
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'tahun_masuk' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cbt_mahasiswa');

        //Dosen
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cbt_dosen');

        //Admin
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cbt_admin');

        // Ruang
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'tampung' => [
                'type' => 'INT',
                'constraint' => 12,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cbt_ruang');

        // Mata Kuliah
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'sks' => [
                'type' => 'INT',
                'constraint' => 12,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'semester' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'ruang_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'dosen_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cbt_matakuliah');

        // Kuliah
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'mahasiswa_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'matakuliah_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],

            'tahun' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'uas' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'uts' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cbt_kuliah');

        // Ujian
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'matkul_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'ruang_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'waktu' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tenggat' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tipe' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'soal_pilgan' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'soal_essay' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'token_ujian' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'token_akses' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 4,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cbt_ujian');
    }

    public function down()
    {
        $this->forge->dropTable('cbt_admin');
        $this->forge->dropTable('cbt_mahasiswa');
        $this->forge->dropTable('cbt_dosen');
        $this->forge->dropTable('cbt_ruang');
        $this->forge->dropTable('cbt_matakuliah');
        $this->forge->dropTable('cbt_kuliah');
        $this->forge->dropTable('cbt_ujian');
    }
}
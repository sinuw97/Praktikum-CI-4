<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kdbrg' => [
                'type' => 'CHAR',
                'constraint' => 5
            ],
            'nmbrg' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'stok' => [
                'type' => 'INT',
                'constraint' => '5',
                'unsigned' => true,
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '9,2',
            ],
            'kategori' => [
                'type' => 'INT',
                'constraint' => '5',
                'unsigned' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('kdbrg');
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}

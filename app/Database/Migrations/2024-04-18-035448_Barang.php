<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kodebrg'       => [
                'type'           => 'CHAR',
                'constraint'     => '10',
            ],
            'namabrg'       => [
                'type'           => 'CHAR',
                'constraint'     => '100',
            ],
            'satuan'       => [
                'type'           => 'CHAR',
                'constraint'     => 10,
            ],
            'hargabeli'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_barang');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_barang');
    }
}

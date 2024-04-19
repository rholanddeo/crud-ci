<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Stock extends Migration
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
            'qtybeli'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_stock');

        $this->forge->addForeignKey('kodebrg', 'tbl_barang', 'kodebrg');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_stock');
    }
}

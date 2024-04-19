<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailBeli extends Migration
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
            'notransaksi'       => [
                'type'           => 'CHAR',
                'constraint'     => '10',
            ],
            'kodebrg'       => [
                'type'           => 'CHAR',
                'constraint'     => '10',
            ],
            'hargabeli'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'qty'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'diskon'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'diskonrp'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'totalrp'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_dbeli');

        $this->forge->addForeignKey('notransaksi', 'tbl_hbeli', 'notransaksi');
        $this->forge->addForeignKey('kodebrg', 'tbl_barang', 'kodebrg');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_dbeli');
    }
}

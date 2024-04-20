<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Hutang extends Migration
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
            'kodespl'       => [
                'type'           => 'CHAR',
                'constraint'     => '10',
            ],
            'tglbeli'       => [
                'type'           => 'DATE',
            ],
            'totalhutang'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'islunas'       => [
                'type'           => 'ENUM',
                'constraint'     => ['Y', 'N'],
                'default'        => 'N',
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'deleted_at DATETIME DEFAULT NULL',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_hutang');

        $this->forge->addForeignKey('notransaksi', 'tbl_hbeli', 'notransaksi');
        $this->forge->addForeignKey('kodespl', 'tbl_suplier', 'id');

    }

    public function down()
    {
        $this->forge->dropTable('tbl_hutang');
    }
}

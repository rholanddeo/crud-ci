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
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'tglbeli'       => [
                'type'           => 'DATE',
            ],
            'totalhutang'       => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
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

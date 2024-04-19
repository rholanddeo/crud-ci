<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Suplier extends Migration
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
            'kodespl'       => [
                'type'           => 'CHAR',
                'constraint'     => '10',
            ],
            'namaspl'       => [
                'type'           => 'CHAR',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_suplier');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_suplier');
    }
}

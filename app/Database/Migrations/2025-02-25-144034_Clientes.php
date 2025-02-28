<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clientes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'cpf' => [
                'type' => 'CHAR',
                'constraint' => '11',
                'null' => true,
            ],
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'cnpj' => [
                'type' => 'CHAR',
                'constraint' => '14',
                'null' => true,
            ],
            'razao_social' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
        ]);
        
        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('clientes');
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
    }
}

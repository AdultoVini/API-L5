<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriarTabelaPedidosCompra extends Migration
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
            'id_cliente' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_produto' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'status' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'default' => '1'
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey('id_cliente', 'clientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_produto', 'produtos', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('pedidos_compra');
    }

    public function down()
    {
        $this->forge->dropTable('pedidos_compra');
    }
}

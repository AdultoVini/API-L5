<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdicionarComentarioPedidos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pedidos_compra', [
            'data_cadastro' => [
                'type'    => 'TIMESTAMP',
                'null'    => false,
            ],
        ]);

        $this->db->query("ALTER TABLE pedidos_compra MODIFY COLUMN data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP");

        $this->db->query("ALTER TABLE `pedidos_compra` MODIFY COLUMN `status` CHAR(1) DEFAULT '1' NOT NULL COMMENT '0 => Cancelado | 1 => Em Aberto | 2 => Pago'");

    }

    public function down()
    {
        $this->forge->dropColumn('pedidos_compra', 'data_cadastro');
    }
}

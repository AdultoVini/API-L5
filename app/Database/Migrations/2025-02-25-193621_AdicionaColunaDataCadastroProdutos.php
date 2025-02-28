<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdicionaColunaDataCadastroProdutos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('produtos', [
            'data_cadastro' => [
                'type'    => 'TIMESTAMP',
                'null'    => false,
            ],
        ]);

       
        $this->db->query("ALTER TABLE produtos MODIFY COLUMN data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
       $this->forge->dropColumn('produtos', 'data_cadastro');
    }
}

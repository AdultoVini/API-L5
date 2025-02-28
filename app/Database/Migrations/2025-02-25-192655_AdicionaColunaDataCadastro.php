<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdicionaColunaDataCadastro extends Migration
{
    public function up()
    {
        $this->forge->addColumn('clientes', [
            'data_cadastro' => [
                'type'    => 'TIMESTAMP',
                'null'    => false,
            ],
        ]);

       
        $this->db->query("ALTER TABLE clientes MODIFY COLUMN data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        $this->db->query("ALTER TABLE clientes ADD CONSTRAINT chk_cpf CHECK (LENGTH(cpf) = 11 OR cpf IS NULL)");
        $this->db->query("ALTER TABLE clientes ADD CONSTRAINT chk_cnpj CHECK (LENGTH(cnpj) = 14 OR cnpj IS NULL)");
    }

    public function down()
    {
       $this->forge->dropColumn('clientes', 'data_cadastro');
    }
}

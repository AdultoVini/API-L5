<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['cpf', 'nome', 'cnpj', 'razao_social'];

    public function GetClientes($arrFiltros = null){

        $clientes = $this->select("clientes.*");

        if(isset($arrFiltros['nome'])){

            $clientes->like("clientes.nome", $arrFiltros['nome'], "both");
        }
        
        if(isset($arrFiltros['razao_social'])){

            $clientes->like("clientes.razao_social", $arrFiltros['razao_social'], "both");
        }

        if(isset($arrFiltros['pagina']) and isset($arrFiltros['porPagina'])){

            return $clientes->paginate($arrFiltros['porPagina'], "default", $arrFiltros['pagina']);
        }

        return $clientes->findAll();
    }
}

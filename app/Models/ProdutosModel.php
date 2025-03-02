<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutosModel extends Model
{
    protected $table = 'produtos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome'];

    public function GetProdutos($arrFiltros = null){

        $produtos = $this->select("produtos.*");

        if(isset($arrFiltros['nome'])){

            $produtos->like("produtos.nome", $arrFiltros['nome'], "both");
        }

        if(isset($arrFiltros['pagina']) and isset($arrFiltros['porPagina'])){

            return $produtos->paginate($arrFiltros['porPagina'], "default", $arrFiltros['pagina']);
        }

        return $produtos->findAll();
    }
}

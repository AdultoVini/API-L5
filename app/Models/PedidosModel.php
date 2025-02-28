<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidosModel extends Model
{
    protected $table = 'pedidos_compra';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_cliente', 'id_produto', 'status'];


    public function GetPedidos($arrFiltros = null){

        $pedidos = $this->select(
            "pedidos_compra.id, 
            pedidos_compra.id_cliente, 
            clientes.nome AS Nome Cliente, 
            pedidos_compra.id_produto, 
            produtos.nome AS Produto, 
            CASE 
                WHEN pedidos_compra.status = 0 THEN 'Cancelado' 
                WHEN pedidos_compra.status = 1 THEN 'Em Aberto' 
                WHEN pedidos_compra.status = 2 THEN 'Pago' 
                ELSE 'Desconhecido' 
            END AS Status_Compra,
            pedidos_compra.data_cadastro AS Data de Cadastro Pedido"
        )
        ->join("clientes", "clientes.id = pedidos_compra.id_cliente", "inner")
        ->join("produtos", "produtos.id = pedidos_compra.id_produto", "inner");

        if(isset($arrFiltros['nome'])){

            $pedidos->like("clientes.nome", $arrFiltros['nome'], "both");
        }

        if(isset($arrFiltros['status'])){

            $pedidos->where("pedidos_compra.status", $arrFiltros['status']);
        }

        if(isset($arrFiltros['pagina']) and isset($arrFiltros['porPagina'])){

            return $pedidos->paginate($arrFiltros['porPagina'], "default", $arrFiltros['pagina']);
        }

        return $pedidos->findAll();
    }

    public function PedidoById($id){

        $pedido = $this->select(
            "pedidos_compra.id, 
            pedidos_compra.id_cliente, 
            clientes.nome AS Nome Cliente, 
            pedidos_compra.id_produto, 
            produtos.nome AS Produto, 
            CASE 
                WHEN pedidos_compra.status = 0 THEN 'Cancelado' 
                WHEN pedidos_compra.status = 1 THEN 'Em Aberto' 
                WHEN pedidos_compra.status = 2 THEN 'Pago' 
                ELSE 'Desconhecido' 
            END AS Status_Compra,
            pedidos_compra.data_cadastro AS Data de Cadastro Pedido"
        )
        ->join("clientes", "clientes.id = pedidos_compra.id_cliente", "inner")
        ->join("produtos", "produtos.id = pedidos_compra.id_produto", "inner");

        return $pedido->find($id);
    }
}

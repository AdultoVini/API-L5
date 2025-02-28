<?php

namespace App\Controllers;

use App\Models\PedidosModel;
use App\Models\ClientesModel;
use App\Models\ProdutosModel;
use Config\Services;
use Exception;

class PedidosController extends BaseController
{
    public function index()
    {

        //Coleto todos os dados enviados via query stringe serão usados para filtrar os registros.
        $arrFiltros = [
            'nome' => $this->request->getGet('nome'),
            'status' => $this->request->getGet('status'),
            'pagina' => $this->request->getGet('pagina'),
            'porPagina' => $this->request->getGet('porPagina')
        ];
        
        $pedidos = new PedidosModel();
        $pedidos = $pedidos->GetPedidos($arrFiltros);
        

        if(empty($pedidos)){

            return $this->response->setStatusCode(404)->setJson([
                "cabecalho" => [
                    "status" => 404,
                    "mensagem" => "Nenhum pedido encontrado!"
                ]
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Consulta realizada com sucesso!"
            ],
            "total registros" => Count($pedidos),
            "retorno" => $pedidos
        ]);
    }

    public function PedidoDetalhes($id){

        $pedido = new PedidosModel();

        $pedido = $pedido->PedidoById($id);
        

        if(empty($pedido)){

            return $this->response->setStatusCode(404)->setJson([
                "cabecalho" => [
                    "status" => 404,
                    "mensagem" => "Nenhum pedido encontrado!"
                ]
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Consulta realizada com sucesso!"
            ],
            "retorno" => $pedido
        ]);
    }

    public function CadastraPedido(){
        try {

            $dados = $this->request->getJSON();
            $pedido = new PedidosModel();
    
            $parametros = $this->VerificaParametros($dados);
    
            if(!$pedido->insert($parametros)){

                throw new \RuntimeException("Falha ao cadastrar dados, verifique os dados enviados!", 400);
            }

            return $this->response->setStatusCode(201)->setJSON([
                "cabecalho" => [
                    "status" => 201,
                    "mensagem" => "Pedido de compra cadastrado com sucesso!"
                ],
                "retorno" => $dados
            ]);

        } catch (\Exception $e) {

            return $this->response->setStatusCode(400)->setJSON([
                "cabecalho" => [
                    "status" => 400,
                    "mensagem" => $e->getMessage()
                ],
                "retorno" => $dados
            ]);
        }


    }

    public function AtualizaPedido($id){
        try {

            $dados = $this->request->getJSON();
            $pedido = new PedidosModel();
    
            $parametros = $this->VerificaParametrosAtualizacao($dados);
    
            if(!$pedido->update($id, $parametros)){

                throw new \RuntimeException("Falha ao atualizar dados, verifique os dados enviados!", 400);
            }

            return $this->response->setStatusCode(200)->setJSON([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Pedido de compra atualizado com sucesso!"
                ],
                "retorno" => $dados
            ]);

        } catch (\Exception $e) {

            return $this->response->setStatusCode(400)->setJSON([
                "cabecalho" => [
                    "status" => 400,
                    "mensagem" => $e->getMessage()
                ],
                "retorno" => $dados
            ]);
        }


    }

    public function DeletaPedido($id){
        try {
            $pedido = new PedidosModel();

            $pedidoDados = $pedido->find($id);

            if(!$pedido->delete($id)){

                throw new Exception("Algo deu errado!");   
            }

            return $this->response->setStatusCode(200)->setJSON([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Pedido de compra deletado com sucesso!"
                ],
                'dados exluidos' => $pedidoDados
            ]);

        } catch (\Exception $e) {
            
            return $this->response->setStatusCode(400)->setJSON([
                "cabecalho" => [
                    "status" => 400,
                    "mensagem" => $e->getMessage()
                ]
            ]);
        }
    }

    public function VerificaParametros($dados){

        if(empty($dados->parametros)){

            throw new Exception("Parametros inválidos, verifique a documentação!", 400);
        }
        
        if(empty($dados->parametros->id_cliente) || empty($dados->parametros->id_produto)){
            
            throw new Exception("Parametros inválidos, verifique a documentação!", 400);
        }

        $cliente = new ClientesModel();
        $produto = new ProdutosModel();

        $clienteExiste = $cliente->where('id', $dados->parametros->id_cliente)->countAllResults() > 0;
        $produtoExiste = $produto->where('id', $dados->parametros->id_produto)->countAllResults() > 0;

        if(!$clienteExiste || !$produtoExiste){
            
            throw new Exception("Cliente ou Produto não existem, verifique a lista clientes e produtos!", 400);
        }

        if(isset($dados->parametros->status)){

            $status = [0, 1, 2];

            if(!in_array($dados->parametros->status, $status)){

                $dados->parametros->status = 1;
            }
        }

        return $dados->parametros;
    }

    public function VerificaParametrosAtualizacao($dados){

        if(empty($dados->parametros)){

            throw new Exception("Parametros inválidos, verifique a documentação!", 400);
        }
        
        if(isset($dados->parametros->id_cliente)){

            $cliente = new ClientesModel();
            $clienteExiste = $cliente->where('id', $dados->parametros->id_cliente)->countAllResults() > 0;

            if(!$clienteExiste){
            
                throw new Exception("Cliente ou Produto não existem, verifique a lista clientes e produtos!", 400);
            }
        }

        if(isset($dados->parametros->id_produto)){

            $produto = new ProdutosModel();
            $produtoExiste = $produto->where('id', $dados->parametros->id_produto)->countAllResults() > 0;

            if(!$produtoExiste){
            
                throw new Exception("Cliente ou Produto não existem, verifique a lista clientes e produtos!", 400);
            }
        }

        if(isset($dados->parametros->status)){

            $status = [0, 1, 2];

            if(!in_array($dados->parametros->status, $status)){

                $dados->parametros->status = 1;
            }
        }

        return $dados->parametros;
    }
}
<?php

namespace App\Controllers;

use App\Models\ProdutosModel;
use Config\Services;
use Exception;

class ProdutoController extends BaseController
{
    public function index()
    {
        $produtos = new ProdutosModel();
        $produtos = $produtos->findAll();

        if(empty($produtos)){

            return $this->response->setStatusCode(404)->setJson([
                "cabecalho" => [
                    "status" => 404,
                    "mensagem" => "Nenhum produto encontrado!"
                ]
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Consulta realizada com sucesso!"
            ],
            "retorno" => $produtos
        ]);
    }

    public function ProdutoDetalhes($id){

        $produtos = new ProdutosModel();
        $produtos = $produtos->find($id);

        if(empty($produtos)){

            return $this->response->setStatusCode(404)->setJson([
                "cabecalho" => [
                    "status" => 404,
                    "mensagem" => "Nenhum produto encontrado!"
                ]
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Consulta realizada com sucesso!"
            ],
            "retorno" => $produtos
        ]);
    }

    public function CadastraProduto(){
        try {

            $produto = new ProdutosModel();

            $dados = $this->request->getJSON();

            $parametros = $this->VerificaParametros($dados);

            if(!$produto->insert($parametros)){

                throw new \RuntimeException("Falha ao cadastrar dados, verifique os dados enviados!", 400);
            }

            return $this->response->setStatusCode(201)->setJSON([
                "cabecalho" => [
                    "status" => 201,
                    "mensagem" => "Produto cadastro com sucesso!"
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

    public function AtualizaProduto($id){
        try {

            $produto = new ProdutosModel();

            $dados = $this->request->getJSON();

            $parametros = $this->VerificaParametros($dados);

            if(!$produto->update($id, $parametros)){

                throw new Exception("Parametros inválidos, verifique a documentação!", 400);
            }

            return $this->response->setStatusCode(200)->setJSON([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Produto atualizado com sucesso!"
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

    public function DeletaProduto($id){

        try {
            $produto = new ProdutosModel();

            $produtoDados = $produto->find($id);

            if(!$produto->delete($id)){

                throw new Exception("Algo deu errado!");   
            }

            return $this->response->setStatusCode(200)->setJSON([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Produto deletado com sucesso!"
                ],
                'dados exluidos' => $produtoDados
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

        $parametros = $dados->parametros;

        if(empty($parametros->nome)){

            throw new Exception("Parametros inválidos, verifique a documentação!", 400);
        }

        return $parametros;
    }
}

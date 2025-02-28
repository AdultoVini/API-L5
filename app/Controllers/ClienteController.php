<?php

namespace App\Controllers;

use App\Models\ClientesModel;
use Exception;
use CodeIgniter\Exceptions\PageNotFoundException;

class ClienteController extends BaseController
{
    public function index()
    {

        $clientes = new ClientesModel();
        $clientes = $clientes->findAll();
     
        if(empty($clientes)){

            return $this->response->setStatusCode(404)->setJson([
                "cabecalho" => [
                    "status" => 404,
                    "mensagem" => "Nenhum cliente encontrado!"
                ]
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Consulta realizada com sucesso!"
            ],
            "retorno" => $clientes
        ]);
    }

    public function ClienteDetalhes($id){

        $cliente = new ClientesModel();
        $cliente = $cliente->find($id);
     
        if(empty($cliente)){

            return $this->response->setStatusCode(404)->setJson([
                "cabecalho" => [
                    "status" => 404,
                    "mensagem" => "Nenhum cliente encontrado!"
                ]
            ]);
        }

        return $this->response->setStatusCode(200)->setJSON([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Consulta realizada com sucesso!"
            ],
            "retorno" => $cliente
        ]);
    }

    public function CadastraCliente(){
        try {

            $dados = $this->request->getJSON();
            
            $parametros = $this->verificaCadastro($dados);
           
            $cliente = new ClientesModel();

            if(!$cliente->insert($parametros)){
                
                throw new \RuntimeException("Falha ao cadastrar dados, verifique os dados enviados!", 400);
            }

            return $this->response->setStatusCode(201)->setJSON([
                "cabecalho" => [
                "status" => 201,
                "mensagem" => "Cadastro realizado com sucesso!"
            ],
                'dados' => $dados
            ]);
            
        } catch (\RuntimeException $e) {

           return $this->response->setStatusCode(400)->setJSON([
                "cabecalho" => [
                    "status" => 400,
                    "mensagem" => "Falha ao cadastrar dados, verifique os dados enviados!"
                ],
                'dados' => $dados
            ]);

        } catch (\Exception $e) {

           return $this->response->setStatusCode(400)->setJSON([
                "cabecalho" => [
                    "status" => 400,
                    "mensagem" => $e->getMessage()
                ],
                'dados' => $dados
            ]);

        }
    
    }

    public function AtualizaCliente($id){

        try {

            $dados = $this->request->getJSON();
            
            $parametros = $this->verificaAtualizacaoCadastro($dados);
           
            $cliente = new ClientesModel();

            if(!$cliente->update($id, $parametros)){
                
                throw new \RuntimeException("Parametros inválidos, verifique a documentação!", 400);
            }

            return $this->response->setStatusCode(200)->setJSON([
                "cabecalho" => [
                "status" => 200,
                "mensagem" => "Cadastro atualizado com sucesso!"
            ],
                'dados' => $dados
            ]);
            
        } catch (\RuntimeException $e) {

           return $this->response->setStatusCode(400)->setJSON([
                "cabecalho" => [
                    "status" => 400,
                    "mensagem" => "Parametros inválidos, verifique a documentação!"
                ],
                'dados' => $dados
            ]);

        } catch (\Exception $e) {

           return $this->response->setStatusCode(400)->setJSON([
                "cabecalho" => [
                    "status" => 400,
                    "mensagem" => $e->getMessage()
                ],
                'dados' => $dados
            ]);

        }
    }

    public function DeletaCliente($id){

        try {
            $cliente = new ClientesModel();

            $clienteDados = $cliente->find($id);

            if(!$cliente->delete($id)){

                throw new Exception("Algo deu errado!");   
            }

            return $this->response->setStatusCode(200)->setJSON([
                "cabecalho" => [
                    "status" => 200,
                    "mensagem" => "Cadastro deletado com sucesso!"
                ],
                'dados exluidos' => $clienteDados
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

    public function verificaCadastro($dados){

        if(empty($dados->parametros)){
                
            throw new Exception("Parametros inválidos, verifique a documentação!", 400);
        }

        $parametros = $dados->parametros;

        
        if(empty($parametros->nome)){
            throw new Exception("Parametros inválidos, verifique a documentação!", 400);
        }

        return $parametros;
    }

    public function verificaAtualizacaoCadastro($dados){

        if(empty($dados->parametros)){
                
            throw new Exception("Parametros inválidos, verifique a documentação!", 400);
        }

        $parametros = $dados->parametros;

      
        if(property_exists($parametros, "nome")){
            if(empty($parametros->nome)){
                throw new Exception("Parametros inválidos, verifique a documentação!", 400);
            }
        }

        return $parametros;
    }
}
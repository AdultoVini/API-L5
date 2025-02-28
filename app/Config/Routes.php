<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Clientes
$routes->get('/clientes', 'ClienteController::index');
$routes->get('/clientes/(:num)', 'ClienteController::ClienteDetalhes/$1');
$routes->post('/clientes', 'ClienteController::CadastraCliente');
$routes->put('/clientes/(:num)', 'ClienteController::AtualizaCliente/$1');
$routes->delete('/clientes/(:num)', 'ClienteController::DeletaCliente/$1');

//Produtos
$routes->get('/produtos', 'ProdutoController::index');
$routes->get('/produtos/(:num)', 'ProdutoController::ProdutoDetalhes/$1');
$routes->post('/produtos', 'ProdutoController::CadastraProduto');
$routes->put('/produtos/(:num)', 'ProdutoController::AtualizaProduto/$1');
$routes->delete('/produtos/(:num)', 'ProdutoController::DeletaProduto/$1');

//Pedidos de Compra
$routes->get('/pedidos', 'PedidosController::index');
$routes->get('/pedidos/(:num)', 'PedidosController::PedidoDetalhes/$1');
$routes->post('/pedidos', 'PedidosController::CadastraPedido');
$routes->put('/pedidos/(:num)', 'PedidosController::AtualizaPedido/$1');
$routes->delete('/pedidos/(:num)', 'PedidosController::DeletaPedido/$1');
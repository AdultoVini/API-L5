-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 01-Mar-2025 às 02:07
-- Versão do servidor: 8.0.41-0ubuntu0.22.04.1
-- versão do PHP: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ProjetoAPI`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int UNSIGNED NOT NULL,
  `cpf` char(11) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cnpj` char(14) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `razao_social` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `cpf`, `nome`, `cnpj`, `razao_social`, `data_cadastro`) VALUES
(1, '98765432100', 'Maria Oliveira', '55566677788899', 'Oliveira Tech Solutions', '2025-03-01 01:51:09'),
(2, '12345678901', 'João Silva', '11122233344455', 'Silva Comércio Ltda', '2025-03-01 01:51:18'),
(3, '65498732100', 'Carlos Souza', '99988877766655', 'Souza Transportes', '2025-03-01 01:51:24'),
(4, '32165498700', 'Ana Costa', '33322211100099', 'Costa & Associados', '2025-03-01 01:51:29'),
(5, '11223344556', 'Pedro Martins', '77788899900011', 'Martins Construções', '2025-03-01 01:51:33'),
(6, '99887766554', 'Fernanda Almeida', '44455566677788', 'Almeida Eventos', '2025-03-01 01:51:39'),
(7, '22334455667', 'Rafael Lima', '66677788899900', 'Lima Marketing', '2025-03-01 01:51:43'),
(8, '33445566778', 'Juliana Barbosa', '55544433322211', 'Barbosa Estética', '2025-03-01 01:51:50'),
(9, '55667788999', 'Lucas Rocha', '99900011122233', 'Rocha Consultoria', '2025-03-01 01:51:55'),
(10, '66778899000', 'Gabriela Mendes', '22233344455566', 'Mendes Advocacia', '2025-03-01 01:51:59'),
(11, '77889900112', 'Fábio Santos', '88899900011122', 'Santos Engenharia', '2025-03-01 01:52:03'),
(12, '88990011223', 'Vanessa Ribeiro', '33344455566677', 'Ribeiro Imobiliária', '2025-03-01 01:52:08'),
(13, '99001122334', 'Eduardo Nascimento', '11100099988877', 'Nascimento Móveis', '2025-03-01 01:52:13'),
(14, '00112233445', 'Carolina Dias', '66655544433322', 'Dias Papelaria', '2025-03-01 01:52:18'),
(15, '11223344556', 'Leonardo Ferreira', '77766655544433', 'Ferreira Elétrica', '2025-03-01 01:52:26'),
(16, '22334455667', 'Patrícia Gomes', '88877766655544', 'Gomes Roupas', '2025-03-01 01:52:32'),
(17, '33445566778', 'Marcos Teixeira', '99988877766655', 'Teixeira Logística', '2025-03-01 01:52:38'),
(18, '44556677889', 'Amanda Castro', '00011122233344', 'Castro Software', '2025-03-01 01:52:43'),
(19, '55667788990', 'Rodrigo Moreira', '11122233344455', 'Moreira Consultoria', '2025-03-01 01:52:49'),
(20, '66778899001', 'Beatriz Lopes', '22233344455566', 'Lopes Contabilidade', '2025-03-01 01:53:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(30, '2025-02-25-144034', 'App\\Database\\Migrations\\Clientes', 'default', 'App', 1740793851, 1),
(31, '2025-02-25-192655', 'App\\Database\\Migrations\\AdicionaColunaDataCadastro', 'default', 'App', 1740793852, 1),
(32, '2025-02-25-193127', 'App\\Database\\Migrations\\CriarTabelaProdutos', 'default', 'App', 1740793852, 1),
(33, '2025-02-25-193621', 'App\\Database\\Migrations\\AdicionaColunaDataCadastroProdutos', 'default', 'App', 1740793853, 1),
(34, '2025-02-25-193833', 'App\\Database\\Migrations\\CriarTabelaPedidosCompra', 'default', 'App', 1740793853, 1),
(35, '2025-02-25-195553', 'App\\Database\\Migrations\\AdicionarComentarioPedidos', 'default', 'App', 1740793854, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_compra`
--

CREATE TABLE `pedidos_compra` (
  `id` int UNSIGNED NOT NULL,
  `id_cliente` int UNSIGNED NOT NULL,
  `id_produto` int UNSIGNED NOT NULL,
  `status` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '0 => Cancelado | 1 => Em Aberto | 2 => Pago',
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pedidos_compra`
--

INSERT INTO `pedidos_compra` (`id`, `id_cliente`, `id_produto`, `status`, `data_cadastro`) VALUES
(1, 1, 3, '0', '2025-03-01 01:59:03'),
(2, 2, 5, '1', '2025-03-01 01:59:09'),
(3, 3, 7, '2', '2025-03-01 01:59:13'),
(4, 4, 9, '0', '2025-03-01 01:59:25'),
(5, 5, 11, '1', '2025-03-01 01:59:34'),
(6, 6, 13, '2', '2025-03-01 01:59:44'),
(7, 7, 15, '0', '2025-03-01 01:59:50'),
(8, 8, 2, '1', '2025-03-01 02:00:01'),
(9, 9, 4, '2', '2025-03-01 02:00:07'),
(10, 10, 6, '0', '2025-03-01 02:00:14'),
(11, 11, 8, '1', '2025-03-01 02:00:19'),
(12, 12, 10, '2', '2025-03-01 02:00:28'),
(13, 13, 12, '0', '2025-03-01 02:00:35'),
(14, 14, 14, '1', '2025-03-01 02:00:48'),
(15, 15, 16, '2', '2025-03-01 02:00:54'),
(16, 16, 1, '0', '2025-03-01 02:01:00'),
(17, 17, 3, '1', '2025-03-01 02:01:09'),
(18, 18, 5, '2', '2025-03-01 02:01:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int UNSIGNED NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `data_cadastro`) VALUES
(1, 'cafe', '2025-03-01 01:53:26'),
(2, 'arroz', '2025-03-01 01:53:35'),
(3, 'feijao', '2025-03-01 01:53:42'),
(4, 'oleo de cozinha', '2025-03-01 01:54:19'),
(5, 'batata', '2025-03-01 01:54:31'),
(6, 'cebola', '2025-03-01 01:54:39'),
(7, 'alho', '2025-03-01 01:54:46'),
(8, 'abacaxi', '2025-03-01 01:54:52'),
(9, 'conjunto de meias', '2025-03-01 01:55:14'),
(10, 'Saco de raçao 1kg', '2025-03-01 01:55:55'),
(11, 'alface', '2025-03-01 01:56:45'),
(12, 'cenoura', '2025-03-01 01:56:49'),
(13, 'brocolis', '2025-03-01 01:56:53'),
(14, 'tapioca', '2025-03-01 01:57:08'),
(15, 'farinha de rosca', '2025-03-01 01:57:11'),
(16, 'farinha de trigo', '2025-03-01 01:57:17');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos_compra`
--
ALTER TABLE `pedidos_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_compra_id_cliente_foreign` (`id_cliente`),
  ADD KEY `pedidos_compra_id_produto_foreign` (`id_produto`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `pedidos_compra`
--
ALTER TABLE `pedidos_compra`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos_compra`
--
ALTER TABLE `pedidos_compra`
  ADD CONSTRAINT `pedidos_compra_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_compra_id_produto_foreign` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

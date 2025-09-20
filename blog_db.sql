-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/09/2025 às 03:04
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `blog_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Macroeconomia'),
(2, 'Microeconomia'),
(3, 'Mercado Financeiro'),
(4, 'Política Monetária'),
(5, 'Política Fiscal'),
(6, 'Comércio Internacional');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `conteudo` text DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `post_id`, `autor`, `conteudo`, `criado_em`) VALUES
(1, 1, 'Pedro', 'Explicação bem clara, ajudou a entender macroeconomia.', '2025-09-19 21:14:57'),
(2, 2, 'Mariana', 'Oferta e demanda explicam muita coisa no nosso dia a dia.', '2025-09-19 21:14:57'),
(4, 4, 'Fernanda', 'A Selic influencia até o cartão de crédito, incrível.', '2025-09-19 21:14:57'),
(7, 8, 'Eliphaz', 'que legal', '2025-09-19 22:56:21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `conteudo` text NOT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `posts`
--

INSERT INTO `posts` (`id`, `titulo`, `conteudo`, `imagem`, `autor`, `categoria_id`, `criado_em`) VALUES
(1, 'O que é Macroeconomia??', 'A macroeconomia estuda a economia em nível agregado, analisando variáveis como PIB, inflação, desemprego e taxa de juros.', 'macro.jpg', 'Admin', 1, '2025-09-19 21:14:48'),
(2, 'Oferta e Demanda na prática', 'A microeconomia explica como consumidores e empresas interagem. A lei da oferta e demanda determina os preços no mercado.', 'micro.jpg', 'Ana Paula', 2, '2025-09-19 21:14:48'),
(4, 'Como funciona a taxa Selic?', 'A taxa Selic é a principal ferramenta do Banco Central para controlar a inflação no Brasil.', 'selic.jpg', 'Mariana Ribeiro', 4, '2025-09-19 21:14:48'),
(8, 'teste 2', 'teste aa', 'justin-gerard-dh1901-n32-v1x05a-72web.jpg', 'teste 2', 4, '2025-09-19 22:40:50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`) VALUES
(1, 'admin', '$2y$10$mBPfMcJMt5XfVRkjAb355.TicQYEeTlwpWz5CtmFGGhjdI86McdyO'),
(2, 'Eliphaz', '$2y$10$mBPfMcJMt5XfVRkjAb355.TicQYEeTlwpWz5CtmFGGhjdI86McdyO');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Índices de tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

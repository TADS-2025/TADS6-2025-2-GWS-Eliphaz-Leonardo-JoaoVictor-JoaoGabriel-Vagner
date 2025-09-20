-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/09/2025 às 15:53
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
(4, 4, 'Fernanda', 'A Selic influencia até o cartão de crédito, incrível.', '2025-09-19 21:14:57');

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
(1, 'O que é Macroeconomia??', 'A macroeconomia estuda a economia em nível agregado, analisando variáveis como PIB, inflação, desemprego e taxa de juros.', 'Capa-macroeconomia.webp', 'Admin', 1, '2025-09-19 21:14:48'),
(2, 'Oferta e Demanda na prática', 'A microeconomia explica como consumidores e empresas interagem. A lei da oferta e demanda determina os preços no mercado.', 'principios-de-oferta-e-demanda-no-mercado-atual.jpeg', 'Ana Paula', 2, '2025-09-19 21:14:48'),
(4, 'Como funciona a taxa Selic?', 'A taxa Selic é a principal ferramenta do Banco Central para controlar a inflação no Brasil.', 'taxa-de-juros-Selic.jpg', 'Mariana Ribeiro', 4, '2025-09-19 21:14:48'),
(10, 'O Futuro das Finanças Pessoais', 'Neste post, exploramos como a tecnologia está moldando o futuro das finanças pessoais, desde o uso de aplicativos de controle de gastos até a ascensão das fintechs. O futuro é agora e a educação financeira é a chave para o sucesso.', 'financas-pessoais.jpg.jpg', 'Eliphaz', 1, '2025-09-20 13:40:23'),
(11, 'Análise do Mercado de Ações em 2025', 'Uma análise aprofundada das tendências do mercado de ações para o ano de 2025. Entenda quais setores estão em alta e como se preparar para as volatilidades do mercado global.', 'bolsa-werther-santana-estadao_210320204824.jpg', 'Vagner', 2, '2025-09-20 13:40:23'),
(12, 'Dicas para Começar a Investir com Pouco Dinheiro', 'Começar a investir pode parecer desafiador, mas com as estratégias certas, é possível entrar no mundo dos investimentos mesmo com um orçamento limitado. Este artigo traz dicas práticas para dar os primeiros passos.', 'shutterstock_520847458-1-770x478.jpg', 'João Gabriel', 3, '2025-09-20 13:40:23'),
(13, 'Entendendo a Inflação: O que é e Como Ela Afeta Você', 'A inflação é um dos conceitos mais importantes em economia. Descubra o que ela significa, quais são suas causas e como ela impacta seu poder de compra e suas economias a longo prazo.', 'inflacao-800.jpg', 'João Victor', 1, '2025-09-20 13:40:23'),
(14, 'A Ascensão das Criptomoedas e o Bitcoin', 'O universo das criptomoedas tem crescido exponencialmente. Neste artigo, desvendamos o que é o Bitcoin, como ele funciona e por que tantas pessoas estão investindo em moedas digitais.', 'bitcoin_800x533_L_1411988633.jpg', 'Leonardo', 2, '2025-09-20 13:40:23'),
(15, 'Fundos de Investimento: Um Guia para Iniciantes', 'Os fundos de investimento são uma ótima opção para quem deseja diversificar a carteira. Aprenda sobre os diferentes tipos de fundos e como escolher o mais adequado para o seu perfil de investidor.', 'investimentos-responsáveis.jpg', 'Eliphaz', 3, '2025-09-20 13:40:23'),
(16, 'Planejamento de Aposentadoria: Como Começar Cedo', 'A aposentadoria é um objetivo de vida para muitos, mas o planejamento financeiro para alcançá-la deve começar o mais cedo possível. Damos dicas sobre como criar um plano sólido para o futuro.', 'aposentadoria-1-1.png', 'Vagner', 1, '2025-09-20 13:40:23'),
(17, 'O Papel do Banco Central na Economia', 'O Banco Central é uma instituição crucial para a estabilidade econômica. Entenda suas funções, como ele controla a política monetária e por que suas decisões impactam a vida de todos.', 'Banco-Central-1024x683.jpg', 'João Gabriel', 2, '2025-09-20 13:40:23'),
(18, 'Introdução à Análise Técnica para Traders', 'A análise técnica é uma ferramenta usada por traders para prever movimentos de preços. Conheça os conceitos básicos e as principais ferramentas para começar a usar a análise técnica em suas operações.', 'trading-1600.png', 'João Victor', 3, '2025-09-20 13:40:23'),
(19, 'Guia Completo de Orçamento Pessoal', 'Ter um orçamento bem-definido é o primeiro passo para o sucesso financeiro. Siga este guia para criar um plano de gastos que funcione para você e ajude a atingir suas metas financeiras.', 'shutterstock_2203592579-1-1.jpg', 'Leonardo', 1, '2025-09-20 13:40:23');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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

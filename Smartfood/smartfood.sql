-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Nov-2021 às 20:11
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `smartfood`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartoes`
--

CREATE TABLE `cartoes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `tipo_cart` int(11) NOT NULL,
  `nome_cart` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `numero_seguranca` int(11) NOT NULL,
  `mes_expiracao` int(11) NOT NULL,
  `ano_expiracao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `id_origem` int(11) NOT NULL,
  `id_destino` int(11) NOT NULL,
  `mensagem` varchar(1000) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `data_mensagem` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `id_origem`, `id_destino`, `mensagem`, `id_pedido`, `data_mensagem`) VALUES
(1, 4, 6, 'Boa tarde', 44, '2021-10-09 23:22:42'),
(2, 6, 4, 'Boa tarde senhor Usuário Hash!', 44, '2021-10-09 23:22:42'),
(3, 6, 4, 'Tudo bem com o senhor?', 44, '2021-10-09 23:57:20'),
(4, 4, 6, 'Tudo sim, obrigado', 44, '2021-10-09 23:58:17'),
(7, 4, 6, 'Gostaria de fazer uma observação', 44, '2021-10-13 11:40:06'),
(8, 4, 6, 'Claro', 44, '2021-10-13 11:41:42'),
(9, 4, 6, 'a', 44, '2021-10-13 11:42:08'),
(10, 4, 6, 'Agora sim está apagando', 44, '2021-10-13 11:42:17'),
(11, 6, 4, 'Msg restaurante', 44, '2021-10-19 12:47:29'),
(12, 4, 6, 'Msg Usuário', 44, '2021-10-19 12:47:35'),
(13, 4, 6, 'Olá', 44, '2021-10-19 06:37:31'),
(14, 6, 4, 'O que o senhor deseja?', 44, '2021-10-19 06:37:59'),
(15, 4, 6, 'Quero batata', 44, '2021-10-19 06:38:09'),
(16, 6, 4, 'Ixi senhor, não temos batata', 44, '2021-10-24 08:47:57'),
(17, 6, 4, 'Temos só brócolis', 44, '2021-10-24 08:48:03'),
(18, 6, 4, 'Serve?', 44, '2021-10-24 08:48:08'),
(19, 4, 6, 'Não gosto de brócolis, tem alface?', 44, '2021-10-24 08:48:21'),
(20, 4, 6, 'É que sabe, eu não gosto muito de brócolis é meio difícil de eu comer', 44, '2021-10-24 12:28:04'),
(21, 4, 6, 'a', 44, '2021-10-24 12:28:29'),
(22, 4, 6, 'Alô Alô', 44, '2021-10-24 12:37:33'),
(23, 17, 18, 'Boa noite senhor Victor', 61, '2021-10-25 07:47:58'),
(24, 18, 17, 'Boa noite', 61, '2021-10-25 07:48:07'),
(25, 18, 17, 'Gostaria de fazer uma observação', 61, '2021-10-25 08:06:33'),
(26, 17, 18, 'Claro, pode falar', 61, '2021-10-25 08:06:42'),
(27, 6, 4, 'Opa', 44, '2021-11-07 08:12:38'),
(29, 4, 6, 'Agora sim', 44, '2021-11-07 21:17:35'),
(30, 4, 6, 'Vai curintia', 44, '2021-11-07 21:22:04'),
(31, 4, 6, 'Ae sim hein', 44, '2021-11-07 21:35:14'),
(32, 4, 6, 'AA', 44, '2021-11-07 21:41:35'),
(33, 4, 6, 'A', 44, '2021-11-07 21:42:43'),
(34, 4, 6, 'Ola ola', 44, '2021-11-07 21:45:15'),
(35, 4, 6, 'HumHUmHUm', 44, '2021-11-07 21:47:11'),
(36, 4, 6, 'a', 44, '2021-11-07 21:47:32'),
(37, 4, 6, 's', 44, '2021-11-07 21:48:54'),
(38, 4, 6, 'Booboboboo', 44, '2021-11-07 21:49:22'),
(39, 4, 6, 'www', 44, '2021-11-07 21:53:26'),
(40, 4, 6, 'as', 44, '2021-11-07 21:56:30'),
(41, 4, 6, 'w', 44, '2021-11-07 21:57:22'),
(42, 4, 6, 'ô zé\n', 44, '2021-11-07 21:59:08'),
(43, 4, 6, 'Fala zezim', 44, '2021-11-07 21:59:21'),
(44, 4, 6, 'TÔ FALANDO CONTIGO HEIN', 44, '2021-11-07 21:59:34'),
(45, 6, 4, 'Pois não', 44, '2021-11-07 22:00:50'),
(46, 6, 4, 'Tô meio ucopado sabe', 44, '2021-11-07 22:03:23'),
(47, 4, 6, 'Ué mas me atende né', 44, '2021-11-07 22:03:31'),
(48, 6, 4, 'Num dá não', 44, '2021-11-07 22:03:38'),
(49, 6, 4, 'Já disse que não dá', 44, '2021-11-07 22:05:52'),
(50, 6, 4, 'Oaehoo', 44, '2021-11-07 22:08:26'),
(51, 6, 4, 'Oláááá', 44, '2021-11-07 22:13:25'),
(52, 6, 4, 'Pronto', 44, '2021-11-07 22:13:54'),
(53, 4, 6, 'Ah bão', 44, '2021-11-07 22:14:05'),
(54, 4, 6, 'Ah bão hein', 44, '2021-11-07 22:14:48'),
(55, 4, 6, 'Bão mesmo', 44, '2021-11-07 22:16:56'),
(56, 6, 4, 'Pods crê né', 44, '2021-11-07 22:17:11'),
(57, 6, 4, 'ww', 44, '2021-11-07 22:18:02'),
(58, 4, 6, 'Boa', 44, '2021-11-07 22:18:17'),
(59, 6, 4, 'Hallaluia me respondeu hein', 44, '2021-11-07 22:33:30'),
(60, 4, 6, 'Oloko', 44, '2021-11-07 22:33:38'),
(61, 4, 6, 'Mano eu sempre te respondo\n', 44, '2021-11-07 22:33:52'),
(62, 4, 6, 'Beleza', 44, '2021-11-07 22:36:42'),
(63, 6, 4, 'Mas é verdade', 44, '2021-11-07 22:36:52'),
(64, 4, 6, 'Serião?', 44, '2021-11-07 22:37:23'),
(65, 6, 4, 'Serião', 44, '2021-11-07 22:37:33'),
(66, 6, 4, 'Bora bora', 57, '2021-11-07 22:41:30'),
(67, 4, 6, 'Bora que é hora', 57, '2021-11-07 22:41:39'),
(68, 6, 4, '11', 57, '2021-11-08 21:46:08'),
(69, 4, 6, 'Bom dia', 58, '2021-11-09 08:24:21'),
(70, 6, 4, 'Olá', 58, '2021-11-09 08:24:31'),
(71, 4, 6, 'Olá, bom dia', 59, '2021-11-09 08:28:59'),
(72, 6, 4, 'Bom dia', 59, '2021-11-09 08:29:08'),
(73, 6, 4, 'COmo posso ajudar?', 59, '2021-11-09 08:29:17'),
(74, 6, 4, 'Olá, boa noite', 411, '2021-11-09 20:05:27'),
(75, 6, 4, 'Olá, boa noite senhor', 60, '2021-11-09 20:32:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_cartao` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `tipo_pag` varchar(255) NOT NULL,
  `data_pag` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_restaurante` int(11) DEFAULT NULL,
  `id_situacao` int(11) NOT NULL,
  `avaliacao` float DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `data_pedido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `id_restaurante`, `id_situacao`, `avaliacao`, `motivo`, `data_pedido`) VALUES
(22, 4, 1, 3, NULL, NULL, '2021-10-03 20:41:42'),
(27, 4, 1, 3, NULL, NULL, '2021-10-06 20:39:38'),
(29, 4, 1, 4, NULL, NULL, '2021-10-06 20:39:56'),
(44, 4, 1, 3, NULL, NULL, '2021-10-09 13:34:21'),
(45, 4, 1, 4, NULL, NULL, '2021-10-09 13:59:19'),
(46, 6, 1, 3, NULL, NULL, '2021-10-11 18:32:11'),
(53, 4, 1, 3, NULL, NULL, '2021-10-11 19:10:29'),
(54, 6, 1, 3, NULL, NULL, '2021-10-11 19:46:37'),
(56, 4, 1, 4, NULL, NULL, '2021-10-11 20:04:18'),
(57, 4, 1, 4, NULL, NULL, '2021-10-11 21:17:22'),
(58, 4, 1, 2, NULL, NULL, '2021-10-24 08:49:14'),
(59, 4, 1, 2, NULL, NULL, '2021-10-24 12:08:50'),
(60, 4, 1, 2, NULL, NULL, '2021-10-24 12:09:33'),
(61, 18, 19, 4, NULL, NULL, '2021-10-25 19:46:55'),
(62, 18, 19, 4, NULL, NULL, '2021-10-25 19:55:42'),
(63, 18, 19, 4, NULL, NULL, '2021-10-25 20:08:16'),
(64, 18, 1, 4, NULL, NULL, '2021-10-25 20:11:43'),
(409, 4, 1, 5, NULL, NULL, '2021-11-09 08:19:39'),
(410, 4, 1, 5, NULL, NULL, '2021-11-09 08:30:32'),
(411, 4, 1, 5, NULL, NULL, '2021-11-09 20:04:10'),
(412, 4, 1, 2, NULL, NULL, '2021-11-09 20:34:07'),
(413, 4, 1, 1, NULL, NULL, '2021-11-09 20:38:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pratos`
--

CREATE TABLE `pratos` (
  `id` int(11) NOT NULL,
  `id_restaurante` int(11) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `avaliacao` float DEFAULT NULL,
  `pedido` int(11) DEFAULT NULL,
  `preco` float NOT NULL,
  `excluido` enum('s') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pratos`
--

INSERT INTO `pratos` (`id`, `id_restaurante`, `nome`, `descricao`, `avaliacao`, `pedido`, `preco`, `excluido`) VALUES
(1, 1, 'Macarronada de molho à bolonhesa - Especialidade da casa', 'Maravilhoso macarrão spaghetti com carne moída e molho de tomate caseiro', 4.5, NULL, 34, NULL),
(2, 2, 'Parmegiana de carne', 'Arroz, feijão, fritas e carne ao molho sugo com queijo - Acompanha suco', NULL, NULL, 30.9, NULL),
(5, 1, 'Chips\'n Fish', '        Batata rústica cozida com frango frito, serve duas pessoas      ', NULL, NULL, 49.9, NULL),
(12, 1, 'Prato toperson', 'Muito top', 0, NULL, 100, 's'),
(13, 1, 'Coca-cola', '        Coca-cola lata 350ml       ', NULL, NULL, 4.5, NULL),
(14, 1, 'Comida variada', '        várias comidas em uma      ', NULL, NULL, 43, NULL),
(15, 1, 'Prato indiano', '        Melhor prato indiano da região      ', NULL, NULL, 25, NULL),
(16, 19, 'Prato vegetariano testado', '                        Melhor prato vegetariano tá funcionadno                 ', NULL, NULL, 27, 's'),
(17, 19, 'Suco de laranja', 'Suco de laranja natural', NULL, NULL, 9.5, NULL),
(18, 19, 'Arroz carreteiro', 'Arroz com carne seca', NULL, NULL, 25.3, NULL),
(19, 19, 'Bolo de cenoura', 'Bolo de cenoura com cobertura de chocolate', NULL, NULL, 7, NULL),
(20, 1, 'Bala ', 'Bala sortida', NULL, NULL, 0.01, NULL),
(21, 20, 'Prato da natureza', 'Prato muito bom da natureza', NULL, NULL, 22.3, NULL),
(22, 21, 'Prato de torta', 'Torta TOP', NULL, NULL, 12, NULL),
(24, 1, 'Prato já existe', 'Ué mas já existe', NULL, NULL, 19, 's');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prato_pedido`
--

CREATE TABLE `prato_pedido` (
  `id` int(11) NOT NULL,
  `id_prato` int(11) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `qtd_prato` int(11) NOT NULL,
  `observacao` varchar(255) DEFAULT NULL,
  `avaliacao` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `prato_pedido`
--

INSERT INTO `prato_pedido` (`id`, `id_prato`, `id_pedido`, `qtd_prato`, `observacao`, `avaliacao`) VALUES
(19, 1, 22, 1, NULL, NULL),
(20, 5, 22, 2, 'Caprichar na batata', NULL),
(22, 1, 27, 1, NULL, NULL),
(23, 5, 29, 1, NULL, NULL),
(30, 1, 44, 1, 'Teste sem debuge', NULL),
(31, 12, 44, 1, 'Não estou debugando', NULL),
(32, 5, 45, 3, 'ùltimo testes asda', NULL),
(33, 1, 46, 1, '', NULL),
(40, 13, 53, 3, 'Teste cadastro ajustado', NULL),
(41, 5, 53, 1, '', NULL),
(42, 13, 54, 3, 'coca zero\r\n', NULL),
(43, 1, 54, 1, 'molho extra', NULL),
(45, 5, 56, 2, 'Bastante batata', NULL),
(46, 13, 56, 4, 'Coca cola zero', NULL),
(47, 1, 57, 2, '', NULL),
(48, 13, 57, 1, '', NULL),
(49, 13, 58, 1, 'Bem gelada', NULL),
(50, 1, 58, 1, 'Bastante molho', NULL),
(51, 13, 59, 2, '', NULL),
(52, 5, 60, 1, 'Testando mensagem', NULL),
(53, 18, 61, 1, 'Muito arroz', NULL),
(54, 17, 61, 1, 'Sem gominho pf', NULL),
(55, 19, 62, 1, 'Capricha na cobertura', NULL),
(56, 17, 63, 1, '', NULL),
(57, 14, 64, 1, 'Observação de teste da comida', NULL),
(66, 20, 409, 1, 'Quero bala de cereja', NULL),
(67, 20, 410, 1, 'Bala de morango e laranja', NULL),
(69, 20, 412, 3, 'Balas sortidas por gentileza', NULL),
(70, 20, 413, 2, 'Outras balas', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cnpj` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `avaliacao` float DEFAULT NULL,
  `descricao` varchar(255) NOT NULL,
  `acesso` char(1) NOT NULL DEFAULT 'r',
  `email` varchar(255) NOT NULL,
  `telefone` int(11) NOT NULL,
  `nota` float DEFAULT NULL,
  `pedidos_nota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `restaurantes`
--

INSERT INTO `restaurantes` (`id`, `nome`, `cnpj`, `estado`, `cidade`, `rua`, `numero`, `avaliacao`, `descricao`, `acesso`, `email`, `telefone`, `nota`, `pedidos_nota`) VALUES
(1, 'Sabor Paulista', '8371827383', 'SP', 'São Paulo', 'Rua Euclides da Cunha', 28, NULL, 'Melhor restaurante de SP, pratos quentes e frios!', 'r', 'saborpaulista@gmail.com', 1182738922, 14, 3),
(2, 'Restaurante das Andorinhas', '983712928', 'RJ', 'Rio de Janeiro', 'Rua Péricles de Souza', 38, 4, 'Buffet com grande variedade de carnes!', 'r', 'andorinhas@gmail.com', 0, NULL, NULL),
(3, 'Restaurante Teste', '092830941702', 'SP', 'São Paulo', 'Rua dos Alboredos', 83, NULL, '', 'r', 'restauranteteste@gmail.com\r\n', 0, NULL, NULL),
(6, 'Restaurante Bom de Prato', '12412431', 'SP', 'São Paulo', 'Rua Pelé', 33, NULL, 'Se vc bate bem de garfo esse é o lugar!', 'r', 'bomprato@gmail.com', 0, NULL, NULL),
(7, 'Teste upload agora', '512412312', 'SP', 'São Paulo', 'Rua Teste', 32, NULL, 'Rua teste', 'r', 'restauranteupload@gmail.com\r\n', 0, NULL, NULL),
(8, 'Restaurante Chinês teste', '3490231298', 'SP', 'São Paulo', 'Rua Chinesa', 22, NULL, 'Restaurante chinês de alta qualidade', 'r', 'restaurantechines@gmail.com', 0, NULL, NULL),
(9, 'Restaurante Usuário', '51234123124', 'RJ', 'Rio de Janeiro', 'Rua usuário', 99, NULL, 'Rua dos restaurantes TOPs', 'r', 'restauranteusuario@gmail.com', 11927372, NULL, NULL),
(19, 'Restaurante Baleia', '3717281631827', 'SP', 'São Paulo', 'Rua da baleia', 726, NULL, 'Melhor restaurante com baleias', 'r', 'baleia@gmail.com', 2147483647, 3.5, 1),
(20, 'Restaurante Japonês', '41241231231', 'SP', 'São Paulo', 'Rua japonês', 4123, NULL, 'Rua dos japoneses', 'r', 'japones@gmail.com', 1124123123, NULL, NULL),
(21, 'Restaurante testando agora2', '11029383291', 'RJ', 'Rio de Janeiro', 'Rua do testando', 98, NULL, 'Melhor restaurante de teste', 'r', 'restaurantedeteste@gmail.com', 1293829383, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` int(11) NOT NULL,
  `acesso` enum('u','r') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `nome`, `telefone`, `acesso`) VALUES
(4, 'usuariohash@gmail.com', '$2y$10$sUr/vOcc7./Kx7P.OYdKAuZ2uq5ua.2sMPzWNoSQ3SZ9JCNhmIBQ2', 'Usuário Hash', 1199943723, 'u'),
(5, 'andorinhas@gmail.com', '$2y$10$waoE9hw9HDpZ/2V1k.4kVugIogeDya/kWs3SGqXvLAvBvWL.uMf9i', 'Restaurante Andorinhas', 2147483647, 'r'),
(6, 'saborpaulista@gmail.com', '$2y$10$UZeMNLllokwkyzWdz/K0du1Dl1QKbFsL5bf4wkFjcemzUsah.BDLq', 'Sabor Paulista', 11927372, 'r'),
(17, 'baleia@gmail.com', '$2y$10$cGvzyYBWq6FdT5ikKxdVOOqoQIDNKU6FtBe/wja5rh7h4ga0fG92K', 'Restaurante Baleia', 2147483647, 'r'),
(18, 'victorbelo1997@gmail.com', '$2y$10$yGCjMJ0DSmKz8vZZ8FXR5eYI9rEsjvKF3gPTxF0oJcQ6GdbjBwTsS', 'Victor Belo', 1193938294, 'u'),
(19, 'japones@gmail.com', '$2y$10$Fzxs2fwWPIO94TRlokp0yeO9QH3s89MuT1VP6IbDjrQu0D4nBoJlu', 'Restaurante Japonês', 1124123123, 'r'),
(20, 'restaurantedeteste@gmail.com', '$2y$10$aUqGsoQnpFxW7PdsVIjrnuRtVgtklkxBqPW2yoPYl9mEKJK05iGaa', 'Restaurante testando agora2', 1293829383, 'r'),
(21, 'usuarionovo@gmail.com', '$2y$10$Rp7VZ5TXP/sjJh25Lk7fBuzj3P63Vayk4Ls573mFDKjYD5fY7ppka', 'Usuário Novo', 1192837281, 'u');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cartoes`
--
ALTER TABLE `cartoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_destino` (`id_destino`),
  ADD KEY `id_origem` (`id_origem`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Índices para tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_cartao` (`id_cartao`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_restaurante` (`id_restaurante`);

--
-- Índices para tabela `pratos`
--
ALTER TABLE `pratos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_restaurante` (`id_restaurante`);

--
-- Índices para tabela `prato_pedido`
--
ALTER TABLE `prato_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_prato` (`id_prato`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Índices para tabela `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cartoes`
--
ALTER TABLE `cartoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414;

--
-- AUTO_INCREMENT de tabela `pratos`
--
ALTER TABLE `pratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `prato_pedido`
--
ALTER TABLE `prato_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cartoes`
--
ALTER TABLE `cartoes`
  ADD CONSTRAINT `cartoes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Limitadores para a tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD CONSTRAINT `mensagens_ibfk_1` FOREIGN KEY (`id_destino`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `mensagens_ibfk_2` FOREIGN KEY (`id_origem`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `mensagens_ibfk_3` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);

--
-- Limitadores para a tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `pagamentos_ibfk_2` FOREIGN KEY (`id_cartao`) REFERENCES `cartoes` (`id`);

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id`);

--
-- Limitadores para a tabela `pratos`
--
ALTER TABLE `pratos`
  ADD CONSTRAINT `pratos_ibfk_1` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurantes` (`id`);

--
-- Limitadores para a tabela `prato_pedido`
--
ALTER TABLE `prato_pedido`
  ADD CONSTRAINT `prato_pedido_ibfk_1` FOREIGN KEY (`id_prato`) REFERENCES `pratos` (`id`),
  ADD CONSTRAINT `prato_pedido_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

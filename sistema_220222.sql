-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Fev-2022 às 17:38
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(2, 'Alimentação'),
(1, 'Cosméticos'),
(3, 'Moda e Estilo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `codbarras` varchar(5) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` double NOT NULL,
  `estoque` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idRespCadastro` int(11) NOT NULL,
  `dataCadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`codbarras`, `foto`, `nome`, `preco`, `estoque`, `idCategoria`, `idRespCadastro`, `dataCadastro`) VALUES
('32484', 'fotos/20220221151742_7155.jpg', 'Doritos Cool Ranch', 7.99, 290, 2, 14, '2022-02-21 18:17:42'),
('54548', 'fotos/20220216135653_4725.jpg', 'Desinfetante Olhe', 10.98, 100, 1, 13, '2022-02-16 16:56:53'),
('61974', 'fotos/semfoto.jpg', 'Pizza', 25, 100, 2, 1, '2022-02-15 18:33:24'),
('87548', 'fotos/20220221151644_3041jpeg', 'Hamburguer de Bacon', 18.99, 20, 2, 14, '2022-02-21 18:16:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomeCompleto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `username`, `senha`, `email`, `nomeCompleto`) VALUES
(1, 'leolustosa', 'c7457911be9be98415da5b2ffd67c9dca6502d130732040d24c6e3266c0d0d19', 'leolustosa@bol.com.br', 'Leonardo Pereira Lustosa'),
(12, 'cleitommelo', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'cleitommelo@gmail.com', 'Cleitom Melo'),
(13, 'estevaorada', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'rada@dr.com', 'Estevao Rada'),
(14, 'michelsoares', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'michel123@gmail.com', 'Michel Soares'),
(15, 'teste', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'teste@gmail.com', 'Testersom de Oliveira');

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `viewprodutos`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `viewprodutos` (
`codbarras` varchar(5)
,`foto` varchar(200)
,`nome` varchar(100)
,`preco` double
,`estoque` int(11)
,`dataCadastro` timestamp
,`nomeCategoria` varchar(100)
,`nomeCompleto` varchar(250)
,`idRespCadastro` int(11)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `viewprodutos`
--
DROP TABLE IF EXISTS `viewprodutos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewprodutos`  AS SELECT `p`.`codbarras` AS `codbarras`, `p`.`foto` AS `foto`, `p`.`nome` AS `nome`, `p`.`preco` AS `preco`, `p`.`estoque` AS `estoque`, `p`.`dataCadastro` AS `dataCadastro`, `c`.`nome` AS `nomeCategoria`, `u`.`nomeCompleto` AS `nomeCompleto`, `p`.`idRespCadastro` AS `idRespCadastro` FROM ((`produtos` `p` join `categorias` `c` on(`p`.`idCategoria` = `c`.`id`)) join `usuarios` `u` on(`p`.`idRespCadastro` = `u`.`idUsuario`)) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`codbarras`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `idRespCadastro` (`idRespCadastro`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`idRespCadastro`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 18-Jun-2021 às 06:02
-- Versão do servidor: 5.6.34
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `quizfeed`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `nome` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `permissao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`nome`, `email`, `senha`, `permissao`) VALUES
('admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1),
('Caroline da Silva Motta', 'carol@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
('Julia Maria Costa', 'julia@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 3),
('Leandro Gomes', 'leandro@email.com.br', '827ccb0eea8a706c4c34a16891f84e7b', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuariocomum`
--

CREATE TABLE `usuariocomum` (
  `email_usuario` varchar(50) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuariocomum`
--

INSERT INTO `usuariocomum` (`email_usuario`, `nome_usuario`) VALUES
('admin', 'admin'),
('carol@email.com', 'CarolMotta'),
('leandro@email.com.br', 'LeandroFilie');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuariopsicologo`
--

CREATE TABLE `usuariopsicologo` (
  `email_usuario` varchar(50) NOT NULL,
  `crp` int(11) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `situacao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuariopsicologo`
--

INSERT INTO `usuariopsicologo` (`email_usuario`, `crp`, `cidade`, `situacao`) VALUES
('julia@email.com', 123456789, 'Araraquara', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`) USING BTREE;

--
-- Índices para tabela `usuariocomum`
--
ALTER TABLE `usuariocomum`
  ADD PRIMARY KEY (`email_usuario`);

--
-- Índices para tabela `usuariopsicologo`
--
ALTER TABLE `usuariopsicologo`
  ADD PRIMARY KEY (`email_usuario`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `usuariocomum`
--
ALTER TABLE `usuariocomum`
  ADD CONSTRAINT `fk_usuario_comum` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuariopsicologo`
--
ALTER TABLE `usuariopsicologo`
  ADD CONSTRAINT `fk_usuario_psicologo` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

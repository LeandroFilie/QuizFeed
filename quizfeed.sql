-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 21-Jun-2021 às 23:46
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `nome` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `permissao` int(1) NOT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`nome`, `email`, `senha`, `permissao`) VALUES
('admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1),
('Caroline Motta', 'carol@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
('Julia Maria Costa', 'julia@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 3),
('Leandro Gomes Filié', 'leandro.gf03@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 3),
('Leandro Gomes', 'leandro@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
('Marcela Bombarba', 'marcela@email.com', 'c20ad4d76fe97759aa27a0c99bff6710', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuariocomum`
--

DROP TABLE IF EXISTS `usuariocomum`;
CREATE TABLE IF NOT EXISTS `usuariocomum` (
  `email_usuario` varchar(50) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL,
  PRIMARY KEY (`email_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuariocomum`
--

INSERT INTO `usuariocomum` (`email_usuario`, `nome_usuario`) VALUES
('admin', 'admin'),
('carol@email.com', 'CarolMotta'),
('leandro@email.com', 'LeandroFilie');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuariopsicologo`
--

DROP TABLE IF EXISTS `usuariopsicologo`;
CREATE TABLE IF NOT EXISTS `usuariopsicologo` (
  `email_usuario` varchar(50) NOT NULL,
  `crp` varchar(11) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `situacao` int(1) NOT NULL,
  PRIMARY KEY (`email_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuariopsicologo`
--

INSERT INTO `usuariopsicologo` (`email_usuario`, `crp`, `cidade`, `situacao`) VALUES
('julia@email.com', '11111111111', 'Araraquara', 1);

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

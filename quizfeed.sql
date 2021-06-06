-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 06-Jun-2021 às 04:59
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `quizfeed`
--
CREATE DATABASE IF NOT EXISTS `quizfeed` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `quizfeed`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `permissao` int(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `nome_usuario`, `email`, `senha`, `permissao`) VALUES
(0, 'Administrador', 'administrador', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(1, 'Julia Maria Costa', 'JuliaCosta', 'juliacosta@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
(2, 'Leandro Gomes Filié', 'LeandroFilie', 'leandrofilie@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
(3, 'Caroline da Silva Motta', 'CarolMotta', 'carolmotta@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 24-Jun-2021 às 16:33
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
-- Estrutura da tabela `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `area_resultado`
--

CREATE TABLE IF NOT EXISTS `area_resultado` (
  `cod_resultado` int(11) NOT NULL,
  `cod_area` int(11) NOT NULL,
  PRIMARY KEY (`cod_resultado`,`cod_area`),
  KEY `cod_area` (`cod_area`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `email_usuario` varchar(100) NOT NULL,
  `cod_postagem` int(11) NOT NULL,
  `conteudo` varchar(500) NOT NULL,
  `data` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`email_usuario`,`cod_postagem`),
  KEY `cod_postagem` (`cod_postagem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtida`
--

CREATE TABLE IF NOT EXISTS `curtida` (
  `email_usuario` varchar(100) NOT NULL,
  `cod_postagem` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `hora` int(11) NOT NULL,
  PRIMARY KEY (`email_usuario`,`cod_postagem`),
  KEY `cod_postagem` (`cod_postagem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao`
--

CREATE TABLE IF NOT EXISTS `inscricao` (
  `email_usuario` varchar(100) NOT NULL,
  `cod_rede` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`email_usuario`,`cod_rede`),
  KEY `cod_rede` (`cod_rede`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem`
--

CREATE TABLE IF NOT EXISTS `postagem` (
  `id_postagem` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `conteudo` varchar(500) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `cod_rede` int(11) NOT NULL,
  PRIMARY KEY (`id_postagem`,`email_usuario`,`cod_rede`),
  KEY `email_usuario` (`email_usuario`),
  KEY `cod_rede` (`cod_rede`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rede`
--

CREATE TABLE IF NOT EXISTS `rede` (
  `id_rede` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cod_area` int(11) NOT NULL,
  PRIMARY KEY (`id_rede`),
  KEY `cod_area` (`cod_area`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resultado`
--

CREATE TABLE IF NOT EXISTS `resultado` (
  `id_resultado` int(11) NOT NULL,
  `cod_teste` int(11) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  PRIMARY KEY (`id_resultado`,`cod_teste`),
  KEY `cod_teste` (`cod_teste`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `teste_pronto`
--

CREATE TABLE IF NOT EXISTS `teste_pronto` (
  `id_teste` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  PRIMARY KEY (`id_teste`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `email` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `permissao` int(1) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_comum`
--

CREATE TABLE IF NOT EXISTS `usuario_comum` (
  `email_usuario` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`email_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_psicologo`
--

CREATE TABLE IF NOT EXISTS `usuario_psicologo` (
  `email_usuario` varchar(100) NOT NULL,
  `registro` int(20) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(50) NOT NULL,
  `situacao` int(1) NOT NULL,
  PRIMARY KEY (`email_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_testepronto`
--

CREATE TABLE IF NOT EXISTS `usuario_testepronto` (
  `email_usuario` varchar(100) NOT NULL,
  `cod_teste` int(11) NOT NULL,
  `resultado_teste` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`email_usuario`,`cod_teste`),
  KEY `cod_teste` (`cod_teste`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `area_resultado`
--
ALTER TABLE `area_resultado`
  ADD CONSTRAINT `area_resultado_ibfk_2` FOREIGN KEY (`cod_area`) REFERENCES `area` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `area_resultado_ibfk_1` FOREIGN KEY (`cod_resultado`) REFERENCES `resultado` (`id_resultado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`cod_postagem`) REFERENCES `postagem` (`id_postagem`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `curtida`
--
ALTER TABLE `curtida`
  ADD CONSTRAINT `curtida_ibfk_2` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `curtida_ibfk_1` FOREIGN KEY (`cod_postagem`) REFERENCES `postagem` (`id_postagem`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD CONSTRAINT `inscricao_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inscricao_ibfk_2` FOREIGN KEY (`cod_rede`) REFERENCES `rede` (`id_rede`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `postagem`
--
ALTER TABLE `postagem`
  ADD CONSTRAINT `postagem_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postagem_ibfk_2` FOREIGN KEY (`cod_rede`) REFERENCES `rede` (`id_rede`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `rede`
--
ALTER TABLE `rede`
  ADD CONSTRAINT `rede_ibfk_1` FOREIGN KEY (`cod_area`) REFERENCES `area` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `resultado`
--
ALTER TABLE `resultado`
  ADD CONSTRAINT `resultado_ibfk_1` FOREIGN KEY (`cod_teste`) REFERENCES `teste_pronto` (`id_teste`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario_comum`
--
ALTER TABLE `usuario_comum`
  ADD CONSTRAINT `usuario_comum_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario_psicologo`
--
ALTER TABLE `usuario_psicologo`
  ADD CONSTRAINT `usuario_psicologo_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario_testepronto`
--
ALTER TABLE `usuario_testepronto`
  ADD CONSTRAINT `usuario_testepronto_ibfk_2` FOREIGN KEY (`cod_teste`) REFERENCES `teste_pronto` (`id_teste`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_testepronto_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

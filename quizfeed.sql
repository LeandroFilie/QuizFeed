-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 19-Jul-2021 às 23:40
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
CREATE DATABASE IF NOT EXISTS `quizfeed` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `area`
--

INSERT INTO `area` (`id_area`, `nome`, `descricao`) VALUES
(1, 'Ciências Exatas e da Terra', ''),
(2, 'Ciências Biológicas', ''),
(3, 'Engenharias', ''),
(4, 'Ciências da Saúde', ''),
(5, 'Ciências Agrárias', ''),
(6, 'Ciências Sociais Aplicadas', ''),
(7, 'Ciências Humanas', ''),
(8, 'Linguística, Letras e Artes', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `area_resultado`
--

CREATE TABLE IF NOT EXISTS `area_resultado` (
  `cod_resultado` int(11) NOT NULL,
  `cod_area` int(11) NOT NULL,
  PRIMARY KEY (`cod_resultado`,`cod_area`),
  KEY `cod_area` (`cod_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtida`
--

CREATE TABLE IF NOT EXISTS `curtida` (
  `email_usuario` varchar(100) NOT NULL,
  `cod_postagem` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`email_usuario`,`cod_postagem`),
  KEY `cod_postagem` (`cod_postagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curtida`
--

INSERT INTO `curtida` (`email_usuario`, `cod_postagem`, `data`, `hora`) VALUES
('leandro@email.com', 3, '2021-07-19', '20:18:53');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `inscricao`
--

INSERT INTO `inscricao` (`email_usuario`, `cod_rede`, `data`, `hora`) VALUES
('julia@email.com', 2, '2021-07-13', '16:32:33'),
('leandro@email.com', 4, '2021-07-19', '20:17:57');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `postagem`
--

INSERT INTO `postagem` (`id_postagem`, `data`, `hora`, `conteudo`, `email_usuario`, `cod_rede`) VALUES
(1, '2021-07-18', '15:35:20', 'Meu primeiro post', 'julia@email.com', 2),
(2, '2021-07-18', '15:35:41', 'Meu segundo Post', 'julia@email.com', 2),
(3, '2021-07-19', '20:18:16', 'oi galera', 'leandro@email.com', 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `rede`
--

INSERT INTO `rede` (`id_rede`, `nome`, `cod_area`) VALUES
(1, 'Ciências Exatas e da Terra', 1),
(2, 'Ciências Biológicas', 2),
(3, 'Engenharias', 3),
(4, 'Ciências da Saúde', 4),
(5, 'Ciências Agrárias', 5),
(6, 'Ciências Sociais Aplicadas', 6),
(7, 'Ciências Humanas', 7),
(8, 'Linguística, Letras e Artes', 8);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `teste_pronto`
--

CREATE TABLE IF NOT EXISTS `teste_pronto` (
  `id_teste` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id_teste`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `teste_pronto`
--

INSERT INTO `teste_pronto` (`id_teste`, `nome`, `link`) VALUES
(1, 'Guia da Carreira', 'https://www.guiadacarreira.com.br/teste-vocacional/'),
(2, 'Quero Bolsa', 'https://querobolsa.com.br/teste-vocacional-gratis'),
(3, 'Vix', 'https://www.vix.com/pt/comportamento/546867/qual-profissao-mais-combina-com-voce-este-teste-vocacional-te-ajuda-a-descobrir');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`email`, `nome`, `senha`, `permissao`) VALUES
('admin', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1),
('carol@email.com', 'Caroline Motta', '827ccb0eea8a706c4c34a16891f84e7b', 2),
('carol@psicologa.com', 'Carol Psicologa', '827ccb0eea8a706c4c34a16891f84e7b', 3),
('julia@email.com', 'Julia Costa', '827ccb0eea8a706c4c34a16891f84e7b', 2),
('julia@psicologa.com', 'Julia Psicologa', '827ccb0eea8a706c4c34a16891f84e7b', 3),
('leandro@email.com', 'Leandro Filié', '827ccb0eea8a706c4c34a16891f84e7b', 2),
('leandro@psicologo.com', 'Leandro Psicologo', '827ccb0eea8a706c4c34a16891f84e7b', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_comum`
--

CREATE TABLE IF NOT EXISTS `usuario_comum` (
  `email_usuario` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  PRIMARY KEY (`email_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario_comum`
--

INSERT INTO `usuario_comum` (`email_usuario`, `nome_usuario`) VALUES
('admin', 'admin'),
('carol@email.com', 'CarolMotta'),
('julia@email.com', 'JuliaCosta'),
('leandro@email.com', 'LeandroFilie');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_psicologo`
--

CREATE TABLE IF NOT EXISTS `usuario_psicologo` (
  `email_usuario` varchar(100) NOT NULL,
  `registro` varchar(11) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `situacao` int(1) NOT NULL,
  PRIMARY KEY (`email_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario_psicologo`
--

INSERT INTO `usuario_psicologo` (`email_usuario`, `registro`, `cidade`, `uf`, `situacao`) VALUES
('carol@psicologa.com', '33333333333', 'Franca', 'SP', 1),
('julia@psicologa.com', '11111111111', 'São Paulo', 'SP', 1),
('leandro@psicologo.com', '22222222222', 'Ribeirão Preto', 'SP', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `area_resultado`
--
ALTER TABLE `area_resultado`
  ADD CONSTRAINT `area_resultado_ibfk_1` FOREIGN KEY (`cod_resultado`) REFERENCES `resultado` (`id_resultado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `area_resultado_ibfk_2` FOREIGN KEY (`cod_area`) REFERENCES `area` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`cod_postagem`) REFERENCES `postagem` (`id_postagem`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `curtida`
--
ALTER TABLE `curtida`
  ADD CONSTRAINT `curtida_ibfk_1` FOREIGN KEY (`cod_postagem`) REFERENCES `postagem` (`id_postagem`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `curtida_ibfk_2` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `usuario_testepronto_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_testepronto_ibfk_2` FOREIGN KEY (`cod_teste`) REFERENCES `teste_pronto` (`id_teste`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09-Nov-2021 às 22:59
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
-- Estrutura da tabela `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` longtext NOT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `area`
--

INSERT INTO `area` (`id_area`, `nome`, `descricao`) VALUES
(1, 'Ciências Exatas e da Terra', 'Primeiramente, você precisa ter em mente que a matemática e os números são a base dessa área! Ela pode englobar cursos muito diferentes, mas como característica em comum, são cursos baseados em cálculos físico-matemáticos.'),
(2, 'Ciências Biológicas', 'Essa é a área da biologia. Tudo nela vai se relacionar com a natureza, e vai englobar estudos aprofundados sobre toda vida existente no planeta Terra. Você precisa estar preparado pra aprender tudo nos mínimos detalhes, desde quando tudo surgiu até hoje!'),
(3, 'Engenharias', 'Na área das engenharias, a ciência é aplicada e utilizada na prática, atuando muito na economia. Atualmente, existem 34 tipos de engenharia pra você decidir em qual se encaixa melhor. Vale lembrar que envolve cálculos e a habilidade que você tem com a criação, já que na prática vão ter muitos processos, inclusive o de criação!'),
(4, 'Ciências da Saúde', 'Como o próprio nome diz, trata de tudo relacionado a saúde, seja atendendo diretamente o público ou atuando na área da pesquisa. Os cursos vão envolver muita biologia e conhecimento do corpo humano. Vale ressaltar que a saúde não envolve somente a medicina, mas também outros cursos, como a psicologia, fisioterapia, fonoaudiologia, dentre tantos outros.'),
(5, 'Ciências Agrárias', 'Essa área se envolve de uma maneira única com a natureza, principalmente em sua aplicação. Possui diversos cursos, que buscam melhorar a questão da preservação do meio ambiente, utilizando a tecnologia e o conhecimento como base e auxílio. Envolve de A até Z: desde agronomia até a zootecnia! Sua área de atuação irá depender muito do lugar em que você estará situado.\r\n\r\n'),
(6, 'Ciências Sociais Aplicadas', 'Possui diversos cursos em sua área, mas todos estão conectados com um propósito: entender a sociedade, suas necessidades e a convivência nela, principalmente as consequências dessa convivência. As ciências sociais envolvem desde a administração, audiovisual, e comunicação, até o próprio curso de ciências sociais. É necessário estudar o indivíduo e suas atitudes, o que elas refletem na sociedade.'),
(7, 'Ciências Humanas', 'Nessa área, será estudado o ser humano, seus ideais, suas diferentes histórias e culturas, acontecimentos marcantes. Podemos citar a história, artes, filosofia e todas as suas vertentes e até mesmo a geografia em sua parte social.'),
(8, 'Linguística, Letras e Artes', 'Trata da comunicação! Seja ela através de palavras, numa língua, ou seja ela expressada através da arte. Além de poder estudar línguas e estrutura linguística, também pode trazer todas as formas de arte, sejam no cinema, obras, teatro ou músicas!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE IF NOT EXISTS `comentario` (
  `email_usuario` varchar(100) NOT NULL,
  `cod_postagem` int(11) NOT NULL,
  `conteudo` varchar(500) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`data`,`hora`),
  KEY `cod_postagem` (`cod_postagem`),
  KEY `comentario_ibfk_1` (`email_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cod_area` int(11) NOT NULL,
  PRIMARY KEY (`id_curso`),
  KEY `cod_area` (`cod_area`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`, `cod_area`) VALUES
(1, 'Matemática', 1),
(4, 'Ciência da Computação', 1),
(5, 'Probabilidade e Estatística', 1),
(7, 'Astronomia', 1),
(8, 'Física', 1),
(9, 'Biologia Geral', 2),
(10, 'Zoologia', 2),
(11, 'Bioquímica', 2),
(12, 'Farmacologia', 2),
(13, 'Imunologia', 2),
(14, 'Engenharia Civil', 3),
(15, 'Engenharia Elétrica', 3),
(16, 'Engenharia Mecânica', 3),
(17, 'Engenharia Química', 3),
(18, 'Engenharia de Produção', 3),
(19, 'Medicina', 4),
(20, 'Odontologia', 4),
(21, 'Farmácia', 4),
(22, 'Enfermagem', 4),
(23, 'Nutrição', 4),
(24, 'Agronomia', 5),
(25, 'Medicina Veterinária', 5),
(26, 'Engenharia de Pesca', 5),
(27, 'Ciência e Tecnologia de Alimentos', 5),
(28, 'Engenharia Agrícola', 5),
(29, 'Direito', 6),
(30, 'Administração', 6),
(31, 'Economia', 6),
(32, 'Arquitetura e Urbanismo', 6),
(33, 'Serviço Social', 6),
(34, 'Filosofia', 7),
(35, 'Sociologia', 7),
(36, 'História', 7),
(37, 'Geografia', 7),
(38, 'Teologia', 7),
(39, 'Linguística', 8),
(40, 'Letras', 8),
(41, 'Artes', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtida`
--

DROP TABLE IF EXISTS `curtida`;
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
('jessica@gmail.com', 10, '2021-11-03', '16:23:55'),
('jessica@gmail.com', 11, '2021-11-03', '16:22:38'),
('juliamacosta3@gmail.com', 12, '2021-11-03', '16:46:10'),
('mottascaroline@gmail.com', 5, '2021-11-03', '16:46:59'),
('mottascaroline@gmail.com', 8, '2021-11-03', '16:48:58'),
('mottascaroline@gmail.com', 9, '2021-11-03', '16:14:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao`
--

DROP TABLE IF EXISTS `inscricao`;
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
('jessica@gmail.com', 2, '2021-11-03', '16:22:17'),
('juliamacosta3@gmail.com', 5, '2021-11-03', '16:45:36'),
('leandro@email.com', 5, '2021-11-02', '17:38:00'),
('mottascaroline@gmail.com', 2, '2021-11-03', '16:13:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem`
--

DROP TABLE IF EXISTS `postagem`;
CREATE TABLE IF NOT EXISTS `postagem` (
  `id_postagem` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `conteudo` varchar(500) DEFAULT NULL,
  `imagem` varchar(50) DEFAULT NULL,
  `situacao` int(11) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `cod_rede` int(11) NOT NULL,
  PRIMARY KEY (`id_postagem`,`email_usuario`,`cod_rede`),
  KEY `email_usuario` (`email_usuario`),
  KEY `cod_rede` (`cod_rede`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `postagem`
--

INSERT INTO `postagem` (`id_postagem`, `data`, `hora`, `conteudo`, `imagem`, `situacao`, `email_usuario`, `cod_rede`) VALUES
(1, '2021-11-02', '17:32:10', 'Licenciatura em Química, pela professora Elaine Muniz\r\n<div>\r\n<iframe width=\"100%\" height=\"360\" src=\"https://www.youtube.com/embed/_7cru4_WFD4\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen loading=\"lazy\"></iframe>\r\n</div>', NULL, 1, 'admin', 1),
(2, '2021-11-02', '17:33:18', 'Licenciatura em Matemática, pela professora Larissa Gehrinh\r\n<div>\r\n<iframe width=\"100%\" height=\"360\" src=\"https://www.youtube.com/embed/QxhaytSA8Fo\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen loading=\"lazy\"></iframe>\r\n</div>', NULL, 1, 'admin', 1),
(3, '2021-11-02', '17:36:39', 'Licenciatura em Física, pelo professor Marcos Ribeiro\r\n<div>\r\n<iframe width=\"100%\" height=\"360\" src=\"https://www.youtube.com/embed/5y0ib9hl7Pw\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen loading=\"lazy\"></iframe>\r\n</div>', NULL, 1, 'admin', 1),
(4, '2021-11-02', '17:39:40', 'Bacharelado em Engenharia Civil, por Diego Almeida\r\n<div>\r\n<iframe width=\"100%\" height=\"360\" src=\"https://www.youtube.com/embed/AR0CLi39rdg\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen loading=\"lazy\"></iframe>\r\n</div>', NULL, 1, 'admin', 3),
(5, '2021-11-02', '17:40:51', 'Bacharelado em Medicina Veterinária, por Aline Chechi\r\n<div>\r\n<iframe width=\"100%\" height=\"360\" src=\"https://www.youtube.com/embed/IISz0CxXA3w\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen loading=\"lazy\"></iframe>\r\n</div>', NULL, 1, 'admin', 5),
(6, '2021-11-02', '17:43:40', 'Técnologo em Logística e bacharelado em Administração, por Thiago Camargo\r\n<div>\r\n<iframe width=\"100%\" height=\"360\" src=\"https://www.youtube.com/embed/uq1XardkBLE\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen loading=\"lazy\"></iframe>\r\n</div>', NULL, 1, 'admin', 6),
(7, '2021-11-02', '17:44:58', 'Gestão de Recursos Humanos, por Daiane\r\n<div>\r\n<iframe width=\"100%\" height=\"360\" src=\"https://www.youtube.com/embed/OL_OB5vU1Vc\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen loading=\"lazy\"></iframe>\r\n</div>', NULL, 1, 'admin', 6),
(8, '2021-11-02', '17:49:37', 'Letras, por Rafaella Goffredo\r\n<div>\r\n<iframe width=\"100%\" height=\"360\" src=\"https://www.youtube.com/embed/4pihuUkEChk\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen loading=\"lazy\"></iframe>\r\n</div>', NULL, 1, 'admin', 8),
(9, '2021-11-02', '17:50:31', 'Bacharelado em Psicologia, por Paloma\r\n<div>\r\n<iframe width=\"100%\" height=\"360\" src=\"https://www.youtube.com/embed/Bk19_DTz6_Y\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen loading=\"lazy\"></iframe>\r\n</div>', NULL, 1, 'admin', 7),
(10, '2021-11-02', '17:51:20', 'Licenciatura em Ciências Biológicas, pela professora Carla Lorenzi\r\n<div>\r\n<iframe width=\"100%\" height=\"360\" src=\"https://www.youtube.com/embed/HheoHKYX_ls\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen loading=\"lazy\"></iframe>\r\n</div>', NULL, 1, 'admin', 2),
(11, '2021-11-03', '16:19:24', 'futura facul!!!', 'https://i.imgur.com/XoRsbrB.jpg', 1, 'mottascaroline@gmail.com', 7),
(12, '2021-11-03', '16:24:26', 'oii povo, bem vindos!!!\r\n\r\no que vocês querem cursar em humanas?\r\n\r\nme: história <3', NULL, 1, 'mottascaroline@gmail.com', 7),
(13, '2021-11-03', '16:48:21', 'Oi galera, meu primeiro post aqui!! Quais faculdades vcs mais gostam dentro dessa área??? ', NULL, 1, 'juliamacosta3@gmail.com', 5),
(14, '2021-11-03', '16:49:56', 'oi genteeee! to em dúvida de carreira, quero dar uma passada aqui também :)', NULL, 1, 'mottascaroline@gmail.com', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rede`
--

DROP TABLE IF EXISTS `rede`;
CREATE TABLE IF NOT EXISTS `rede` (
  `id_rede` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cod_area` int(11) NOT NULL,
  PRIMARY KEY (`id_rede`),
  KEY `cod_area` (`cod_area`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
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
('jessica@gmail.com', 'Jessica Roberta', 'e10adc3949ba59abbe56e057f20f883e', 2),
('joao_gabriel_mattos@email.com', 'João Gabriel Mattos', '827ccb0eea8a706c4c34a16891f84e7b', 3),
('julia@email.com', 'Julia Costa', '827ccb0eea8a706c4c34a16891f84e7b', 2),
('juliamacosta3@gmail.com', 'Julia Maria ', '882f6311323bb629e3ff2ecdfe0eb49a', 2),
('leandro@email.com', 'Leandro Filié', '827ccb0eea8a706c4c34a16891f84e7b', 2),
('luiza_souza@email.com', 'Luiza Souza', '827ccb0eea8a706c4c34a16891f84e7b', 3),
('mariana_menezes@email.com', 'Mariana Menezes', '827ccb0eea8a706c4c34a16891f84e7b', 3),
('mottascaroline@gmail.com', 'Caroline da Silva Motta', 'ac8c6b4cc3d8ee9edca698f177147e3a', 2),
('ricardo_lima@email.com', 'Ricardo Lima', '827ccb0eea8a706c4c34a16891f84e7b', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_comum`
--

DROP TABLE IF EXISTS `usuario_comum`;
CREATE TABLE IF NOT EXISTS `usuario_comum` (
  `email_usuario` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT './assets/images/avatar.svg',
  PRIMARY KEY (`email_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario_comum`
--

INSERT INTO `usuario_comum` (`email_usuario`, `nome_usuario`, `avatar`) VALUES
('admin', 'admin', './assets/images/avatar.svg'),
('carol@email.com', 'CarolMotta', './assets/images/avatar.svg'),
('jessica@gmail.com', 'je_roberta ', './assets/images/avatar.svg'),
('julia@email.com', 'JuliaCosta', './assets/images/avatar.svg'),
('juliamacosta3@gmail.com', 'juliamaria', './assets/images/avatar.svg'),
('leandro@email.com', 'LeandroFilie', './assets/images/avatar.svg'),
('mottascaroline@gmail.com', 'mottacarol', 'https://i.imgur.com/2s1QiMJ.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_psicologo`
--

DROP TABLE IF EXISTS `usuario_psicologo`;
CREATE TABLE IF NOT EXISTS `usuario_psicologo` (
  `email_usuario` varchar(100) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `registro` varchar(11) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `situacao` int(1) NOT NULL,
  PRIMARY KEY (`email_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario_psicologo`
--

INSERT INTO `usuario_psicologo` (`email_usuario`, `telefone`, `registro`, `cidade`, `uf`, `situacao`) VALUES
('joao_gabriel_mattos@email.com', '(44) 4444-4444', '55555555555', 'Araraquara', 'SP', 1),
('luiza_souza@email.com', '(22) 2222-2222', '11111111111', 'São Paulo', 'SP', 2),
('mariana_menezes@email.com', '(11) 1111-1111', '33333333333', 'Franca', 'SP', 3),
('ricardo_lima@email.com', '(33) 3333-3333', '44444444444', 'São Carlos', 'SP', 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`cod_postagem`) REFERENCES `postagem` (`id_postagem`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`cod_area`) REFERENCES `area` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Limitadores para a tabela `usuario_comum`
--
ALTER TABLE `usuario_comum`
  ADD CONSTRAINT `usuario_comum_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario_psicologo`
--
ALTER TABLE `usuario_psicologo`
  ADD CONSTRAINT `usuario_psicologo_ibfk_1` FOREIGN KEY (`email_usuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

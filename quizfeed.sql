-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 09-Set-2021 às 14:41
-- Versão do servidor: 5.6.51
-- versão do PHP: 8.0.7

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

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `area`
--

INSERT INTO `area` (`id_area`, `nome`, `descricao`) VALUES
(1, 'Ciências Exatas e da Terra', 'Primeiramente, você precisa ter em mente que a matemática e os números são a base dessa área! Ela pode englobar cursos muito diferentes, mas como característica em comum, são cursos baseados em cálculos físico-matemáticos. Engloba a matemática, física, computação, astromia, química, mecânica e vertentes que esses cursos podem ter.'),
(2, 'Ciências Biológicas', 'Essa é a área da biologia. Tudo nela vai se relacionar com a natureza, e vai englobar estudos aprofundados sobre toda vida existente no planeta Terra. Você precisa estar preparado pra aprender tudo nos mínimos detalhes, desde quando tudo surgiu até hoje!'),
(3, 'Engenharias', 'Na área das engenharias, a ciência é aplicada e utilizada na prática, atuando muito na economia. Atualmente, existem 34 tipos de engenharia pra você decidir em qual se encaixa melhor. Vale lembrar que envolve cálculos e a habilidade que você tem com a criação, já que na prática vão ter muitos processos, inclusive o de criação!'),
(4, 'Ciências da Saúde', 'Como o próprio nome diz, trata de tudo relacionado a saúde, seja atendendo diretamente o público ou atuando na área da pesquisa. O curso vai envolver muita biologia e conhecimento do corpo humano. Vale ressaltar que a saúde não envolve somente a medicina, mas também outros cursos, como a psicologia, fisioterapia, fonoaudiologia, dentre tantos outros.'),
(5, 'Ciências Agrárias', 'Bom, essa área se envolve de uma maneira única com a natureza, principalmente em sua aplicação. Possui diversos cursos, que buscam melhorar a questão da preservação do meio ambiente, utilizando a tecnologia e o conhecimento como base e auxílio. Envolve de A até Z: desde agronomia até a zootecnia! Sua área de atuação irá depender muito do lugar em que você estará situado.\n\nBom, essa área se envolve de uma maneira única com a natureza, principalmente em sua aplicação. Possui diversos cursos, que buscam melhorar a questão da preservação do meio ambiente, utilizando a tecnologia e o conhecimento como base e auxílio. Envolve de A até Z: desde agronomia até a zootecnia! Sua área de atuação irá depender muito do lugar em que você estará situado.\n\n'),
(6, 'Ciências Sociais Aplicadas', 'Possui diversos cursos em sua área, mas todos estão conectados com um propósito: entender a sociedade, suas necessidades e a convivência nela, principalmente as consequências dessa convivência. As ciências sociais envolvem desde a administração, audiovisual (cinema, vídeo, rádio, TV e internet), e comunicação, até o próprio curso de ciências sociais. É necessário estudar o indivíduo e suas atitudes, o que elas refletem na sociedade. Para isso, é necessário saber de todas as teorias que são usadas para entender tantas coisas!'),
(7, 'Ciências Humanas', 'Nessa área, será estudo o ser humano, mas não como na saúde ou a biologia, que estuda o corpo, mas será estudado seus ideais, suas diferentes histórias e culturas, acontecimentos marcantes. Podemos citar a história, artes, filosofia e todas as suas vertentes, até mesmo a geografia em sua parte social, com o estudo da globalização e das mudanças causadas pelo ser humano até hoje.'),
(8, 'Linguística, Letras e Artes', 'Trata da comunicação! Seja ela através de palavras, numa língua, ou seja ela expressada através da arte. Além de poder estudar línguas e estrutura linguística, também pode trazer todas as formas de arte, sejam no cinema, obras, teatro ou músicas!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `email_usuario` varchar(100) NOT NULL,
  `cod_postagem` int(11) NOT NULL,
  `conteudo` varchar(500) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cod_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id_curso`, `nome`, `cod_area`) VALUES
(1, 'Matemática', 1),
(3, 'Probabilidade e Estatística', 1),
(4, 'Ciência da Computação', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtida`
--

CREATE TABLE `curtida` (
  `email_usuario` varchar(100) NOT NULL,
  `cod_postagem` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricao`
--

CREATE TABLE `inscricao` (
  `email_usuario` varchar(100) NOT NULL,
  `cod_rede` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem`
--

CREATE TABLE `postagem` (
  `id_postagem` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `conteudo` varchar(500) NOT NULL,
  `situacao` int(11) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `cod_rede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rede`
--

CREATE TABLE `rede` (
  `id_rede` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cod_area` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `usuario` (
  `email` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `permissao` int(1) NOT NULL
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

CREATE TABLE `usuario_comum` (
  `email_usuario` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL
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

CREATE TABLE `usuario_psicologo` (
  `email_usuario` varchar(100) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `registro` varchar(11) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `situacao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario_psicologo`
--

INSERT INTO `usuario_psicologo` (`email_usuario`, `telefone`, `registro`, `cidade`, `uf`, `situacao`) VALUES
('carol@psicologa.com', '(11) 1111-1111', '33333333333', 'Franca', 'SP', 2),
('julia@psicologa.com', '(22) 2222-2222', '11111111111', 'São Paulo', 'SP', 2),
('leandro@psicologo.com', '(33) 3333-3333', '22222222222', 'Ribeirão Preto', 'SP', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`data`,`hora`),
  ADD KEY `cod_postagem` (`cod_postagem`),
  ADD KEY `comentario_ibfk_1` (`email_usuario`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `cod_area` (`cod_area`);

--
-- Índices para tabela `curtida`
--
ALTER TABLE `curtida`
  ADD PRIMARY KEY (`email_usuario`,`cod_postagem`),
  ADD KEY `cod_postagem` (`cod_postagem`);

--
-- Índices para tabela `inscricao`
--
ALTER TABLE `inscricao`
  ADD PRIMARY KEY (`email_usuario`,`cod_rede`),
  ADD KEY `cod_rede` (`cod_rede`);

--
-- Índices para tabela `postagem`
--
ALTER TABLE `postagem`
  ADD PRIMARY KEY (`id_postagem`,`email_usuario`,`cod_rede`),
  ADD KEY `email_usuario` (`email_usuario`),
  ADD KEY `cod_rede` (`cod_rede`);

--
-- Índices para tabela `rede`
--
ALTER TABLE `rede`
  ADD PRIMARY KEY (`id_rede`),
  ADD KEY `cod_area` (`cod_area`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `usuario_comum`
--
ALTER TABLE `usuario_comum`
  ADD PRIMARY KEY (`email_usuario`);

--
-- Índices para tabela `usuario_psicologo`
--
ALTER TABLE `usuario_psicologo`
  ADD PRIMARY KEY (`email_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `postagem`
--
ALTER TABLE `postagem`
  MODIFY `id_postagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rede`
--
ALTER TABLE `rede`
  MODIFY `id_rede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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

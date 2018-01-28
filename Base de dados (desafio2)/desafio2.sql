-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Jan-2018 às 14:28
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desafio2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `artigo`
--

CREATE TABLE `artigo` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `imgPath` varchar(255) NOT NULL,
  `altImg` varchar(40) NOT NULL,
  `preco` decimal(7,2) NOT NULL,
  `stock` int(10) NOT NULL,
  `dono` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `artigo`
--

INSERT INTO `artigo` (`id`, `nome`, `descricao`, `imgPath`, `altImg`, `preco`, `stock`, `dono`) VALUES
(12, 'Smilhas', 'Smilha da boa!', 'http://2.bp.blogspot.com/_X0hnAB7D3rg/S5xHKC4PLqI/AAAAAAAAEeY/ngPWXM27RJQ/w1200-h630-p-k-no-nu/batata.JPG', 'Smilhas', '0.99', 120, 4),
(13, 'Batata Doce', 'Batata Doce muito doce', 'http://barrigalisa.pt/wp-content/uploads/2014/11/batata-doce-beneficios-e-propriedades.jpg', 'Batata Doce', '4.36', 250, 4),
(16, 'Pimpinela', 'Pimpinela da Madeira', 'http://www.feiradamarta.com.br/produtos/20160509_132908_cooperall_legumes_chuchu.jpg', 'Pimpinela', '1.24', 75, 5),
(17, 'FeijÃ£o Verde', 'FeijÃ£o Verde', 'https://clinicadotempo.com/sites/all/files/imagens/noticias/dieta-de-feijao-verde.jpg', 'FeijÃ£o Verde', '3.23', 54, 5),
(19, 'MaÃ§as Vermelhas', 'MaÃ§as Vermelhas Docinhas', 'http://www.dicasnutricao.com.br/wp-content/uploads/2015/06/beneficios-da-maca.jpg', 'MaÃ§as Vermelhas', '4.76', 200, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nome_cliente` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mensagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contacto`
--

INSERT INTO `contacto` (`id`, `nome_cliente`, `email`, `mensagem`) VALUES
(3, 'Bill Gates', 'billgates@gmail.com', 'Exelente trabalho!!! Mereces 20!!'),
(4, 'Mark Zuckerberg', 'markzuckerberg@gmail.com', 'Tens futuro na progrmaÃ§Ã£o, infelizmente nÃ£o tenho dinheiro para pagar um exelente profissional como tu Pedro Pita! :(');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dono`
--

CREATE TABLE `dono` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dono`
--

INSERT INTO `dono` (`id`, `nome`, `user`, `password`, `email`, `nivel`) VALUES
(1, 'aluno', 'aluno', '23a6a3cf06cfd8b1a6cda468e5756a6a6a1d21e7', 'aluno@gmail.com', 1),
(4, 'pedro', 'pedro', '4410d99cefe57ec2c2cdbd3f1d5cf862bb4fb6f8', 'pedro@gmail.com', 2),
(5, 'pita', 'pita', '30ef03f5156b84eb176139be8aef8132afc1f28e', 'pita@gmail.com', 2),
(11, 'xau', 'xau', 'f3b99e0d8b2ec6d2a845bb0d519e18ce1ab5f2f7', 'xau@das.com', 3),
(12, 'asd', 'asd', 'f10e2821bbbea527ea02200352313bc059445190', 'asdasd@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artigo`
--
ALTER TABLE `artigo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dono` (`dono`);

--
-- Indexes for table `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dono`
--
ALTER TABLE `dono`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artigo`
--
ALTER TABLE `artigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dono`
--
ALTER TABLE `dono`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `artigo`
--
ALTER TABLE `artigo`
  ADD CONSTRAINT `fk_dono` FOREIGN KEY (`dono`) REFERENCES `dono` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

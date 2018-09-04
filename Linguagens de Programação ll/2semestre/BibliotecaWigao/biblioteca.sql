-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3307
-- Generation Time: 04-Set-2018 às 22:23
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_aluguel`
--

CREATE TABLE `tbl_aluguel` (
  `id_cliente` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `dia_aluguel` datetime NOT NULL,
  `dia_devolucao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_aluguel`
--

INSERT INTO `tbl_aluguel` (`id_cliente`, `id_livro`, `dia_aluguel`, `dia_devolucao`) VALUES
(2, 2, '2018-09-04 16:41:24', '2018-09-04 16:41:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `id_cliente` int(11) NOT NULL,
  `cpf` text NOT NULL,
  `nome` varchar(50) NOT NULL,
  `idade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_cliente`
--

INSERT INTO `tbl_cliente` (`id_cliente`, `cpf`, `nome`, `idade`) VALUES
(1, '328.926.998-19', 'Igor', 21),
(2, '111.111.111-11', 'igor1', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_livro`
--

CREATE TABLE `tbl_livro` (
  `id_livro` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `genero` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_livro`
--

INSERT INTO `tbl_livro` (`id_livro`, `nome`, `autor`, `genero`) VALUES
(1, 'Cronicas de Narnia', 'Alguem', 'loucura');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_aluguel`
--
ALTER TABLE `tbl_aluguel`
  ADD PRIMARY KEY (`id_cliente`,`id_livro`);

--
-- Indexes for table `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `tbl_livro`
--
ALTER TABLE `tbl_livro`
  ADD PRIMARY KEY (`id_livro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_livro`
--
ALTER TABLE `tbl_livro`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

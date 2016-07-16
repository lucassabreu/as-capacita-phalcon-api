-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 16/07/2016 às 12:51
-- Versão do servidor: 5.5.49-MariaDB-1ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `as-capacita-phalcon`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `moviments`
--

CREATE TABLE `moviments` (
  `iMovimentId` int(11) UNSIGNED NOT NULL,
  `iUserId` int(10) UNSIGNED NOT NULL,
  `dtMoviment` date NOT NULL,
  `sDescription` varchar(200) NOT NULL,
  `sCategory` varchar(50) NOT NULL,
  `nValue` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `moviments`
--
ALTER TABLE `moviments`
  ADD PRIMARY KEY (`iMovimentId`),
  ADD KEY `idx_user_category` (`iUserId`,`sCategory`,`dtMoviment`),
  ADD KEY `idx_user_moviments` (`iUserId`,`iMovimentId`),
  ADD KEY `idx_user_dates` (`iUserId`,`dtMoviment`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `moviments`
--
ALTER TABLE `moviments`
  MODIFY `iMovimentId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `moviments`
--
ALTER TABLE `moviments`
  ADD CONSTRAINT `fk_moviments_users` FOREIGN KEY (`iUserId`) REFERENCES `users` (`iUserId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

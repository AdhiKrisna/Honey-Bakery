-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Nov 2023 pada 20.03
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakery`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cake`
--

CREATE TABLE `cake` (
  `id_cake` int(11) NOT NULL,
  `cake_name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `cake`
--

INSERT INTO `cake` (`id_cake`, `cake_name`, `type`, `price`, `image`) VALUES
(1, 'White Bread', 'Common Bread', 10000, 'bread.jpg'),
(2, 'Burned Bread', 'Common Bread', 14000, 'burn-bread.jpg'),
(3, 'Chocolate Cake', 'Cake', 22000, 'Chocolate-Cake.jpg'),
(4, 'English Muffin', 'Yeast Bread', 16000, 'english-muffin.jpg'),
(8, 'Bagel', 'Yeast Bread', 8000, 'bagel.jpg'),
(9, 'Cheese Cake', 'Cake', 19000, 'cheesecake.jpg'),
(10, 'Fruit Sandwich', 'Combined Bread', 30000, 'fruit-sandwich.jpg'),
(11, 'Sandwich', 'Combined Bread', 21000, 'sandwich.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail`
--

CREATE TABLE `detail` (
  `detail_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `cake_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `detail`
--

INSERT INTO `detail` (`detail_id`, `transaction_id`, `cake_id`, `quantity`, `total`) VALUES
(1, 1, 2, 3, 42000),
(2, 1, 3, 1, 22000),
(3, 1, 4, 5, 80000),
(4, 2, 1, 5, 50000),
(5, 2, 3, 1, 22000),
(6, 2, 4, 1, 16000),
(7, 2, 9, 3, 57000),
(8, 5, 2, 2, 28000),
(9, 5, 3, 1, 22000),
(10, 5, 4, 1, 16000),
(11, 5, 10, 10, 300000),
(12, 6, 1, 3, 30000),
(13, 6, 2, 4, 56000),
(14, 6, 3, 7, 154000),
(15, 6, 4, 1, 16000),
(16, 6, 8, 3, 24000),
(17, 7, 1, 2, 20000),
(18, 7, 2, 2, 28000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `customer` varchar(20) NOT NULL,
  `amount_bread` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `customer`, `amount_bread`, `total`) VALUES
(1, 'krisna', 3, 144000),
(2, 'adhi', 4, 145000),
(5, 'peterpan', 4, 366000),
(6, 'vidyatma', 5, 280000),
(7, 'Mario Teguh', 2, 48000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('adhi', 'krisna'),
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cake`
--
ALTER TABLE `cake`
  ADD PRIMARY KEY (`id_cake`);

--
-- Indeks untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `fk_transaction_id` (`transaction_id`),
  ADD KEY `fk_cake_id` (`cake_id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cake`
--
ALTER TABLE `cake`
  MODIFY `id_cake` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `detail`
--
ALTER TABLE `detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `fk_cake_id` FOREIGN KEY (`cake_id`) REFERENCES `cake` (`id_cake`),
  ADD CONSTRAINT `fk_transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

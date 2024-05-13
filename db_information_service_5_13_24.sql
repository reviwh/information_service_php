-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Bulan Mei 2024 pada 11.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_information_service_5_13_24`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_beliefs_control`
--

CREATE TABLE `tb_beliefs_control` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `complaint_report` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_corruption_complaints`
--

CREATE TABLE `tb_corruption_complaints` (
  `id` int(11) NOT NULL,
  `reporter` varchar(255) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `report_brief` varchar(255) DEFAULT NULL,
  `complaint_report` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_election_posts`
--

CREATE TABLE `tb_election_posts` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `complaint_report` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_employee_complaints`
--

CREATE TABLE `tb_employee_complaints` (
  `id` int(11) NOT NULL,
  `reporter` varchar(255) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `complaint_report` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jms`
--

CREATE TABLE `tb_jms` (
  `id` int(11) NOT NULL,
  `intended_school` varchar(255) DEFAULT NULL,
  `applicant` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_legal_counselings`
--

CREATE TABLE `tb_legal_counselings` (
  `id` int(11) NOT NULL,
  `client` varchar(255) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `problem_form` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_beliefs_control`
--
ALTER TABLE `tb_beliefs_control`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_by` (`submitted_by`);

--
-- Indeks untuk tabel `tb_corruption_complaints`
--
ALTER TABLE `tb_corruption_complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_by` (`submitted_by`);

--
-- Indeks untuk tabel `tb_election_posts`
--
ALTER TABLE `tb_election_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_by` (`submitted_by`);

--
-- Indeks untuk tabel `tb_employee_complaints`
--
ALTER TABLE `tb_employee_complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_by` (`submitted_by`);

--
-- Indeks untuk tabel `tb_jms`
--
ALTER TABLE `tb_jms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_by` (`submitted_by`);

--
-- Indeks untuk tabel `tb_legal_counselings`
--
ALTER TABLE `tb_legal_counselings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `submitted_by` (`submitted_by`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_beliefs_control`
--
ALTER TABLE `tb_beliefs_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_corruption_complaints`
--
ALTER TABLE `tb_corruption_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_election_posts`
--
ALTER TABLE `tb_election_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_employee_complaints`
--
ALTER TABLE `tb_employee_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_jms`
--
ALTER TABLE `tb_jms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_legal_counselings`
--
ALTER TABLE `tb_legal_counselings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_beliefs_control`
--
ALTER TABLE `tb_beliefs_control`
  ADD CONSTRAINT `tb_beliefs_control_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_corruption_complaints`
--
ALTER TABLE `tb_corruption_complaints`
  ADD CONSTRAINT `tb_corruption_complaints_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_election_posts`
--
ALTER TABLE `tb_election_posts`
  ADD CONSTRAINT `tb_election_posts_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_employee_complaints`
--
ALTER TABLE `tb_employee_complaints`
  ADD CONSTRAINT `tb_employee_complaints_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_jms`
--
ALTER TABLE `tb_jms`
  ADD CONSTRAINT `tb_jms_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_legal_counselings`
--
ALTER TABLE `tb_legal_counselings`
  ADD CONSTRAINT `tb_legal_counselings_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

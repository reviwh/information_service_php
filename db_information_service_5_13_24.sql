-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Bulan Mei 2024 pada 19.25
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
  `id_number` char(16) DEFAULT NULL,
  `complaint_report` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_beliefs_control`
--

INSERT INTO `tb_beliefs_control` (`id`, `nama`, `no_telp`, `id_card`, `id_number`, `complaint_report`, `status`, `submitted_by`) VALUES
(1, 'test', '081234567890', 'test', '1234678901324354', 'test', 'approve', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_corruption_complaints`
--

CREATE TABLE `tb_corruption_complaints` (
  `id` int(11) NOT NULL,
  `reporter` varchar(255) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `id_number` char(16) DEFAULT NULL,
  `report_brief` varchar(255) DEFAULT NULL,
  `complaint_report` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_corruption_complaints`
--

INSERT INTO `tb_corruption_complaints` (`id`, `reporter`, `no_telp`, `id_card`, `id_number`, `report_brief`, `complaint_report`, `status`, `submitted_by`) VALUES
(1, 'test', '081234567890', 'test', '1234678901324354', 'test', 'test', 'rejected', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_election_posts`
--

CREATE TABLE `tb_election_posts` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `id_number` char(16) DEFAULT NULL,
  `complaint_report` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_election_posts`
--

INSERT INTO `tb_election_posts` (`id`, `nama`, `no_telp`, `id_card`, `id_number`, `complaint_report`, `status`, `submitted_by`) VALUES
(1, 'test', '081234567890', 'test', '1234678901324354', 'test', 'pending', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_employee_complaints`
--

CREATE TABLE `tb_employee_complaints` (
  `id` int(11) NOT NULL,
  `reporter` varchar(255) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `id_number` char(16) DEFAULT NULL,
  `complaint_report` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_employee_complaints`
--

INSERT INTO `tb_employee_complaints` (`id`, `reporter`, `no_telp`, `id_card`, `id_number`, `complaint_report`, `status`, `submitted_by`) VALUES
(4, 'test2', '1234567890', '/storage/employee_complaints/id_card/20240515171902_3. hdfs.pdf', '1234567890123456', '/storage/employee_complaints/complaint_report/20240515171902_3. hdfs.pdf', 'rejected', 4);

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

--
-- Dumping data untuk tabel `tb_jms`
--

INSERT INTO `tb_jms` (`id`, `intended_school`, `applicant`, `status`, `submitted_by`) VALUES
(1, 'test', 'test', 'approve', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_legal_counselings`
--

CREATE TABLE `tb_legal_counselings` (
  `id` int(11) NOT NULL,
  `client` varchar(255) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `id_number` char(16) DEFAULT NULL,
  `problem_form` varchar(255) DEFAULT NULL,
  `status` enum('pending','approve','rejected') DEFAULT NULL,
  `submitted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_legal_counselings`
--

INSERT INTO `tb_legal_counselings` (`id`, `client`, `no_telp`, `id_card`, `id_number`, `problem_form`, `status`, `submitted_by`) VALUES
(1, 'test', '081234567890', 'test', '1234678901324354', 'test', 'rejected', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT NULL,
  `token` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id`, `name`, `email`, `no_telp`, `id_card`, `password`, `address`, `role`, `token`) VALUES
(2, 'test', 'test23@example.net', '1234567890', '/storage/user/202405141609213. hdfs.pdf', '$2y$10$VZt23rvkIi50hAn84//bq.Mxwj0OlLILEIDdhVVLlwovUMtwCG/w.', 'atas tanah', 'admin', '3ded474c2292e58f39593d9c9cc2a5f2'),
(3, 'test', 'test23@example.net2', '1234567890', '/storage/user/202405141917223. hdfs.pdf', '$2y$10$xM4G98Q0s6Q3JVs/ExdzcOKT/bwgR65UbM67oAEYzIi5JoHHSVozy', 'pinggir jalan', 'admin', '7586468057ea94841a7d2e46d74e3dfe'),
(4, 'test', 'test232@example.net', '1234567890', '/storage/user/202405151157493. hdfs.pdf', '$2y$10$nxpmXepJM5JK31LC.NqSJe0DdYOtBvhmIn3aWA3iT2AW8EEwL.Tky', 'pinggir jalan', 'customer', '5a214427fa0fd390949b04bf7970485b'),
(5, 'test', 'test2232@example.net', '1234567890', '/storage/user/202405151746553. hdfs.pdf', '$2y$10$dpOrgxvZH8EAP8kROCvtOOgdHyQdw2VcddAetPPzdPf3KfQIw8T02', 'pinggir jalan', 'customer', 'ae6b2e7caac4cb56f10d885f62c31e07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users_survey`
--

CREATE TABLE `tb_users_survey` (
  `email` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL,
  `suggestion` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_beliefs_control`
--
ALTER TABLE `tb_beliefs_control`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_beliefs_control_ibfk_1` (`submitted_by`);

--
-- Indeks untuk tabel `tb_corruption_complaints`
--
ALTER TABLE `tb_corruption_complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_corruption_complaints_ibfk_1` (`submitted_by`);

--
-- Indeks untuk tabel `tb_election_posts`
--
ALTER TABLE `tb_election_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_election_posts_ibfk_1` (`submitted_by`);

--
-- Indeks untuk tabel `tb_employee_complaints`
--
ALTER TABLE `tb_employee_complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_employee_complaints_ibfk_1` (`submitted_by`);

--
-- Indeks untuk tabel `tb_jms`
--
ALTER TABLE `tb_jms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_jms_ibfk_1` (`submitted_by`);

--
-- Indeks untuk tabel `tb_legal_counselings`
--
ALTER TABLE `tb_legal_counselings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_legal_counselings_ibfk_1` (`submitted_by`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_beliefs_control`
--
ALTER TABLE `tb_beliefs_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_corruption_complaints`
--
ALTER TABLE `tb_corruption_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_election_posts`
--
ALTER TABLE `tb_election_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_employee_complaints`
--
ALTER TABLE `tb_employee_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_jms`
--
ALTER TABLE `tb_jms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_legal_counselings`
--
ALTER TABLE `tb_legal_counselings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_beliefs_control`
--
ALTER TABLE `tb_beliefs_control`
  ADD CONSTRAINT `tb_beliefs_control_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_corruption_complaints`
--
ALTER TABLE `tb_corruption_complaints`
  ADD CONSTRAINT `tb_corruption_complaints_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_election_posts`
--
ALTER TABLE `tb_election_posts`
  ADD CONSTRAINT `tb_election_posts_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_employee_complaints`
--
ALTER TABLE `tb_employee_complaints`
  ADD CONSTRAINT `tb_employee_complaints_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_jms`
--
ALTER TABLE `tb_jms`
  ADD CONSTRAINT `tb_jms_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_legal_counselings`
--
ALTER TABLE `tb_legal_counselings`
  ADD CONSTRAINT `tb_legal_counselings_ibfk_1` FOREIGN KEY (`submitted_by`) REFERENCES `tb_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Okt 2022 pada 04.35
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csr`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dana_alokasi`
--

CREATE TABLE `dana_alokasi` (
  `id_alokasi` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `tahun` year(4) NOT NULL,
  `dana_alokasi` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dana_alokasi`
--

INSERT INTO `dana_alokasi` (`id_alokasi`, `id_unit`, `tahun`, `dana_alokasi`) VALUES
(22, 800, 2022, 10000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(16, '2022_09_20_070727_creat_tb_unit', 2),
(17, '2022_09_20_070752_creat_tb_status', 3),
(18, '2022_09_26_070010_create_t_validasi', 4),
(19, '2022_09_29_180703_create_t_ba-pi', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_ba-pi`
--

CREATE TABLE `t_ba-pi` (
  `id_bapi` int(10) UNSIGNED NOT NULL,
  `nama` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bank` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_bank` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_bank` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_bapi_unit` bigint(20) NOT NULL,
  `jenis_bantuan` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saksi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_val_master` bigint(20) NOT NULL,
  `file_ba` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_pi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `t_ba-pi`
--

INSERT INTO `t_ba-pi` (`id_bapi`, `nama`, `jabatan`, `alamat`, `nama_bank`, `jabatan_bank`, `alamat_bank`, `id_bapi_unit`, `jenis_bantuan`, `saksi`, `id_val_master`, `file_ba`, `file_pi`, `created_at`, `updated_at`) VALUES
(19, '4. Tujuan Program Kemitraan', '4. Tujuan Program Kemitraan', '4. Tujuan Program Kemitraan', '4. Tujuan Program Kemitraan', '4. Tujuan Program Kemitraan', '4. Tujuan Program Kemitraan', 800, 'uang', '4. Tujuan Program Kemitraan,4. Tujuan Program Kemitraan,4. Tujuan Program Kemitraan,4. Tujuan Program Kemitraan', 43, NULL, NULL, '2022-10-19 18:49:56', '2022-10-19 18:49:56'),
(20, 'III. Form Pakta Intregitas', 'III. Form Pakta Intregitas', 'III. Form Pakta Intregitas', 'III. Form Pakta Intregitas', 'III. Form Pakta Intregitas', 'III. Form Pakta Intregitas', 800, 'barang', 'III. Form Pakta Intregitas,III. Form Pakta Intregitas,III. Form Pakta Intregitas,III. Form Pakta Intregitas', 44, NULL, NULL, '2022-10-19 18:53:01', '2022-10-19 18:53:01'),
(21, 'Agusss', 'Anggota', 'Jalan MEdan', 'Fahri', 'anggota', 'Jalan Medan', 800, 'uang', 'Dzira,Anggota,Sulaiman,Anggota', 46, NULL, NULL, '2022-10-19 19:30:10', '2022-10-19 19:30:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_master`
--

CREATE TABLE `t_master` (
  `id_master` bigint(20) NOT NULL,
  `no_surat_edoc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int(11) NOT NULL,
  `ruang_lingkup` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `peruntukan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_unit_master` bigint(20) NOT NULL,
  `file_val` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_bapi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_sk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `t_master`
--

INSERT INTO `t_master` (`id_master`, `no_surat_edoc`, `nama_kegiatan`, `lokasi_kegiatan`, `nominal`, `ruang_lingkup`, `peruntukan`, `status`, `id_unit_master`, `file_val`, `file_bapi`, `file_sk`, `created_at`, `updated_at`) VALUES
(43, 'SK/01/AA/0001', 'TEssssSS', 'dawawdaa', 2000000, 'Ekonomi', 'awwdwwdddd', 'SELESAI', 800, 'Simalungun/TEssssSS43/Kelengkapan Usulan.pdf', 'Simalungun/TEssssSS43/Berita Acara & Pakta Integritas.pdf', 'Simalungun/TEssssSS43/Surat Keputusan.pdf', '2022-10-19 18:11:05', '2022-10-19 19:11:57'),
(44, 'SK/02/AB/0002', 'SSSSAAA', 'WNWNWNWN', 3000000, 'Ekonomi', 'awddwda', 'DOKUMENTASI', 800, NULL, NULL, NULL, '2022-10-19 18:16:01', '2022-10-19 18:53:01'),
(46, 'SK/02/AA/0002', 'Pembangunan Kota', 'Pematang Raya', 80000000, 'Ekonomi', 'awwdaadad', 'SELESAI', 800, 'Simalungun/Pembangunan Kota46/Kelengkapan Usulan.pdf', 'Simalungun/Pembangunan Kota46/Berita Acara & Pakta Integritas.pdf', 'Simalungun/Pembangunan Kota46/Surat Keputusan.pdf', '2022-10-19 19:28:10', '2022-10-19 19:32:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_unit`
--

CREATE TABLE `t_unit` (
  `id_unit` bigint(20) NOT NULL,
  `pemda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_cabang` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `t_unit`
--

INSERT INTO `t_unit` (`id_unit`, `pemda`, `nama_unit`, `kd_cabang`) VALUES
(798, 'Pemprovsu', 'Cabkor Medan', 100),
(799, 'Tapanuli Selatan', 'Cabang Sipirok', 233),
(800, 'Simalungun', 'Cabang Pematang Raya', 225),
(801, 'Deli Serdang', 'Cabang Lubuk Pakam', 106),
(802, 'Labuhan Batu', 'Cabang Rantauprapat', 210),
(803, 'Tebing Tinggi', 'Cabang Tebing Tinggi', 300),
(804, 'Medan', 'Cabkor Medan', 100),
(805, 'Tapanuli Tengah', 'Cabang Pandan', 291),
(806, 'Nias', 'Cabang Gunung Sitoli', 270),
(807, 'Asahan', 'Cabang Kisaran', 260),
(808, 'Tapanuli Utara', 'Cabang Tarutung', 323),
(809, 'Pematang Siantar', 'Cabang Pematang Siantar', 220),
(810, 'Padang Sidimpuan', 'Cabang Padangsidimpuan', 230),
(811, 'Dairi', 'Cabang Sidikalang', 280),
(812, 'Tanjung Balai', 'Cabang Tanjung Balai', 330),
(813, 'Sibolga', 'Cabang Sibolga', 290),
(814, 'Langkat', 'Cabang Stabat', 311),
(815, 'Mandailing Natal', 'Cabang Panyabungan', 340),
(816, 'Padang Lawas', 'Cabang Sibuhuan', 234),
(817, 'H Hasundutan', 'Cabang Dolok Sanggul', 321),
(818, 'Toba Samosir', 'Cabang Balige', 240),
(819, 'Karo', 'Cabang Kabanjahe', 250),
(820, 'Binjai', 'Cabang Binjai', 310),
(821, 'Serdang Bedagai', 'Cabang Sei Rampah', 302),
(822, 'Samosir', 'Cabang Pangururan', 241),
(823, 'Nias Selatan', 'Cabang Teluk Dalam', 271),
(824, 'Pakpak Bharat', 'Cabang Pembantu Salak', 281),
(825, 'Padang Lawas Utara', 'Cabang Gunung Tua', 231),
(826, 'Labusel', 'Cabang Kota Pinang', 212),
(827, 'Labura', 'Cabang Aek Kanopan', 211),
(828, 'Batubara', 'Cabang Lima Puluh', 262),
(829, 'Pemko Gn Sitoli', 'Cabang Gunung Sitoli', 270),
(830, 'Nias Barat', 'Cabang Pembantu Lahomi', 273),
(831, 'Nias Utara', 'Cabang Pembantu Lotu', 272);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_validasi`
--

CREATE TABLE `t_validasi` (
  `id_validasi` int(10) UNSIGNED NOT NULL,
  `prop_rencana` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_judul` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_jumlah` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_norek` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_pernyataan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_permohonan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `check_data_diri` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_ket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sasaran_prog` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan_prog` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kesimpulan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_val_master` bigint(20) DEFAULT NULL,
  `file_val` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `t_validasi`
--

INSERT INTO `t_validasi` (`id_validasi`, `prop_rencana`, `check_judul`, `check_jumlah`, `check_norek`, `surat_pernyataan`, `surat_permohonan`, `check_data_diri`, `surat_ket`, `sasaran_prog`, `tujuan_prog`, `kesimpulan`, `id_val_master`, `file_val`, `created_at`, `updated_at`) VALUES
(32, 'Ya,Wwdd', 'Ya', 'Ya', 'Ya', 'No,No', 'No,No', 'Ya,Terlampir', 'No,No', '4. Tujuan Program Kemitraan', '4. Tujuan Program Kemitraan', 'haudbkubkabka,bakdbkjbdkwbdakjb,bakdbjdbjdbjdbjk', 43, NULL, '2022-10-19 18:49:56', '2022-10-19 18:49:56'),
(33, 'Ya,adwddd', 'Ya', 'Ya', 'Ya', 'Ya,NOOO1', 'Ya,NOOO2', 'Ya,Terlampir', 'Ya,NOOO3', '3. Sasaran Program Kemitraan', '4. Tujuan Program Kemitraan', ',,', 44, NULL, '2022-10-19 18:53:01', '2022-10-19 18:55:35'),
(34, 'Ya,Pembangunan', 'Ya', 'Ya', 'Ya', 'No,No', 'No,No', 'Ya,Terlampir', 'No,No', '3. Sasaran Program Kemitraan', '4. Tujuan Program Kemitraan', 'Sasaran Program,Tujuan Program,Kelengkapan Administratif', 46, NULL, '2022-10-19 19:30:10', '2022-10-19 19:30:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','petugas','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$qmf6vRO4.FcGb5Sa1iB1kOjuQN/rmAyrPDXMz5TlJKevno/nmJP3e', '59wj0w7scBKUu2ZzJp0hsl1DJ0oXCQFhx45TR7IovHl2NHN7IMd6uKggVVaz', 'admin', '2022-09-20 00:17:34', '2022-09-20 00:17:34'),
(2, 'petugas', 'petugas@gmail.com', NULL, '$2y$10$tp4UR7Nk9xkYnQUMKlWh5OD7QfTcVdF0O8N0mRtlw6tdEXk1svFzq', NULL, 'petugas', '2022-10-05 21:29:34', '2022-10-05 21:29:34'),
(3, 'user', 'user@gmail.com', NULL, '$2y$10$o.3/efDRlmfY0DZ7Qs64fuk7tSYU/KDOzj9Y1UTeyeSX6.OE/Zh3u', NULL, 'user', '2022-10-05 21:30:54', '2022-10-05 21:30:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` bigint(20) NOT NULL,
  `nama_wilayah` varchar(255) NOT NULL,
  `pusat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `wilayah`
--

INSERT INTO `wilayah` (`id_wilayah`, `nama_wilayah`, `pusat`) VALUES
(1, 'Kabupaten Asahan', 'Kisaran'),
(2, 'Kabupaten Batu Bara', 'Limapuluh'),
(3, 'Kabupaten Dairi', 'Sidikalang'),
(4, 'Kabupaten Deli Serdang', 'Lubuk Pakam'),
(5, 'Kabupaten Humbang Hasundutan', 'Dolok Sanggul'),
(6, 'Kabupaten Karo', 'Kabanjahe'),
(7, 'Kabupaten Labuhanbatu', 'Rantau Prapat'),
(8, 'Kabupaten Labuhanbatu Selatan', 'Kota Pinang'),
(9, 'Kabupaten Labuhanbatu Utara', 'Aek Kanopan'),
(10, 'Kabupaten Langkat', 'Stabat'),
(11, 'Kabupaten Mandailing Natal', 'Panyabungan'),
(12, 'Kabupaten Nias', 'Gido'),
(13, 'Kabupaten Nias Barat', 'Lahomi'),
(14, 'Kabupaten Nias Selatan', 'Teluk Dalam'),
(15, 'Kabupaten Nias Utara', 'Lotu'),
(16, 'Kabupaten Padang Lawas', 'Sibuhuan'),
(17, 'Kabupaten Padang Lawas Utara', 'Gunung Tua'),
(18, 'Kabupaten Pakpak Bharat', 'Salak'),
(19, 'Kabupaten Samosir', 'Pangururan'),
(20, 'Kabupaten Serdang Bedagai', 'Sei Rampah'),
(21, 'Kabupaten Simalungun', 'Raya'),
(22, 'Kabupaten Tapanuli Selatan', 'Sipirok'),
(23, 'Kabupaten Tapanuli Tengah', 'Pandan'),
(24, 'Kabupaten Tapanuli Utara', 'Tarutung'),
(25, 'Kabupaten Toba', 'Balige'),
(26, 'Kota Binjai', '-'),
(27, 'Kota Gunungsitoli', '-'),
(28, 'Kota Medan', '-'),
(29, 'Kota Padang Sidempuan', '-'),
(30, 'Kota Pematangsiantar', '-'),
(31, 'Kota Sibolga', '-'),
(32, 'Kota Tanjungbalai', '-'),
(33, 'Kota Tebing Tinggi', '-');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dana_alokasi`
--
ALTER TABLE `dana_alokasi`
  ADD PRIMARY KEY (`id_alokasi`),
  ADD KEY `id_unit` (`id_unit`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `t_ba-pi`
--
ALTER TABLE `t_ba-pi`
  ADD PRIMARY KEY (`id_bapi`),
  ADD KEY `id_ba-pi_unit` (`id_bapi_unit`),
  ADD KEY `id_val_master` (`id_val_master`);

--
-- Indeks untuk tabel `t_master`
--
ALTER TABLE `t_master`
  ADD PRIMARY KEY (`id_master`),
  ADD KEY `id_unit_master` (`id_unit_master`);

--
-- Indeks untuk tabel `t_unit`
--
ALTER TABLE `t_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indeks untuk tabel `t_validasi`
--
ALTER TABLE `t_validasi`
  ADD PRIMARY KEY (`id_validasi`),
  ADD KEY `id_val_master` (`id_val_master`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dana_alokasi`
--
ALTER TABLE `dana_alokasi`
  MODIFY `id_alokasi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_ba-pi`
--
ALTER TABLE `t_ba-pi`
  MODIFY `id_bapi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `t_master`
--
ALTER TABLE `t_master`
  MODIFY `id_master` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `t_unit`
--
ALTER TABLE `t_unit`
  MODIFY `id_unit` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=833;

--
-- AUTO_INCREMENT untuk tabel `t_validasi`
--
ALTER TABLE `t_validasi`
  MODIFY `id_validasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dana_alokasi`
--
ALTER TABLE `dana_alokasi`
  ADD CONSTRAINT `dana_alokasi_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `t_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_ba-pi`
--
ALTER TABLE `t_ba-pi`
  ADD CONSTRAINT `t_ba-pi_ibfk_2` FOREIGN KEY (`id_val_master`) REFERENCES `t_master` (`id_master`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_ba-pi_ibfk_3` FOREIGN KEY (`id_bapi_unit`) REFERENCES `t_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_master`
--
ALTER TABLE `t_master`
  ADD CONSTRAINT `t_master_ibfk_1` FOREIGN KEY (`id_unit_master`) REFERENCES `t_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_validasi`
--
ALTER TABLE `t_validasi`
  ADD CONSTRAINT `t_validasi_ibfk_1` FOREIGN KEY (`id_val_master`) REFERENCES `t_master` (`id_master`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

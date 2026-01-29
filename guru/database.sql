-- Database: cms_guru

CREATE DATABASE IF NOT EXISTS `cms_guru`;
USE `cms_guru`;

-- Table structure for table `users`
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL, -- Stored as plain text based on login_proses.php
  PRIMARY KEY (`id`)
);

-- Dump data for table `users`
INSERT INTO `users` (`username`, `password`) VALUES
('admin', 'admin123');


-- Table structure for table `guru`
CREATE TABLE IF NOT EXISTS `guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Dump data for table `guru`
INSERT INTO `guru` (`nama`, `nip`, `mata_pelajaran`) VALUES
('Budi Santoso', '198001012010011001', 'Matematika'),
('Siti Aminah', '198502022010012002', 'Bahasa Indonesia');


-- Table structure for table `absensi_guru`
CREATE TABLE IF NOT EXISTS `absensi_guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guru_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('masuk','tidak') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `guru_id` (`guru_id`),
  CONSTRAINT `fk_guru_absen` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE
);

-- Database: kasus04
DROP DATABASE IF EXISTS kasus04;
CREATE DATABASE kasus04 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kasus04;

-- Table: KartuPesanan
DROP TABLE IF EXISTS KartuPesanan;
CREATE TABLE KartuPesanan (
  NomorPesanan INT PRIMARY KEY,
  JenisProduk VARCHAR(100),
  JmlPesanan INT,
  TglPesanan DATE,
  TglSelesai DATE,
  DipesanOleh VARCHAR(200)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table: RincianBiaya
DROP TABLE IF EXISTS RincianBiaya;
CREATE TABLE RincianBiaya (
  id INT AUTO_INCREMENT PRIMARY KEY,
  NomorPesanan INT,
  Tanggal DATE,
  Kelompok VARCHAR(100),
  SubKelompok VARCHAR(100),
  Jumlah BIGINT,
  FOREIGN KEY (NomorPesanan) REFERENCES KartuPesanan(NomorPesanan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data into KartuPesanan (from case)
INSERT INTO KartuPesanan (NomorPesanan, JenisProduk, JmlPesanan, TglPesanan, TglSelesai, DipesanOleh) VALUES
(1, 'Sepatu', 4000, '2004-01-01', '2004-01-30', 'PT Karya'),
(2, 'Sandal', 3000, '2004-02-02', '2004-02-28', 'PT Abdi'),
(3, 'Tas', 500, '2004-03-03', '2004-03-30', 'PT Maju');

-- Insert data into RincianBiaya (from case)
INSERT INTO RincianBiaya (NomorPesanan, Tanggal, Kelompok, SubKelompok, Jumlah) VALUES
(1, '2004-01-15', 'Material', 'Kulit', 10000000),
(1, '2004-01-15', 'Material', 'Kain', 5000000),
(1, '2004-01-15', 'Tenaga Kerja', 'Upah Buruh', 30000000),
(2, '2004-02-15', 'Material', 'Kulit', 20000000),
(2, '2004-02-15', 'Material', 'Kain', 10000000),
(2, '2004-02-15', 'Tenaga Kerja', 'Upah Buruh', 60000000),
(2, '2004-02-15', 'Tenaga Kerja', 'Upah Tenaga Ahli', 13000000),
(3, '2004-03-15', 'Material', 'Kulit', 15000000),
(3, '2004-03-15', 'Material', 'Kain', 14000000),
(3, '2004-03-15', 'Tenaga Kerja', 'Upah Buruh', 8000000);

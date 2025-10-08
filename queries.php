<?php
// queries.php - SQL queries for reports a..h
function get_query_for($key) {
    switch($key) {
        case 'a':
            $sql = "SELECT A.NomorPesanan, A.JenisProduk, A.JmlPesanan, B.Kelompok, SUM(B.Jumlah) AS JumlahBiaya
FROM KartuPesanan A
INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan
GROUP BY A.NomorPesanan, A.JenisProduk, A.JmlPesanan, B.Kelompok
ORDER BY A.NomorPesanan, A.JenisProduk, A.JmlPesanan, B.Kelompok";
            return ['sql'=>$sql, 'params'=>[]];
        case 'b':
            $sql = "SELECT DATE_FORMAT(B.Tanggal, '%Y-%m') AS Bulan, B.Kelompok, SUM(B.Jumlah) AS JumlahBiaya
FROM KartuPesanan A
INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan
GROUP BY DATE_FORMAT(B.Tanggal, '%Y-%m'), B.Kelompok
ORDER BY 1,2";
            return ['sql'=>$sql, 'params'=>[]];
        case 'c':
            $sql = "SELECT A.JenisProduk, B.Kelompok, SUM(B.Jumlah) AS JumlahBiaya
FROM KartuPesanan A
INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan
GROUP BY A.JenisProduk, B.Kelompok
ORDER BY 1,2";
            return ['sql'=>$sql, 'params'=>[]];
        case 'd':
            $sql = "SELECT A.NomorPesanan, A.JenisProduk, A.JmlPesanan,
SUM(B.Jumlah) AS BiayaLangsung,
SUM(B.Jumlah) * 30/100 AS BiayaOverHead,
SUM(B.Jumlah) * 130/100 AS TotalBiaya,
(SUM(B.Jumlah) * 130/100) / A.JmlPesanan AS BiayaPerUnit
FROM KartuPesanan A
INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan
GROUP BY A.NomorPesanan, A.JenisProduk, A.JmlPesanan
ORDER BY A.NomorPesanan";
            return ['sql'=>$sql, 'params'=>[]];
        case 'e':
            $sql = "SELECT B.SubKelompok, SUM(B.Jumlah) AS JumlahBiaya, COUNT(*) AS JmlTransaksi,
AVG(B.Jumlah) AS Rata_Rata, MAX(B.Jumlah) AS MaxBiaya, MIN(B.Jumlah) AS MinBiaya
FROM KartuPesanan A
INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan
GROUP BY B.SubKelompok
ORDER BY B.SubKelompok";
            return ['sql'=>$sql, 'params'=>[]];
        case 'f':
            $sql = "SELECT A.NomorPesanan, A.JenisProduk, A.JmlPesanan, B.Kelompok, B.SubKelompok, SUM(B.Jumlah) AS JumlahBiaya
FROM KartuPesanan A
INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan
WHERE A.JenisProduk = :produk
GROUP BY A.NomorPesanan, A.JenisProduk, A.JmlPesanan, B.Kelompok, B.SubKelompok
ORDER BY A.NomorPesanan";
            return ['sql'=>$sql, 'params'=>['produk'=>'Sepatu']];
        case 'g':
            $sql = "SELECT A.NomorPesanan, A.JenisProduk, A.JmlPesanan, B.Kelompok, SUM(B.Jumlah) AS JumlahBiaya
FROM KartuPesanan A
INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan
GROUP BY A.NomorPesanan, A.JenisProduk, A.JmlPesanan, B.Kelompok
HAVING SUM(B.Jumlah) > :threshold
ORDER BY A.NomorPesanan";
            return ['sql'=>$sql, 'params'=>['threshold'=>20000000]];
        case 'h':
            $sql = "SELECT A.NomorPesanan, A.JenisProduk, B.SubKelompok, SUM(B.Jumlah) AS JumlahBiaya
FROM KartuPesanan A
INNER JOIN RincianBiaya B ON A.NomorPesanan = B.NomorPesanan
GROUP BY A.NomorPesanan, A.JenisProduk, B.SubKelompok
ORDER BY SUM(B.Jumlah) DESC
LIMIT 3";
            return ['sql'=>$sql, 'params'=>[]];
        default:
            return null;
    }
}
?>
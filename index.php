<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/queries.php';
// small helper functions for titles and formatting
function get_report_title($k){
    $map = [
        'a'=>'1. Biaya Per Pesanan',
        'b'=>'2. Biaya Per Bulan',
        'c'=>'3. Biaya Per Produk',
        'd'=>'4. Penghitungan Biaya Per Pesanan',
        'e'=>'5. Statistik Biaya Per Sub Kelompok',
        'f'=>'6. Biaya Produk Sepatu (Filter)',
        'g'=>'7. Biaya Besar (> 20.000.000)',
        'h'=>'8. Top 3 Penggunaan Biaya Tertinggi'
    ];
    return $map[$k] ?? 'Laporan';
}
function get_report_subtitle($k){
    $map = [
        'a'=>'Laporan Biaya Langsung Per Pesanan',
        'b'=>'Laporan Biaya Langsung Per Bulan',
        'c'=>'Laporan Biaya Langsung Per Produk',
        'd'=>'Penghitungan Biaya Produk Per Pesanan',
        'e'=>'Laporan Total Biaya, Rata-rata, Jumlah Tertinggi, Jumlah Terkecil, serta
Jumlah Pesanan',
        'f'=>'Laporan Biaya Langsung Per Pesanan Yang Diperinci Sampai Kelompok
Biaya untuk Jenis Produk Sepatu saja',
        'g'=>'Laporan Biaya Langsung Per Pesanan Yang Diperinci Sampai
Kelompok Biaya untuk Jumlah Biaya Yang lebih besar dari 20.000.000,',
        'h'=>'Daftar Top 3 Penggunaan Kelompok Biaya Terbesar'
    ];
    return $map[$k] ?? '';
}
function format_number_if_money($key, $v){
    // Jangan kasih "Rp" untuk kolom NomorPesanan atau JmlPesanan
    if (is_numeric($v) && !in_array(strtolower($key), ['nomorpesanan','jmlpesanan'])) {
        return 'Rp ' . number_format($v, 0, ',', '.');
    }
    return $v;
}
$db = pdo_connect();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manajemen Biaya Produksi - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>

<main class="container">
  <?php include __DIR__ . '/includes/cards-summary.php'; ?>

  <?php include __DIR__ . '/includes/report-sections.php'; ?>

  <?php include __DIR__ . '/includes/footer.php'; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

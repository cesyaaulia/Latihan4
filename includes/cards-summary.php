<?php
// summary cards: expects $db PDO
$totals = $db->query("SELECT COUNT(DISTINCT NomorPesanan) AS total_pesanan, SUM(Jumlah) AS total_biaya FROM RincianBiaya")->fetch();
$total_orders = $totals['total_pesanan'] ?? 0;
$total_cost = $totals['total_biaya'] ?? 0;
$avg_cost_order = $total_orders ? round($total_cost / $total_orders) : 0;
?>
<div class="row g-3 mb-3">
  <div class="col-md-4">
    <div class="card card-custom summary-card p-3">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="text-muted small">Total Pesanan</div>
          <div class="summary-value"><?= htmlspecialchars($total_orders) ?></div>
        </div>
        <div class="text-end text-muted small">Orders</div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-custom p-3" style="background: linear-gradient(90deg,#d8f0e8,#cdeff7)">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="text-muted small">Total Biaya</div>
          <div class="summary-value">Rp <?= number_format($total_cost,0,',','.') ?></div>
        </div>
        <div class="text-end text-muted small">IDR</div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-custom p-3" style="background: linear-gradient(90deg,#ffeef6,#fff1f8)">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="text-muted small">Rata-rata Biaya per Pesanan</div>
          <div class="summary-value">Rp <?= number_format($avg_cost_order,0,',','.') ?></div>
        </div>
        <div class="text-end text-muted small">Avg</div>
      </div>
    </div>
  </div>
</div>

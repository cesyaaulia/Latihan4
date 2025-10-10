<?php
// includes/report-sections.php
require_once __DIR__ . '/../queries.php';
$keys = ['a','b','c','d','e','f','g','h'];
?>
<div class="row g-4">
<?php foreach($keys as $k): 
    $qinfo = get_query_for($k);
    try {
        $stmt = $db->prepare($qinfo['sql']);
        if (!empty($qinfo['params'])) {
            foreach($qinfo['params'] as $name=>$val){
                $paramType = is_int($val) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $stmt->bindValue(':' . $name, $val, $paramType);
            }
        }
        $stmt->execute();
        $rows = $stmt->fetchAll();
    } catch (Exception $ex){
        $rows = [];
    }
?>
  <div class="col-12 col-md-6 col-lg-4"></div>
    <div class="card card-custom p-3">
      <h6 class="section-title mb-2"><?= htmlspecialchars(get_report_title($k)) ?></h6>
      <p class="text-muted small mb-3"><?= htmlspecialchars(get_report_subtitle($k)) ?></p>
      <div class="table-responsive">
        <table class="table table-striped">
            <thead>
          <tr>
            <?php if(count($rows)>0): foreach(array_keys($rows[0]) as $col): ?>
              <th><?= htmlspecialchars($col) ?></th>
            <?php endforeach; ?>
              <th>Aksi</th> <!-- Tambah header baru -->
            <?php else: ?>
              <th>No Data</th>
            <?php endif; ?>
              </tr>
            </thead>
          <tbody>
            <?php if(count($rows)>0): foreach($rows as $r): ?>
              <tr>
                <?php foreach($r as $col => $cell): ?>
             <td><?= htmlspecialchars(format_number_if_money($col, $cell)) ?></td>
                <?php endforeach; ?>
            <td class="text-center">
              <a href="detail.php?id=<?= $r['NomorPesanan'] ?? '' ?>" class="btn btn-success btn-sm">Detail</a>
              <a href="edit.php?id=<?= $r['NomorPesanan'] ?? '' ?>" class="btn btn-warning btn-sm text-dark">Edit</a>
              <a href="delete.php?id=<?= $r['NomorPesanan'] ?? '' ?>" class="btn btn-danger btn-sm" 
             onclick="return confirm('Yakin ingin menghapus data ini?');">Delete</a>
            </td>
            <?php endforeach; else: ?>
                <tr><td class="text-muted small">No results</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../../includes/header.php'; require_admin(); ?>
<div class="row">
  <div class="col-md-3">
    <div class="list-group">
      <a href="/admin/dashboard.php" class="list-group-item list-group-item-action active">Dashboard</a>
      <a href="/admin/users.php" class="list-group-item list-group-item-action">Manage Users</a>
      <a href="/admin/topics.php" class="list-group-item list-group-item-action">Topics</a>
      <a href="/admin/exams.php" class="list-group-item list-group-item-action">Exams</a>
      <a href="/admin/questions.php" class="list-group-item list-group-item-action">Questions</a>
      <a href="/admin/analytics.php" class="list-group-item list-group-item-action">Analytics</a>
    </div>
  </div>
  <div class="col-md-9">
    <h3>Admin Dashboard</h3>
    <p>Quick stats:</p>
    <div class="row">
      <?php
      $c1 = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
      $c2 = $pdo->query('SELECT COUNT(*) FROM exams')->fetchColumn();
      $c3 = $pdo->query('SELECT COUNT(*) FROM attempts')->fetchColumn();
      ?>
      <div class="col-md-4"><div class="card p-3">Users <h4><?php echo $c1; ?></h4></div></div>
      <div class="col-md-4"><div class="card p-3">Exams <h4><?php echo $c2; ?></h4></div></div>
      <div class="col-md-4"><div class="card p-3">Attempts <h4><?php echo $c3; ?></h4></div></div>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
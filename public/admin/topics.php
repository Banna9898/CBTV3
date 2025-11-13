<?php require_once __DIR__ . '/../../includes/header.php'; require_admin(); if($_SERVER['REQUEST_METHOD']==='POST'){ $name=trim($_POST['name']); $desc=trim($_POST['description']); if(!empty($name)){ $pdo->prepare('INSERT INTO topics (name,description) VALUES (?,?)')->execute([$name,$desc]); header('Location: /admin/topics.php'); exit; } } if(isset($_GET['delete'])){ $pdo->prepare('DELETE FROM topics WHERE id=?')->execute([intval($_GET['delete'])]); header('Location: /admin/topics.php'); exit; } $rows=$pdo->query('SELECT * FROM topics ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC); ?>
<h3>Topics</h3>
<table class="table"><thead><tr><th>Name</th><th>Description</th><th>Actions</th></tr></thead><tbody>
<?php foreach($rows as $r): ?>
<tr><td><?php echo e($r['name']); ?></td><td><?php echo e($r['description']); ?></td><td><a class="btn btn-sm btn-danger" href="?delete=<?php echo $r['id']; ?>" onclick="return confirm('Delete?')">Delete</a></td></tr>
<?php endforeach; ?>
</tbody></table>
<form method="post" class="mt-3"><div class="form-group"><input name="name" class="form-control" placeholder="Topic name" required></div><div class="form-group"><textarea name="description" class="form-control" placeholder="Description"></textarea></div><button class="btn btn-primary">Create Topic</button></form>
<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
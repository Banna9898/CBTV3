<?php require_once __DIR__ . '/../includes/header.php'; if($_SERVER['REQUEST_METHOD']==='POST'){ $email = trim($_POST['email']); $password = $_POST['password']; $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?'); $stmt->execute([$email]); $u = $stmt->fetch(PDO::FETCH_ASSOC); if(!$u){ $err='Invalid credentials'; } else if(!password_verify($password, $u['password'])){ $err='Invalid credentials'; } else if($u['status'] !== 'active'){ if($u['status']==='pending') $err='Your account is pending admin approval.'; else $err='Your account is disabled.'; } else { unset($u['password']); $_SESSION['user']=$u; header('Location: /user/dashboard.php'); exit; } } ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card p-4">
      <h4>Login</h4>
      <?php if(!empty($err)): ?><div class="alert alert-warning"><?php echo e($err); ?></div><?php endif; ?>
      <form method="post">
        <div class="form-group"><label>Email</label><input name="email" type="email" class="form-control" required></div>
        <div class="form-group"><label>Password</label><input name="password" type="password" class="form-control" required></div>
        <button class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>

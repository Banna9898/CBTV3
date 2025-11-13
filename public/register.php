<?php require_once __DIR__ . '/../includes/header.php'; if($_SERVER['REQUEST_METHOD']==='POST'){ $name=trim($_POST['name']); $email=trim($_POST['email']); $phone = trim($_POST['phone']); $password=$_POST['password']; if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ $err='Invalid email'; } else { $stmt=$pdo->prepare('SELECT id FROM users WHERE email=?'); $stmt->execute([$email]); if($stmt->fetch()) $err='Email already registered'; } if(empty($err)){ $hash=password_hash($password, PASSWORD_DEFAULT); $stmt=$pdo->prepare('INSERT INTO users (name,email,phone,password,role,status) VALUES (?,?,?,?,?,?) RETURNING id'); $stmt->execute([$name,$email,$phone,$hash,'user','pending']); $msg='Registered successfully. Await admin approval.'; } } ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card p-4">
      <h4>Register</h4>
      <?php if(!empty($err)): ?><div class="alert alert-danger"><?php echo e($err); ?></div><?php endif; ?>
      <?php if(!empty($msg)): ?><div class="alert alert-success"><?php echo e($msg); ?></div><?php endif; ?>
      <form method="post">
        <div class="form-group"><label>Name</label><input name="name" type="text" class="form-control" required></div>
        <div class="form-group"><label>Email</label><input name="email" type="email" class="form-control" required></div>
        <div class="form-group"><label>Phone</label><input name="phone" type="text" class="form-control" required></div>
        <div class="form-group"><label>Password</label><input name="password" type="password" class="form-control" required></div>
        <button class="btn btn-primary">Register</button>
      </form>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
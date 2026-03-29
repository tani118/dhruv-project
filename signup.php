<?php
require_once 'includes/auth.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $error = register_user($name, $email, $password);
    if ($error === '') {
        header('Location: login.php');
        exit;
    }
    $message = $error;
}
?>
<html>
<head>
<title>Sign Up</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="form">
<h2>Create Account</h2>
<?php if ($message): ?>
<p class="error"><?php echo $message; ?></p>
<?php endif; ?>
<form method="post">
<label>Name</label><br>
<input type="text" name="name" required><br>
<label>Email</label><br>
<input type="email" name="email" required><br>
<label>Password</label><br>
<input type="password" name="password" required><br>
<button type="submit">Sign Up</button>
</form>
<p>Already have account? <a href="login.php">Login</a></p>
</div>
</body>
</html>

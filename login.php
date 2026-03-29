<?php
require_once 'includes/auth.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $error = login_user($email, $password);
    if ($error === '') {
        header('Location: index.php');
        exit;
    }
    $message = $error;
}
?>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form">
<h2>Login</h2>
<?php if ($message): ?>
<p class="error"><?php echo $message; ?></p>
<?php endif; ?>
<form method="post">
<label>Email</label><br>
<input type="email" name="email" required><br>
<label>Password</label><br>
<input type="password" name="password" required><br>
<button type="submit">Login</button>
</form>
<p>No account? <a href="signup.php">Sign Up</a></p>
</div>
</body>
</html>

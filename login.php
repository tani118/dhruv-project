<?php
session_start();

$usersFile = 'users.json';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $users = json_decode(file_get_contents($usersFile), true);
    
    $found = false;
    foreach ($users as $u) {
        if (strtolower($u['email']) === strtolower($email) && $u['password'] === $password) {
            $_SESSION['user'] = ['name' => $u['name'], 'email' => $u['email']];
            header('Location: index.php');
            exit;
        }
    }
    
    $message = 'Invalid email or password';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: white;
            color: black;
        }
        .container {
            width: 400px;
            margin: 50px auto;
            border: 1px solid black;
            padding: 20px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid black;
        }
        button {
            padding: 10px 20px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
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

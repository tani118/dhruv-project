<?php
session_start();

$usersFile = 'users.json';

if (!file_exists($usersFile)) {
    file_put_contents($usersFile, '[]');
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $users = json_decode(file_get_contents($usersFile), true);
    
    $exists = false;
    foreach ($users as $u) {
        if (strtolower($u['email']) === strtolower($email)) {
            $exists = true;
            break;
        }
    }
    
    if ($exists) {
        $message = 'Email already registered';
    } else {
        $users[] = ['name' => $name, 'email' => $email, 'password' => $password];
        file_put_contents($usersFile, json_encode($users));
        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
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

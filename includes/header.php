<?php
$user = current_user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle ?? 'Apple Market'); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <div class="container nav-wrap">
        <h1 class="logo">
            <a href="index.php">
                <img src="assets/images/apple-logo.svg" alt="Apple logo" class="apple-logo">
                <span>Apple Market</span>
            </a>
        </h1>
        <button id="menuBtn" class="menu-btn" type="button">Menu</button>
        <nav id="mainNav">
            <?php if ($user): ?>
                <a href="index.php">Home</a>
                <a href="products.php">Products</a>
                <span class="welcome">Hi, <?php echo htmlspecialchars($user['name']); ?></span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="signup.php">Sign Up</a>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">

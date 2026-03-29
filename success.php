<?php
require_once 'includes/auth.php';

$user = current_user();
if (!$user) {
    header('Location: login.php');
    exit;
}
?>
<html>
<head>
<title>Order Success</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
<div class="container">
<img src="assets/images/apple-logo.svg" width="20" style="vertical-align: middle;">
<a href="index.php">Apple Market</a>
<a href="index.php">Home</a>
<a href="products.php">Products</a>
<a href="cart.php">Cart (0)</a>
<span>Hi, <?php echo $user['name']; ?></span>
<a href="logout.php">Logout</a>
</div>
</header>
<div class="container">
<div class="success-message">
<h1>Order Placed Successfully!</h1>
<p>Thank you for your purchase.</p>
<p>Your order will be delivered soon.</p>
<a href="products.php"><button>Continue Shopping</button></a>
</div>
</div>
</body>
</html>

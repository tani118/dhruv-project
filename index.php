<?php
require_once 'includes/auth.php';
require_once 'includes/data.php';

$user = current_user();
if (!$user) {
    header('Location: login.php');
    exit;
}

$products = get_products();
?>
<html>
<head>
<title>Apple Market</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
<div class="container">
<img src="assets/images/apple-logo.svg" width="20" style="vertical-align: middle;">
<a href="index.php">Apple Market</a>
<a href="index.php">Home</a>
<a href="products.php">Products</a>
<a href="cart.php">Cart</a>
<span>Hi, <?php echo $user['name']; ?></span>
<a href="logout.php">Logout</a>
</div>
</header>
<div class="container">
<h1>Welcome to Apple Market</h1>
<p>Buy iPhone, iPad, MacBook, and AirPods</p>
<div class="grid">
<?php foreach ($products as $product): ?>
<div class="card">
<img src="<?php echo $product['image']; ?>">
<h3><?php echo $product['name']; ?></h3>
<p>₹<?php echo $product['base_price']; ?></p>
<a href="product.php?id=<?php echo $product['id']; ?>">View</a>
</div>
<?php endforeach; ?>
</div>
</div>
</body>
</html>

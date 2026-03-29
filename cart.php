<?php
require_once 'includes/auth.php';

$user = current_user();
if (!$user) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header('Location: cart.php');
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'];
}
?>
<html>
<head>
<title>Cart</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
<div class="container">
<img src="assets/images/apple-logo.svg" width="20" style="vertical-align: middle;">
<a href="index.php">Apple Market</a>
<a href="index.php">Home</a>
<a href="products.php">Products</a>
<a href="cart.php">Cart (<?php echo count($_SESSION['cart']); ?>)</a>
<span>Hi, <?php echo $user['name']; ?></span>
<a href="logout.php">Logout</a>
</div>
</header>
<div class="container">
<h1>Shopping Cart</h1>

<?php if (empty($_SESSION['cart'])): ?>
    <p>Your cart is empty</p>
    <a href="products.php">Continue Shopping</a>
<?php else: ?>
    <div class="cart-items">
        <?php foreach ($_SESSION['cart'] as $index => $item): ?>
            <div class="cart-item">
                <img src="<?php echo $item['image']; ?>" width="100">
                <div class="cart-details">
                    <h3><?php echo $item['name']; ?></h3>
                    <p><b>Color:</b> <?php echo $item['color']; ?></p>
                    <p><b>Storage:</b> <?php echo $item['storage']; ?></p>
                    <p><b>RAM:</b> <?php echo $item['ram']; ?></p>
                    <p><b>Warranty:</b> <?php echo $item['warranty']; ?></p>
                    <p><b>Price:</b> ₹<?php echo $item['price']; ?></p>
                </div>
                <div>
                    <a href="cart.php?remove=<?php echo $index; ?>">Remove</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="cart-total">
        <h2>Total: ₹<?php echo $total; ?></h2>
        <a href="checkout.php"><button>Buy Now</button></a>
        <a href="products.php">Continue Shopping</a>
    </div>
<?php endif; ?>
</div>
</body>
</html>

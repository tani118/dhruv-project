<?php
require_once 'includes/auth.php';

$user = current_user();
if (!$user) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['cart'] = [];
    header('Location: success.php');
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'];
}
?>
<html>
<head>
<title>Checkout</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<div class="container">
<img src="apple-logo.svg" width="20" style="vertical-align: middle;">
<a href="index.php">Apple Market</a>
<a href="index.php">Home</a>
<a href="products.php">Products</a>
<a href="cart.php">Cart (<?php echo count($_SESSION['cart']); ?>)</a>
<span>Hi, <?php echo $user['name']; ?></span>
<a href="logout.php">Logout</a>
</div>
</header>
<div class="container">
<h1>Checkout</h1>

<div class="checkout">
    <h2>Order Summary</h2>
    <?php foreach ($_SESSION['cart'] as $item): ?>
        <div class="order-item">
            <p><b><?php echo $item['name']; ?></b> - <?php echo $item['color']; ?>, <?php echo $item['storage']; ?></p>
            <p>₹<?php echo $item['price']; ?></p>
        </div>
    <?php endforeach; ?>
    
    <div class="order-total">
        <h2>Total: ₹<?php echo $total; ?></h2>
    </div>
    
    <form method="post">
        <h3>Delivery Information</h3>
        <label>Full Name</label><br>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>
        
        <label>Address</label><br>
        <input type="text" name="address" required><br>
        
        <label>Phone Number</label><br>
        <input type="text" name="phone" required><br>
        
        <label>Payment Method</label><br>
        <select name="payment">
            <option>Cash on Delivery</option>
            <option>Credit Card</option>
            <option>Debit Card</option>
            <option>UPI</option>
        </select><br><br>
        
        <button type="submit">Place Order</button>
    </form>
</div>
</div>
</body>
</html>

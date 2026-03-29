<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/data.php';

$user = current_user();
if (!$user) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Home';
$products = get_products();
include __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <h2>Welcome to Apple Market</h2>
    <p>Buy iPhone, iPad, MacBook, and AirPods with simple options.</p>
    <a class="btn" href="products.php">Shop Now</a>
</section>

<section>
    <h3>Featured Products</h3>
    <div class="grid">
        <?php foreach ($products as $product): ?>
            <div class="card">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                <p>From ₹<?php echo htmlspecialchars($product['base_price']); ?></p>
                <a class="btn-small" href="product.php?id=<?php echo urlencode($product['id']); ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

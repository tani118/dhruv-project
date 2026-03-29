<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/data.php';

$user = current_user();
if (!$user) {
    header('Location: login.php');
    exit;
}

$pageTitle = 'Products';
$products = get_products();
include __DIR__ . '/includes/header.php';
?>
<section>
    <h2>All Products</h2>
    <div class="grid">
        <?php foreach ($products as $product): ?>
            <div class="card">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p><strong>Starting Price:</strong> ₹<?php echo htmlspecialchars($product['base_price']); ?></p>
                <a class="btn-small" href="product.php?id=<?php echo urlencode($product['id']); ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

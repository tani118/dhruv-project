<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/data.php';

$user = current_user();
if (!$user) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? '';
$product = get_product($id);
$pageTitle = $product ? $product['name'] : 'Product Not Found';
include __DIR__ . '/includes/header.php';
?>
<?php if (!$product): ?>
    <section>
        <h2>Product not found</h2>
        <p>Please go back to products page.</p>
        <a class="btn" href="products.php">Go to Products</a>
    </section>
<?php else: ?>
    <section class="product-detail">
        <div>
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="detail-img">
        </div>
        <div>
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <p><?php echo htmlspecialchars($product['description']); ?></p>

            <label for="colorSelect">Color:</label>
            <select id="colorSelect">
                <?php foreach ($product['colors'] as $color): ?>
                    <option value="<?php echo htmlspecialchars($color); ?>"><?php echo htmlspecialchars($color); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="storageSelect">Storage:</label>
            <select id="storageSelect">
                <?php foreach ($product['storage_options'] as $index => $option): ?>
                    <option value="<?php echo $index; ?>"><?php echo htmlspecialchars($option['storage']); ?> (<?php echo htmlspecialchars($option['ram']); ?> RAM)</option>
                <?php endforeach; ?>
            </select>

            <div class="selection-box">
                <p><strong>Selected Color:</strong> <span id="selectedColor"><?php echo htmlspecialchars($product['colors'][0]); ?></span></p>
                <p><strong>Selected Storage:</strong> <span id="selectedStorage"><?php echo htmlspecialchars($product['storage_options'][0]['storage']); ?></span></p>
                <p><strong>Selected RAM:</strong> <span id="selectedRam"><?php echo htmlspecialchars($product['storage_options'][0]['ram']); ?></span></p>
                <p><strong>Price:</strong> ₹<span id="selectedPrice"><?php echo htmlspecialchars($product['storage_options'][0]['price']); ?></span></p>
            </div>
        </div>
    </section>
    <script>
        window.productData = <?php echo json_encode($product['storage_options']); ?>;
    </script>
<?php endif; ?>
<?php include __DIR__ . '/includes/footer.php'; ?>

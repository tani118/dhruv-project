<?php
require_once 'includes/auth.php';
require_once 'includes/data.php';

$user = current_user();
if (!$user) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$product = get_product($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    $item = [
        'product_id' => $id,
        'name' => $product['name'],
        'image' => $product['image'],
        'color' => $_POST['color'],
        'storage' => $product['storage_options'][$_POST['storage_index']]['storage'],
        'ram' => $product['storage_options'][$_POST['storage_index']]['ram'],
        'warranty' => $product['warranty'][$_POST['warranty_index']],
        'price' => $product['storage_options'][$_POST['storage_index']]['price'] + $product['warranty_prices'][$_POST['warranty_index']]
    ];
    
    $_SESSION['cart'][] = $item;
    header('Location: cart.php');
    exit;
}
?>
<html>
<head>
<title><?php echo $product['name']; ?></title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
<div class="container">
<img src="assets/images/apple-logo.svg" width="20" style="vertical-align: middle;">
<a href="index.php">Apple Market</a>
<a href="index.php">Home</a>
<a href="products.php">Products</a>
<a href="cart.php">Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
<span>Hi, <?php echo $user['name']; ?></span>
<a href="logout.php">Logout</a>
</div>
</header>
<div class="container">
<form method="post">
<div class="product">
<div>
<img src="<?php echo $product['image']; ?>" class="product-img">
</div>
<div>
<h1><?php echo $product['name']; ?></h1>
<p><?php echo $product['description']; ?></p>
<label>Color:</label><br>
<select name="color" id="colorSelect">
<?php foreach ($product['colors'] as $color): ?>
<option><?php echo $color; ?></option>
<?php endforeach; ?>
</select><br>
<label>Storage:</label><br>
<select name="storage_index" id="storageSelect">
<?php foreach ($product['storage_options'] as $i => $opt): ?>
<option value="<?php echo $i; ?>"><?php echo $opt['storage']; ?> (<?php echo $opt['ram']; ?> RAM)</option>
<?php endforeach; ?>
</select><br>
<label>Warranty:</label><br>
<select name="warranty_index" id="warrantySelect">
<?php foreach ($product['warranty'] as $i => $w): ?>
<option value="<?php echo $i; ?>"><?php echo $w; ?> <?php echo $product['warranty_prices'][$i] > 0 ? '(+₹' . $product['warranty_prices'][$i] . ')' : ''; ?></option>
<?php endforeach; ?>
</select>
<div class="info">
<p><b>Color:</b> <span id="selectedColor"><?php echo $product['colors'][0]; ?></span></p>
<p><b>Storage:</b> <span id="selectedStorage"><?php echo $product['storage_options'][0]['storage']; ?></span></p>
<p><b>RAM:</b> <span id="selectedRam"><?php echo $product['storage_options'][0]['ram']; ?></span></p>
<p><b>Warranty:</b> <span id="selectedWarranty"><?php echo $product['warranty'][0]; ?></span></p>
<p><b>Total Price:</b> ₹<span id="selectedPrice"><?php echo $product['storage_options'][0]['price']; ?></span></p>
</div>
<button type="submit">Add to Cart</button>
</div>
</div>
</form>
</div>
<script>
var productData = <?php echo json_encode($product['storage_options']); ?>;
var warrantyData = <?php echo json_encode($product['warranty']); ?>;
var warrantyPrices = <?php echo json_encode($product['warranty_prices']); ?>;

var currentStoragePrice = productData[0].price;
var currentWarrantyPrice = 0;

document.getElementById('colorSelect').addEventListener('change', function() {
    document.getElementById('selectedColor').textContent = this.value;
});

document.getElementById('storageSelect').addEventListener('change', function() {
    var opt = productData[this.value];
    document.getElementById('selectedStorage').textContent = opt.storage;
    document.getElementById('selectedRam').textContent = opt.ram;
    currentStoragePrice = opt.price;
    document.getElementById('selectedPrice').textContent = currentStoragePrice + currentWarrantyPrice;
});

document.getElementById('warrantySelect').addEventListener('change', function() {
    var index = this.value;
    document.getElementById('selectedWarranty').textContent = warrantyData[index];
    currentWarrantyPrice = warrantyPrices[index];
    document.getElementById('selectedPrice').textContent = currentStoragePrice + currentWarrantyPrice;
});
</script>
</body>
</html>

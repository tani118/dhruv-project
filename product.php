<?php
session_start();

$products = [
    'iphone' => ['name' => 'iPhone 15', 'colors' => ['Black', 'Blue', 'Pink'], 'storage' => ['128GB', '256GB', '512GB'], 'prices' => [79900, 89900, 109900], 'image' => 'iphone.jpg'],
    'ipad' => ['name' => 'iPad Air', 'colors' => ['Gray', 'Blue'], 'storage' => ['64GB', '256GB'], 'prices' => [59900, 74900], 'image' => 'ipad.jpg'],
    'macbook' => ['name' => 'MacBook Air', 'colors' => ['Silver', 'Midnight'], 'storage' => ['256GB', '512GB'], 'prices' => [109900, 129900], 'image' => 'macbook.jpg'],
    'airpods' => ['name' => 'AirPods Pro', 'colors' => ['White'], 'storage' => ['Standard'], 'prices' => [24900], 'image' => 'airpods.jpg']
];

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if (!$user) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$product = $products[$id];
?>
<html>
<head>
<title><?php echo $product['name']; ?></title>
<style>
body { margin: 0; font-family: Arial; background: white; color: black; }
header { background: black; color: white; padding: 10px; }
header a { color: white; text-decoration: none; margin-right: 15px; }
.container { width: 90%; margin: 0 auto; padding: 20px; }
.product { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.product img { width: 100%; height: 300px; object-fit: contain; }
select { padding: 5px; margin: 10px 0; border: 1px solid black; }
.info { border: 1px solid black; padding: 10px; margin-top: 20px; }
</style>
</head>
<body>
<header>
<div class="container">
<a href="index.php">Home</a>
<a href="products.php">Products</a>
<span>Hi, <?php echo $user['name']; ?></span>
<a href="logout.php">Logout</a>
</div>
</header>
<div class="container">
<div class="product">
<div>
<img src="<?php echo $product['image']; ?>">
</div>
<div>
<h1><?php echo $product['name']; ?></h1>
<label>Color:</label><br>
<select id="colorSelect">
<?php foreach ($product['colors'] as $color): ?>
<option><?php echo $color; ?></option>
<?php endforeach; ?>
</select><br>
<label>Storage:</label><br>
<select id="storageSelect">
<?php foreach ($product['storage'] as $i => $storage): ?>
<option value="<?php echo $i; ?>"><?php echo $storage; ?></option>
<?php endforeach; ?>
</select>
<div class="info">
<p><b>Color:</b> <span id="selectedColor"><?php echo $product['colors'][0]; ?></span></p>
<p><b>Storage:</b> <span id="selectedStorage"><?php echo $product['storage'][0]; ?></span></p>
<p><b>Price:</b> ₹<span id="selectedPrice"><?php echo $product['prices'][0]; ?></span></p>
</div>
</div>
</div>
</div>
<script>
var prices = <?php echo json_encode($product['prices']); ?>;
var storage = <?php echo json_encode($product['storage']); ?>;

document.getElementById('colorSelect').addEventListener('change', function() {
    document.getElementById('selectedColor').textContent = this.value;
});

document.getElementById('storageSelect').addEventListener('change', function() {
    var index = this.value;
    document.getElementById('selectedStorage').textContent = storage[index];
    document.getElementById('selectedPrice').textContent = prices[index];
});
</script>
</body>
</html>

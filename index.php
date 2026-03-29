<?php
session_start();

$usersFile = 'users.json';

if (!file_exists($usersFile)) {
    file_put_contents($usersFile, '[]');
}

$products = [
    'iphone' => [
        'id' => 'iphone',
        'name' => 'iPhone 15',
        'price' => 79900,
        'colors' => ['Black', 'Blue', 'Pink', 'Yellow'],
        'storage' => ['128GB', '256GB', '512GB'],
        'storage_prices' => [79900, 89900, 109900],
        'image' => 'iphone.jpg'
    ],
    'ipad' => [
        'id' => 'ipad',
        'name' => 'iPad Air',
        'price' => 59900,
        'colors' => ['Space Gray', 'Blue', 'Starlight'],
        'storage' => ['64GB', '256GB'],
        'storage_prices' => [59900, 74900],
        'image' => 'ipad.jpg'
    ],
    'macbook' => [
        'id' => 'macbook',
        'name' => 'MacBook Air M3',
        'price' => 109900,
        'colors' => ['Midnight', 'Silver', 'Starlight'],
        'storage' => ['256GB', '512GB'],
        'storage_prices' => [109900, 129900],
        'image' => 'macbook.jpg'
    ],
    'airpods' => [
        'id' => 'airpods',
        'name' => 'AirPods Pro',
        'price' => 24900,
        'colors' => ['White'],
        'storage' => ['Standard'],
        'storage_prices' => [24900],
        'image' => 'airpods.jpg'
    ]
];

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (!$user) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Apple Market</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: white;
            color: black;
        }
        header {
            background: black;
            color: white;
            padding: 10px;
        }
        header a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px 0;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .card {
            border: 1px solid black;
            padding: 10px;
        }
        .card img {
            width: 100%;
            height: 150px;
            object-fit: contain;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <span>Hi, <?php echo htmlspecialchars($user['name']); ?></span>
        <a href="logout.php">Logout</a>
    </div>
</header>
<div class="container">
    <h1>Welcome to Apple Market</h1>
    <p>Buy iPhone, iPad, MacBook, and AirPods</p>
    <div class="grid">
        <?php foreach ($products as $product): ?>
            <div class="card">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <h3><?php echo $product['name']; ?></h3>
                <p>₹<?php echo $product['price']; ?></p>
                <a href="product.php?id=<?php echo $product['id']; ?>">View</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>

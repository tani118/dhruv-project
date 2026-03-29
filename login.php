<?php
require_once __DIR__ . '/includes/auth.php';

$pageTitle = 'Login';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $message = 'Please fill all fields.';
    } else {
        $error = login_user($email, $password);
        if ($error === '') {
            header('Location: index.php');
            exit;
        }
        $message = $error;
    }
}

include __DIR__ . '/includes/header.php';
?>
<section class="form-section">
    <h2>Login</h2>
    <?php if (isset($_GET['registered'])): ?>
        <p class="success">Signup successful. Please login.</p>
    <?php endif; ?>
    <?php if ($message): ?>
        <p class="error"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <button type="submit" class="btn">Login</button>
    </form>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

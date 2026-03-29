<?php
require_once __DIR__ . '/includes/auth.php';

$pageTitle = 'Sign Up';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || $email === '' || $password === '') {
        $message = 'Please fill all fields.';
    } else {
        $error = register_user($name, $email, $password);
        if ($error === '') {
            $usersCheck = file_get_contents(__DIR__ . '/data/users.json');
            error_log("Users after signup: " . $usersCheck);
            header('Location: login.php?registered=1');
            exit;
        }
        $message = $error;
    }
}

include __DIR__ . '/includes/header.php';
?>
<section class="form-section">
    <h2>Create Account</h2>
    <?php if ($message): ?>
        <p class="error"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" required>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" required>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <button type="submit" class="btn">Sign Up</button>
    </form>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

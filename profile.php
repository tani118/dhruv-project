<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = 'Profile';
$user = current_user();
include __DIR__ . '/includes/header.php';
?>
<section>
    <h2>Profile Page</h2>
    <?php if ($user): ?>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p>You are currently logged in.</p>
    <?php else: ?>
        <p>This profile page is public for this project.</p>
        <p>You are visiting as a guest.</p>
        <a class="btn-small" href="login.php">Login</a>
        <a class="btn-small" href="signup.php">Sign Up</a>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

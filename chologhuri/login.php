<?php
require 'includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = 'Login | CholoGhuri';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare('SELECT id, name, password FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: packages.php');
        exit;
    }
    
    $error = 'Invalid email or password.';
}

require 'includes/header.php';
?>

<section class="auth">
    <div class="auth-box">
        <h1>Welcome Back 👋</h1>
        <p class="center">Login to manage your trips.</p>
        
        <?php if (isset($_GET['registered'])): ?>
            <div class="alert success">Account created successfully. Please login.</div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" class="form-control" type="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password" required>
            </div>
            
            <button class="btn" type="submit" style="border: 0; width: 100%; font: inherit;">Login</button>
        </form>
        
        <p class="center">
            New here? <a style="color: var(--orange);" href="register.php">Create an account</a>
        </p>
    </div>
</section>

<?php require 'includes/footer.php'; ?>

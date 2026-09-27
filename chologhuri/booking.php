<?php
require 'includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$packageId = (int)($_GET['package_id'] ?? $_POST['package_id'] ?? 0);
$error = '';
$package = null;

$stmt = $conn->prepare('SELECT * FROM tour_packages WHERE id = ? AND status = "active"');
$stmt->bind_param('i', $packageId);
$stmt->execute();
$package = $stmt->get_result()->fetch_assoc();

if (!$package) {
    header('Location: packages.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $travelDate = $_POST['travel_date'] ?? '';
    $people = max(1, (int)($_POST['people'] ?? 1));
    $totalPrice = $package['price'] * $people;

    if ($travelDate < date('Y-m-d')) {
        $error = 'Please choose a future travel date.';
    } else {
        $userId = (int)$_SESSION['user_id'];
        $insertStmt = $conn->prepare('INSERT INTO bookings (user_id, package_id, travel_date, people, total_price) VALUES (?, ?, ?, ?, ?)');
        $insertStmt->bind_param('iisid', $userId, $packageId, $travelDate, $people, $totalPrice);
        
        if ($insertStmt->execute()) {
            header('Location: my-bookings.php?success=1');
            exit;
        }
        $error = 'Booking failed. Please try again.';
    }
}

$pageTitle = 'Book ' . htmlspecialchars($package['title']);
require 'includes/header.php';
?>

<section class="section">
    <div class="container booking-grid">
        <div class="summary">
            <img src="<?= htmlspecialchars($package['image']) ?>" alt="<?= htmlspecialchars($package['title']) ?>">
            <h2><?= htmlspecialchars($package['title']) ?></h2>
            <p>📍 <?= htmlspecialchars($package['destination']) ?></p>
            <div class="price">
                ৳<?= number_format($package['price']) ?> <small>/ person</small>
            </div>
        </div>

        <div class="form-card">
            <h2>Booking Details</h2>
            
            <?php if ($error): ?>
                <div class="alert"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post">
                <input type="hidden" name="package_id" value="<?= $package['id'] ?>">
                
                <div class="form-group">
                    <label for="travel_date">Travel Date</label>
                    <input 
                        class="form-control" 
                        type="date" 
                        id="travel_date"
                        name="travel_date" 
                        min="<?= date('Y-m-d', strtotime('+1 day')) ?>" 
                        required
                    >
                </div>
                
                <div class="form-group">
                    <label for="people">Number of People</label>
                    <input 
                        class="form-control" 
                        type="number" 
                        id="people"
                        name="people" 
                        min="1" 
                        max="20" 
                        value="1" 
                        required
                    >
                </div>
                
                <button class="btn" type="submit" style="border: 0; font: inherit; width: 100%;">Confirm Booking</button>
            </form>
        </div>
    </div>
</section>

<?php require 'includes/footer.php'; ?>

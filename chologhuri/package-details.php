<?php
require 'includes/db.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT * FROM tour_packages WHERE id = ? AND status = "active"');
$stmt->bind_param('i', $id);
$stmt->execute();
$package = $stmt->get_result()->fetch_assoc();

if (!$package) {
    http_response_code(404);
    die('Package not found');
}

$pageTitle = $package['title'] . ' | CholoGhuri';
require 'includes/header.php';
?>

<section class="section">
    <div class="container booking-grid">
        <div>
            <img class="about-img" src="<?= htmlspecialchars($package['image']) ?>" alt="<?= htmlspecialchars($package['title']) ?>">
            
            <div class="section-head" style="text-align: left; margin-top: 30px;">
                <span class="badge">📍 <?= htmlspecialchars($package['destination']) ?></span>
                <h2><?= htmlspecialchars($package['title']) ?></h2>
                <p>📅 <?= htmlspecialchars($package['duration']) ?> &nbsp; ⭐ 4.8</p>
            </div>
            
            <p><?= nl2br(htmlspecialchars($package['description'])) ?></p>
        </div>

        <div class="summary">
            <h3>Book this trip</h3>
            <div class="price">
                ৳<?= number_format($package['price']) ?> <small>/ person</small>
            </div>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="btn" href="booking.php?package_id=<?= (int)$package['id'] ?>">Book Now</a>
            <?php else: ?>
                <p>Please login or create an account to continue.</p>
                <a class="btn" href="login.php?redirect=booking.php?package_id=<?= (int)$package['id'] ?>">Login to Book</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require 'includes/footer.php'; ?>

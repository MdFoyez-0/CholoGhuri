<?php
require 'includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = (int)$_SESSION['user_id'];
$bookingsResult = null;

$stmt = $conn->prepare('
    SELECT b.*, p.title, p.destination 
    FROM bookings b 
    JOIN tour_packages p ON p.id = b.package_id 
    WHERE b.user_id = ? 
    ORDER BY b.created_at DESC
');
$stmt->bind_param('i', $userId);
$stmt->execute();
$bookingsResult = $stmt->get_result();

$pageTitle = 'My Bookings | CholoGhuri';
require 'includes/header.php';
?>

<section class="section alt">
    <div class="container">
        <div class="section-head">
            <h2>My Bookings</h2>
            <p>Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?>.</p>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert success">Your booking has been submitted successfully.</div>
        <?php endif; ?>

        <?php if ($bookingsResult && $bookingsResult->num_rows > 0): ?>
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Package</th>
                            <th>Destination</th>
                            <th>Date</th>
                            <th>People</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($booking = $bookingsResult->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($booking['title']) ?></td>
                                <td><?= htmlspecialchars($booking['destination']) ?></td>
                                <td><?= htmlspecialchars($booking['travel_date']) ?></td>
                                <td><?= (int)$booking['people'] ?></td>
                                <td>৳<?= number_format($booking['total_price']) ?></td>
                                <td>
                                    <span class="status <?= htmlspecialchars($booking['status']) ?>">
                                        <?= htmlspecialchars(ucfirst($booking['status'])) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty">
                No bookings yet. <a style="color: var(--orange);" href="packages.php">Explore packages</a>.
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require 'includes/footer.php'; ?>

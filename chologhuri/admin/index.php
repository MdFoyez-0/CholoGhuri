<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../includes/db.php';

$packagesCount = 0;
$usersCount = 0;
$bookingsCount = 0;

if (isset($conn)) {
    $resultPackages = $conn->query("SELECT COUNT(*) AS c FROM tour_packages");
    if ($resultPackages) {
        $packagesCount = $resultPackages->fetch_assoc()['c'] ?? 0;
    }

    $resultUsers = $conn->query("SELECT COUNT(*) AS c FROM users");
    if ($resultUsers) {
        $usersCount = $resultUsers->fetch_assoc()['c'] ?? 0;
    }

    $resultBookings = $conn->query("SELECT COUNT(*) AS c FROM bookings");
    if ($resultBookings) {
        $bookingsCount = $resultBookings->fetch_assoc()['c'] ?? 0;
    }
} else {
    die("Database connection failed.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | CholoGhuri</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container nav-inner">
            <a class="brand" href="../index.php">
                <img src="../images/logo.png" alt="CholoGhuri Logo">
                <span>Cholo<span>Ghuri</span></span>
            </a>
            <nav class="nav-links">
                <a href="../index.php">View Website</a>
            </nav>
        </div>
    </header>

    <main class="section alt">
        <div class="container">
            <div class="section-head">
                <div class="eyebrow" style="color:var(--orange)">ADMIN PANEL</div>
                <h2>Dashboard</h2>
                <p>CholoGhuri booking management overview</p>
            </div>

            <div class="features">
                <div class="feature">
                    <div class="icon">🧳</div>
                    <h3><?= htmlspecialchars($packagesCount) ?></h3>
                    <p>Tour Packages</p>
                </div>
                <div class="feature">
                    <div class="icon">👥</div>
                    <h3><?= htmlspecialchars($usersCount) ?></h3>
                    <p>Registered Users</p>
                </div>
                <div class="feature">
                    <div class="icon">🎫</div>
                    <h3><?= htmlspecialchars($bookingsCount) ?></h3>
                    <p>Total Bookings</p>
                </div>
            </div>

            <div class="form-card" style="margin-top:30px">
                <h3>Admin modules ready to expand</h3>
                <p>Next modules can include Add/Edit/Delete Packages, Booking Approval, User Management and Reports.</p>
            </div>
        </div>
    </main>
</body>
</html>

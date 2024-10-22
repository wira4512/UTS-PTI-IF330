<?php
session_start();
include 'includes/db_connect.php';
include 'includes/header.php';

// Menampilkan daftar event yang terbuka
$query = "SELECT * FROM events WHERE status = 'open'";
$result = $conn->query($query);
?>

<div class="container">
    <h1>Welcome to the Event Registration System</h1>

    <?php if (isset($_SESSION['user_id'])): ?>
        <p>You are logged in as <?= $_SESSION['user_id']; ?></p>
        <a href="user/user_dashboard.php">Go to Dashboard</a>
        <a href="user/logout.php">Logout</a>
    <?php else: ?>
        <a href="user/login.php">Login</a>
        <a href="user/register.php">Register</a>
    <?php endif; ?>

    <h2>Available Events</h2>
    <?php if ($result->num_rows > 0): ?>
        <ul>
        <?php while ($event = $result->fetch_assoc()): ?>
            <li>
                <h3><?= sanitize_input($event['name']); ?></h3>
                <p><?= sanitize_input($event['description']); ?></p>
                <p>Date: <?= $event['date']; ?> | Time: <?= $event['time']; ?></p>
                <p>Location: <?= sanitize_input($event['location']); ?></p>
                <a href="user/event_details.php?event_id=<?= $event['event_id']; ?>">View Details</a>
            </li>
        <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No upcoming events at the moment.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Welcome to your dashboard!</h2>
<a href="view_events.php">View Available Events</a>
<a href="profile.php">Manage Profile</a>
<a href="logout.php">Logout</a>

<?php include '../includes/footer.php'; ?>

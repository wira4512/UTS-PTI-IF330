<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../user/login.php");
    exit();
}

include '../includes/db_connect.php';
?>

<h2>Admin Dashboard</h2>
<a href="manage_events.php">Manage Events</a>
<a href="view_registrants.php">View Event Registrations</a>
<a href="manage_users.php">Manage Users</a>
<a href="../user/logout.php">Logout</a>

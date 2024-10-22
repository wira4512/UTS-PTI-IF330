<?php
include '../includes/header.php';
include '../includes/db_connect.php';

if (!is_admin()) {
    header("Location: ../user/login.php");
    exit();
}

$query = "SELECT * FROM events";
$result = $conn->query($query);

echo "<h2>Manage Events</h2>";
echo "<a href='add_event.php'>Add New Event</a><br><br>";

while ($event = $result->fetch_assoc()) {
    echo "<h3>" . sanitize_input($event['name']) . "</h3>";
    echo "<a href='edit_event.php?event_id=" . $event['event_id'] . "'>Edit</a> | ";
    echo "<a href='delete_event.php?event_id=" . $event['event_id'] . "'>Delete</a><br><br>";
}

include '../includes/footer.php';
?>

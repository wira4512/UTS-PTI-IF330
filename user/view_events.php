<?php
include '../includes/header.php';
include '../includes/db_connect.php';

$query = "SELECT * FROM events WHERE status = 'open'";
$result = $conn->query($query);

while ($event = $result->fetch_assoc()) {
    echo "<h3>" . sanitize_input($event['name']) . "</h3>";
    echo "<p>" . sanitize_input($event['description']) . "</p>";
    echo "<a href='event_details.php?event_id=" . $event['event_id'] . "'>View Details</a>";
}

include '../includes/footer.php';
?>

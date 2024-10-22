<?php
include '../includes/header.php';
include '../includes/db_connect.php';

if (!is_admin()) {
    header("Location: ../user/login.php");
    exit();
}

$event_id = (int)$_GET['event_id'];
$stmt = $conn->prepare("SELECT users.name, users.email, registrations.registration_date FROM registrations JOIN users ON registrations.user_id = users.user_id WHERE registrations.event_id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Event Registrants</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p>Name: " . sanitize_input($row['name']) . ", Email: " . sanitize_input($row['email']) . ", Registration Date: " . $row['registration_date'] . "</p>";
}

include '../includes/footer.php';
?>

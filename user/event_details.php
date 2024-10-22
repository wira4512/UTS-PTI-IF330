<?php
session_start();
include '../includes/db_connect.php';

$event_id = (int)$_GET['event_id'];
$stmt = $conn->prepare("SELECT * FROM events WHERE event_id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

echo "<h2>" . sanitize_input($event['name']) . "</h2>";
echo "<p>" . sanitize_input($event['description']) . "</p>";
echo "<p>Date: " . $event['date'] . " Time: " . $event['time'] . "</p>";
echo "<p>Location: " . sanitize_input($event['location']) . "</p>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO registrations (user_id, event_id, registration_date) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();
    echo "You have successfully registered for this event!";
}

?>

<form method="POST" action="event_details.php?event_id=<?= $event_id ?>">
    <button type="submit">Register for Event</button>
</form>

<?php include '../includes/footer.php'; ?>

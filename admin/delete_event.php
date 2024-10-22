<?php
include '../includes/header.php';
include '../includes/db_connect.php';

if (!is_admin()) {
    header("Location: ../user/login.php");
    exit();
}

$event_id = (int)$_GET['event_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("DELETE FROM events WHERE event_id = ?");
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        echo "Event deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<h3>Are you sure you want to delete this event?</h3>
<form method="POST" action="delete_event.php?event_id=<?= $event_id ?>">
    <button type="submit">Delete Event</button>
</form>

<?php include '../includes/footer.php'; ?>

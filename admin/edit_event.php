<?php
include '../includes/header.php';
include '../includes/db_connect.php';

if (!is_admin()) {
    header("Location: ../user/login.php");
    exit();
}

$event_id = (int)$_GET['event_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST['name']);
    $description = sanitize_input($_POST['description']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = sanitize_input($_POST['location']);
    $max_participants = (int)$_POST['max_participants'];
    
    $stmt = $conn->prepare("UPDATE events SET name = ?, description = ?, date = ?, time = ?, location = ?, max_participants = ? WHERE event_id = ?");
    $stmt->bind_param("ssssiii", $name, $description, $date, $time, $location, $max_participants, $event_id);
    
    if ($stmt->execute()) {
        echo "Event updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    $stmt = $conn->prepare("SELECT * FROM events WHERE event_id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
}
?>

<form method="POST" action="edit_event.php?event_id=<?= $event_id ?>">
    <input type="text" name="name" value="<?= sanitize_input($event['name']) ?>" required>
    <textarea name="description" required><?= sanitize_input($event['description']) ?></textarea>
    <input type="date" name="date" value="<?= $event['date'] ?>" required>
    <input type="time" name="time" value="<?= $event['time'] ?>" required>
    <input type="text" name="location" value="<?= sanitize_input($event['location']) ?>" required>
    <input type="number" name="max_participants" value="<?= $event['max_participants'] ?>" required>
    <button type="submit">Update Event</button>
</form>

<?php include '../includes/footer.php'; ?>

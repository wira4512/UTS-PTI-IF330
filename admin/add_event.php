<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../user/login.php");
    exit();
}

include '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = htmlspecialchars($_POST['location']);
    $max_participants = (int)$_POST['max_participants'];
    $status = 'open';

    if ($_FILES['image']['name']) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        $image = null;
    }

    $stmt = $conn->prepare("INSERT INTO events (name, description, date, time, location, max_participants, image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiis", $name, $description, $date, $time, $location, $max_participants, $image, $status);
    
    if ($stmt->execute()) {
        echo "Event added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<form method="POST" action="add_event.php" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Event Name" required>
    <textarea name="description" placeholder="Event Description" required></textarea>
    <input type="date" name="date" required>
    <input type="time" name="time" required>
    <input type="text" name="location" placeholder="Location" required>
    <input type="number" name="max_participants" placeholder="Max Participants" required>
    <input type="file" name="image">
    <button type="submit">Add Event</button>
</form>

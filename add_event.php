
<?php
session_start();
require_once "config/db.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin.php");
    exit;
}

$message = "";

if (isset($_POST['add_event'])) {

    $title = $_POST['title'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $venue = $_POST['venue'];
    $capacity = $_POST['capacity'];

    $sql = "INSERT INTO events
    (title, category, description, event_date, event_time, venue, capacity)
    VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        $title, $category, $description,
        $event_date, $event_time, $venue, $capacity
    ])) {
        $message = "Event Added Successfully!";
    } else {
        $message = "Something went wrong!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h2>CampusConnect | SPSU</h2>
    <a href="admin_dashboard.php">Dashboard</a>
</header>

<div class="auth">

    <h1>Add New Event</h1>

    <p><?php echo $message; ?></p>

    <form method="POST">

        <label>Event Title</label>
        <input type="text" name="title" required>

        <label>Category</label>
        <input type="text" name="category" required>

        <label>Description</label>
        <input type="text" name="description" required>

        <label>Event Date</label>
        <input type="date" name="event_date" required>

        <label>Event Time</label>
        <input type="time" name="event_time" required>

        <label>Venue</label>
        <input type="text" name="venue" required>

        <label>Capacity</label>
        <input type="number" name="capacity" required>

        <button type="submit" name="add_event" class="btn">
            Add Event
        </button>

    </form>

</div>

</body>
</html>

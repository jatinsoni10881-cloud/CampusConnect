<?php
session_start();
require_once "config/db.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin.php");
    exit;
}

$sql = "SELECT registrations.id, users.name, users.email,
events.title, registrations.registered_at
FROM registrations
JOIN users ON registrations.user_id = users.id
JOIN events ON registrations.event_id = events.id
ORDER BY registrations.id DESC";

$stmt = $pdo->query($sql);
$registrations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registrations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h2>CampusConnect | SPSU</h2>
    <a href="admin_dashboard.php">Dashboard</a>
</header>

<div class="auth">

    <h1>Student Registrations</h1>

    <?php if (count($registrations) > 0) { ?>

        <?php foreach ($registrations as $row) { ?>

            <div class="event-card">

                <h3><?php echo htmlspecialchars($row['name']); ?></h3>

                <p>Email:
                <?php echo htmlspecialchars($row['email']); ?></p>

                <p>Event:
                <?php echo htmlspecialchars($row['title']); ?></p>

                <p>Registered At:
                <?php echo htmlspecialchars($row['registered_at']); ?></p>

            </div>

        <?php } ?>

    <?php } else { ?>

        <p>No student registrations found.</p>

    <?php } ?>

</div>

</body>
</html>

<?php
session_start();
require_once "config/db.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM events ORDER BY id DESC");
$events = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Events</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h2>CampusConnect | SPSU</h2>
    <a href="admin_dashboard.php">Dashboard</a>
</header>

<div class="auth">

    <h1>Manage Campus Events</h1>

    <h3>All Events</h3>

    <?php foreach ($events as $event) { ?>

        <div class="event-card">

            <h2>
                <?php echo htmlspecialchars($event['title']); ?>
            </h2>

            <p>
                Category:
                <?php echo htmlspecialchars($event['category']); ?>
            </p>

            <p>
                Date:
                <?php echo htmlspecialchars($event['event_date']); ?>
            </p>

            <p>
                Venue:
                <?php echo htmlspecialchars($event['venue']); ?>
            </p>

            <p>
                Capacity:
                <?php echo htmlspecialchars($event['capacity']); ?>
            </p>

        </div>

    <?php } ?>

</div>

</body>
</html>

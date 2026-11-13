
<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin.php");
    exit;
}

require_once "config/db.php";

// Get dashboard statistics
$events = $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn();

$registrations = $pdo->query("SELECT COUNT(*) FROM registrations")->fetchColumn();

$students = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'student'")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | CampusConnect</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h2>CampusConnect | SPSU</h2>
    <nav>
        <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<section class="dashboard">

    <h1>Admin Dashboard</h1>

    <p>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</p>

    <div class="dashboard-stats">

        <div class="stat-card">
            <h3>Total Events</h3>
            <h2><?php echo $events; ?></h2>
        </div>

        <div class="stat-card">
            <h3>Total Registrations</h3>
            <h2><?php echo $registrations; ?></h2>
        </div>

        <div class="stat-card">
            <h3>Total Students</h3>
            <h2><?php echo $students; ?></h2>
        </div>

    </div>

    <h2>Manage Campus Events</h2>

    <div class="dashboard-actions">

        <div class="action-card">
            <h3>Add New Event</h3>
            <p>Create a new campus event.</p>
            <a href="add_event.php" class="btn">Add Event</a>
        </div>

        <div class="action-card">
            <h3>Manage Events</h3>
            <p>View and manage existing events.</p>
            <a href="manage_events.php" class="btn">Manage Events</a>
        </div>

        <div class="action-card">
            <h3>View Registrations</h3>
            <p>Check student event registrations.</p>
            <a href="view_registrations.php" class="btn">View Registrations</a>
        </div>

    </div>

</section>

<footer>
    <p>© 2026 CampusConnect | SPSU</p>
</footer>

</body>
</html>

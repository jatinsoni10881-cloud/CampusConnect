
<?php
session_start();
require_once "config/db.php";

$query = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
$events = $query->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CampusConnect | SPSU</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- HEADER -->
<header class="header">
    <h2>CampusConnect | SPSU</h2>

    <nav>
        <a href="#home">Home</a>
        <a href="#events">Events</a>
        <a href="#about">About</a>
        <a href="admin.php">Admin</a>
    </nav>
</header>

<!-- HOME -->
<section class="hero" id="home">
    <h1>Campus Life Starts With an Event.</h1>
    <p>Discover workshops, competitions and cultural events at SPSU.</p>
    <a href="#events" class="btn">Explore Events</a>
</section>

<!-- ABOUT -->
<section id="about" class="about">
    <h2>A Simple Way to Participate</h2>

    <div class="about-items">
        <div>
            <h3>Discover</h3>
            <p>Explore campus events.</p>
        </div>

        <div>
            <h3>Register</h3>
            <p>Register for your favourite events.</p>
        </div>

        <div>
            <h3>Manage</h3>
            <p>Admins can manage events.</p>
        </div>
    </div>
</section>

<!-- UPCOMING EVENTS -->
<section id="events">

    <h2>Upcoming Events</h2>

    <!-- SEARCH AND CATEGORY -->
    <div class="filters">
        <input type="text" id="search" placeholder="Search events...">

        <select id="category">
            <option value="all">All Categories</option>

            <?php
            $categories = [];

            foreach ($events as $event) {
                if (!in_array($event['category'], $categories)) {
                    $categories[] = $event['category'];
                    echo "<option value='" . htmlspecialchars(strtolower($event['category'])) . "'>" . htmlspecialchars($event['category']) . "</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="events-container">

        <?php foreach ($events as $event): ?>

        <div class="event-card"
             data-title="<?= htmlspecialchars(strtolower($event['title'])) ?>"
             data-category="<?= htmlspecialchars(strtolower($event['category'])) ?>">

            <h3><?= htmlspecialchars($event['title']) ?></h3>

            <p><?= htmlspecialchars($event['description']) ?></p>

            <p><b>Category:</b> <?= htmlspecialchars($event['category']) ?></p>

            <p><b>Date:</b> <?= htmlspecialchars($event['event_date']) ?></p>

            <p><b>Time:</b> <?= htmlspecialchars($event['event_time']) ?></p>

            <p><b>Venue:</b> <?= htmlspecialchars($event['venue']) ?></p>

            <p><b>Capacity:</b> <?= htmlspecialchars($event['capacity']) ?></p>

            <?php if (isset($_SESSION['user_id'])): ?>

                <form action="event_register.php" method="POST">
                    <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                    <button type="submit" class="btn">Register Now</button>
                </form>

            <?php else: ?>

                <a href="login.php" class="btn">Login to Register</a>

            <?php endif; ?>

        </div>

        <?php endforeach; ?>

        <?php if (empty($events)): ?>
            <p>No events available currently.</p>
        <?php endif; ?>

    </div>

    <p id="noEvents" style="display:none;">No matching events found.</p>

</section>

<!-- FOOTER -->
<footer>
    <h3>CampusConnect | SPSU</h3>
    <p>Campus Event Management and Registration System</p>
    <p>© 2026 SPSU</p>
</footer>

<!-- SEARCH JAVASCRIPT -->
<script>
function searchEvents() {
    var search = document.getElementById("search").value.toLowerCase();
    var category = document.getElementById("category").value;
    var cards = document.getElementsByClassName("event-card");
    var count = 0;

    for (var i = 0; i < cards.length; i++) {
        var title = cards[i].getAttribute("data-title");
        var cat = cards[i].getAttribute("data-category");

        if (title.includes(search) && (category == "all" || category == cat)) {
            cards[i].style.display = "block";
            count++;
        } else {
            cards[i].style.display = "none";
        }
    }

    document.getElementById("noEvents").style.display =
        count == 0 ? "block" : "none";
}

document.getElementById("search").addEventListener("input", searchEvents);
document.getElementById("category").addEventListener("change", searchEvents);
</script>

</body>
</html>

<!DOCTYPE html>
<!--Van Elias De Hondt-->
<!--HTML-->
<html lang="en">
    <head>
        <!--Meta + Title-->
        <meta charset="utf-8">
        <title>Level Up Upkeepify</title>
        <meta property="og:title" content="Level Up Upkeepify"/>
        <!--Meta + Title-->
        <!--Favicon-->
        <link href="/assets/media/images/favicon.ico" rel="icon">
        <!--Favicon-->
        <!--CSS-->
        <link rel="stylesheet" href="/assets/css/index-style.css">
        <!--CSS-->
    </head>
    <body>
        <main>
            <?php
            session_start();

            if (!isset($_SESSION['user_id'])) {
                header("Location: /index.php");
                exit();
            }

            $user_id = $_SESSION['user_id'];
            $username = $_SESSION['username'];

            // Simulated database connection
            $conn = mysqli_connect("localhost", "root", "", "levelup_app_upkeepify");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch zones and locations associated with the user
            $zonesQuery = $conn->query("SELECT * FROM zone WHERE zone_id IN (SELECT zone_id FROM user_location WHERE user_id = $user_id)");
            $locationsQuery = $conn->query("SELECT * FROM location WHERE location_id IN (SELECT location_id FROM user_location WHERE user_id = $user_id)");
            $itemsQuery = $conn->query("SELECT * FROM item WHERE item_id IN (SELECT item_id FROM item WHERE assigned = $user_id)");

            // Display the logo
            echo '<div class="logo">';
            // Your logo image here
            echo '</div>';

            // Display zones and locations
            echo '<div class="top-bar">';
            echo '<div class="zones">';
            echo '<h2>Zones:</h2>';
            while ($zone = $zonesQuery->fetch_assoc()) {
                echo '<p>' . $zone['name'] . '</p>';
            }
            echo '</div>';

            echo '<div class="locations">';
            echo '<h2>Locations:</h2>';
            while ($location = $locationsQuery->fetch_assoc()) {
                echo '<p>' . $location['name'] . '</p>';
            }
            echo '</div>';
            echo '</div>';

            
            echo '<div class="item-display">';
            echo '<h2>Filtered Items:</h2>';
            while ($item = $itemsQuery->fetch_assoc()) {
                echo '<div class="item">';
                echo '<h3>' . $item['name'] . '</h3>';
                echo '<p>' . $item['status'] . '</p>';
                echo '<p>' . $item['assigned'] . '</p>';
                echo '<p>' . $item['zone_id'] . '</p>';
                echo '</div>';
            }
            echo '</div>';

            $conn->close();
            ?>
        </main>
    </body>
</html>
<!--HTML-->
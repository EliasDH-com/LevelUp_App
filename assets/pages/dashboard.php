<!DOCTYPE html>
<!--Van Elias De Hondt-->
<!--PHP-->
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$conn = mysqli_connect("localhost", "root", "", "levelup_app_upkeepify");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
            
// Fetch zones and locations associated with the user
$zonesQuery = $conn->query("SELECT * FROM zone WHERE zone_id IN (SELECT zone_id FROM user_location WHERE user_id = $user_id)");
$locationsQuery = $conn->query("SELECT * FROM location WHERE location_id IN (SELECT location_id FROM user_location WHERE user_id = $user_id)");
$itemsQuery = $conn->query("SELECT * FROM item WHERE item_id IN (SELECT item_id FROM item WHERE assigned = $user_id)");

?>
<!--PHP-->
<!--HTML-->
<html lang="en">
    <head>
        <!--Meta + Title-->
        <meta charset="utf-8">
        <title>Level Up - Dashboard</title>
        <meta property="og:title" content="Level Up Upkeepify"/>
        <!--Meta + Title-->
        <!--Favicon-->
        <link href="/assets/media/images/favicon.ico" rel="icon">
        <!--Favicon-->
        <!--CSS-->
        <link rel="stylesheet" href="/assets/css/dashboard-style.css">
        <!--CSS-->
        <!--Bootstrap-->
        <link rel="stylesheet" href="/assets/css/bootstrap.css">
        <!--Bootstrap-->
        <!--Font Awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!--Font Awesome-->
    </head>
    <body>
        <header>
            <div class="navigation-bar">
                <div class="main-menu-top">
                    <img class="main-menu-top" src="/assets/media/images/logo.png" alt="Logo">
                    <p class="username">Hey, <?php echo $username; ?></p>
                </div>
                <nav>
                    <ul>
                        <li><a href="/assets/pages/dashboard.php"><i class="fas fa-table"></i> Dashboard</a></li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-clock"></i> SessionSync</a>
                            <ul class="submenu">
                                <li><a href="/assets/pages/SessionSync/timetable-edegem.html" target="_blank">Timetable</a></li>
                                <li><a href="/assets/pages/SessionSync/time-edegem-trampoline.html" target="_blank">Time Trampoline</a></li>
                                <li><a href="/assets/pages/SessionSync/time-edegem-inflatable.html" target="_blank">Time Inflatable</a></li>
                                <li><a href="/assets/pages/SessionSync/time-edegem-bouldering.html" target="_blank">Time Bouldering</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-tv"></i> KioskPulse</a>
                            <ul class="submenu">
                                <li><a href="/assets/pages/kioskpulse/kiosk-index.php" target="_blank">Kiosk</a></li>
                                <li><a href="/assets/pages/kioskpulse/kiosk-display.php" target="_blank">Kiosk Display</a></li>
                                <li><a href="/assets/pages/kioskpulse/kiosk-back-end.php" target="_blank">Kiosk Back-End</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-book"></i> Upkeepify</a>
                            <ul class="submenu">
                                <li><a href="" target="_blank">X</a></li>
                                <li><a href="" target="_blank">X</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-business-time"></i> Roller</a>
                            <ul class="submenu">
                                <li><a href="https://manage.roller.app/manage" target="_blank">Roller Dashboard</a></li>
                                <li><a href="https://pos.roller.app" target="_blank">Roller POS</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-cash-register"></i> Lightspeed</a>
                            <ul class="submenu">
                                <li><a href="https://auth.posios.com/manager" target="_blank">Lightspeed POS</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-toggle-on"></i> Strobbo</a>
                            <ul class="submenu">
                                <li><a href="https://login.strobbo.com" target="_blank">Strobbo Home</a></li>
                                <li><a href="https://app.strobbo.com/LevelUp/TimeClockPIN.aspx?ClockInDevice_owr=0" target="_blank">Strobbo Time Clock</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="main-menu-bottom">
                    <a href="#" id="collapse-button" class="collapse-icon"><i class="fas fa-chevron-left"></i></a>
                    <a href=""><i class="fas fa-bell"></i></a>
                    <a href=""><i class="fas fa-user"></i></a>
                    <a href=""><i class="fas fa-info"></i></a>
                    <a href="/login.php"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </header>
        <main class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Dashboard</h1>
                        <h2>Filtered Items:</h2>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Assigned</th>
                                <th>Zone ID</th>
                            </tr>
                            <?php // Fetch and display items in a table
                            while ($item = $itemsQuery->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $item['name'] . '</td>';

                                // Display the status
                                if ($item['status'] == 0) echo '<td>Not completed</td>';  
                                elseif ($item['status'] == 1) echo '<td>Completed</td>';
                                else echo '<td>Status Unknown</td>';

                                // Search for the corresponding user for the assigned task
                                $userQuery = $conn->query("SELECT username FROM users WHERE user_id = " . $item['assigned']);
                                
                                if ($userQuery && $userQuery->num_rows > 0) {
                                    $user = $userQuery->fetch_assoc();
                                    echo '<td>' . ucfirst($user['username']) . '</td>'; // To uppercase
                                } else echo '<td>User not found</td>';
                                
                                $zoneQuery = $conn->query("SELECT name FROM zone WHERE zone_id = " . $item['zone_id']);

                                if ($zoneQuery && $zoneQuery->num_rows > 0) {
                                    $zone = $zoneQuery->fetch_assoc();
                                    echo '<td>' . ucfirst($zone['name']) . '</td>'; // To uppercase
                                } else echo '<td>Zone not found</td>';

                                echo '</tr>';
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <!--JS-->
    <script src="/assets/js/dynamic-navigation-bar.js"></script>
    <!--JS-->
</html>
<!--HTML-->
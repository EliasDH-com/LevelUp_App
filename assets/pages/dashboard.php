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
                    <!-- Your logo goes here -->
                    <img class="main-menu-top" src="/assets/media/images/logo.png" alt="Logo">
                    <p class="username">Hey, <?php echo $username; ?></p>
                </div>
                <nav>
                    <ul>
                        <li><a href="/assets/pages/dashboard.php">Dashboard</a></li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-clock"></i> SessionSync</a>
                            <ul class="submenu">
                                <li><a href="">Timetable</a></li>
                                <li><a href="">Time Trampoline</a></li>
                                <li><a href="">Time Inflatable</a></li>
                                <li><a href="">Time Bouldering</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-tv"></i> KioskPulse</a>
                            <ul class="submenu">
                                <li><a href="">Kios</a></li>
                                <li><a href="">Kiosk Display</a></li>
                                <li><a href="">Beck-End</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-book"></i> Upkeepify</a>
                            <ul class="submenu">
                                <li><a href="">1</a></li>
                                <li><a href="">2</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-business-time"></i> Roller</a>
                            <ul class="submenu">
                                <li><a href="https://manage.roller.app/manage">Roller Dashboard</a></li>
                                <li><a href="https://pos.roller.app">Roller POS</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#"><i class="fas fa-toggle-on"></i> Strobbo</a>
                            <ul class="submenu">
                                <li><a href="https://login.strobbo.com">Strobbo Home</a></li>
                                <li><a href="https://app.strobbo.com/LevelUp/TimeClockPIN.aspx?ClockInDevice_owr=0">Strobbo Time Clock</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="main-menu-bottom">
                    <a href="/login.php"><i class="fas fa-sign-out-alt"></i></a>
                    <a href="/settings.php"><i class="fas fa-cog"></i></a>
                    <a href="/profile.php"><i class="fas fa-user"></i></a>
                    <a href="/profile.php"><i class="fas fa-bell"></i></a>
                </div>
            </div>
        </header>
    </body>
    <!--JS-->
    <script src="/assets/js/submenu_navigation.js"></script>
    <!--JS-->
</html>
<!--HTML-->
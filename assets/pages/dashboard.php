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
        <title>Level Up Upkeepify</title>
        <meta property="og:title" content="Level Up Upkeepify"/>
        <!--Meta + Title-->
        <!--Favicon-->
        <link href="/assets/media/images/favicon.ico" rel="icon">
        <!--Favicon-->
        <!--CSS-->
        <link rel="stylesheet" href="/assets/css/dashboard-style.css">
        <!--CSS-->
        <!--bootstrap-->
        <link rel="stylesheet" href="/assets/css/bootstrap.css">
        <!--bootstrap-->
    </head>
    <body>
        <main>
            <span style="font-size:30px;cursor:pointer" onclick="openSideMenu()">&#9776;</span>

            <div class="side-menu" id="sideMenu">
                <a href="javascript:void(0)" class="close-btn" onclick="closeSideMenu()">&times;</a>
                <a class="username">Welcome, <?php echo $username; ?></a>
                <a href="/assets/pages/dashboard.php">Dashboard</a>
                <a href="/login.php">Logout</a>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        





            <div class="top-bar">
                <div class="logo">
                    <img src="/assets/media/images/logo.png" alt="Logo">
                </div>
                <div class="zones">
                    <h2>Zones:</h2>
                    <?php
                    // Fetch and display zones
                    while ($zone = $zonesQuery->fetch_assoc()) {
                        echo '<p>' . $zone['name'] . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="left-bar">
                <div class="locations">
                    <h2>Locations:</h2>
                    <?php
                    // Fetch and display locations
                    while ($location = $locationsQuery->fetch_assoc()) {
                        echo '<p>' . $location['name'] . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="item-display">
                <h2>Filtered Items:</h2>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Assigned</th>
                        <th>Zone ID</th>
                    </tr>
                    <?php
                    // Fetch and display items in a table
                    while ($item = $itemsQuery->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $item['name'] . '</td>';
                        echo '<td>' . $item['status'] . '</td>';
                        echo '<td>' . $item['assigned'] . '</td>';
                        echo '<td>' . $item['zone_id'] . '</td>';
                         echo '</tr>';
                    }
                    ?>
                </table>
            </div>
        </main>
    </body>
    <!--JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="/assets/js/dashboard-menu.js"></script>
    <!--JS-->
</html>
<!--HTML-->
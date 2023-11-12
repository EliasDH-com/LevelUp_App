<!DOCTYPE html>
<!--Van Elias De Hondt-->
<!--PHP-->
<?php include '../../php/database.php'; 

$itemsQuery = $conn->query("SELECT * FROM item WHERE item_id IN (SELECT item_id FROM item WHERE assigned = $user_id)");
?>
<!--PHP-->
<!--HTML-->
<html lang="en">
    <head>
        <!--Meta + Title-->
        <meta charset="utf-8">
        <title>Level Up - View Items</title>
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
        <!--Main Menu-->
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
                            <a href="#"><i class="fas fa-book"></i> Upkeepify</a>
                            <ul class="submenu">
                                <li><a href="/assets/pages/upkeepify/add-user.php">Add Users</a></li>
                                <li><a href="/assets/pages/upkeepify/view-items.php">View Items</a></li>
                            </ul>
                        </li>
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
                <!--Hidden until bell icon is pressed-->
                <div class="overlay" id="overlay"></div>
                <div class="info-user-bell-window" id="notificationsPopup" style="display: none;">
                    <h2>Notifications</h2>
                    <p id="notifications"></p>
                    <button onclick="closeNotificationsPopup()">Close</button>
                </div>
                <!--Hidden until bell icon is pressed-->
                <!--Hidden until user icon is pressed-->
                <div class="overlay" id="overlay"></div>
                <div class="info-user-bell-window" id="userInfoPopup" style="display: none;">
                    <h2>User Information</h2>
                    <p id="userInfo"></p>
                    <button onclick="closeUserInfoPopup()">Close</button>
                </div>
                <!--Hidden until user icon is pressed-->
                <!--Hidden until info icon is pressed-->
                <div class="overlay" id="overlay"></div>
                <div class="info-user-bell-window" id="infoWindow">
                    <h2 id="infoTitleEN" style="display: block;">Overview - Level Up Application Dashboard</h2>
                    <h2 id="infoTitleNL" style="display: none;">Overzicht - Level Up Applicatiedashboard</h2>
                    <h2 id="infoTitleFR" style="display: none;">Aperçu - Tableau de bord de l'application Level Up</h2>
                    <p id="infoContentEN" style="display: block;">
                        <strong>Purpose:</strong> The Level Up Application Dashboard provides a centralized gateway to various applications used within the company, both internally developed and from external partners. It serves as a central hub for all employees, offering an overview of different applications, enabling simple navigation and access.
                    </p>
                    <p id="infoContentNL" style="display: none;">
                        <strong>Doel:</strong> Het Level Up Applicatiedashboard biedt een gecentraliseerde toegang tot diverse applicaties die worden gebruikt binnen het bedrijf, zowel intern ontwikkeld als door externe partners. Het vormt een centraal punt voor alle medewerkers en biedt een overzicht van verschillende applicaties, waardoor een eenvoudige navigatie en toegang mogelijk is.
                    </p>
                    <p id="infoContentFR" style="display: none;">
                        <strong>Objectif :</strong> Le tableau de bord de l'application Level Up offre une passerelle centralisée vers diverses applications utilisées au sein de l'entreprise, à la fois développées en interne et par des partenaires externes. Il sert de point central pour tous les employés, offrant un aperçu de différentes applications, permettant une navigation et un accès simples.
                    </p>
                    <button onclick="closeInfoWindow()">Close</button>
                    <select id="languageSelect" onchange="changeLanguage(this.value)">
                        <option value="EN">English</option>
                        <option value="NL">Nederlands</option>
                        <option value="FR">Français</option>
                    </select>
                </div>
                <!--Hidden until info icon is pressed-->
                <div class="main-menu-bottom">
                    <a href="#" id="collapse-button" class="collapse-icon"><i class="fas fa-chevron-left"></i></a>
                    <a href="#" onclick="openNotificationsPopup()"><i class="fas fa-bell"></i></a>
                    <a href="#" onclick="openUserInfoPopup()"><i class="fas fa-user"></i></a>
                    <a href="#" onclick="openInfoWindow()"><i class="fas fa-info"></i></a>
                    <a href="/login.html"><i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </header>
        <!--Main Menu-->
        <!--Main Content-->
        <main class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>Items</h1>
                        <select id="statusFilter">
                            <option value="all">All Statuses</option>
                            <option value="Incomplete">Incomplete</option>
                            <option value="Completed">Completed</option>
                            <option value="unknown">Unknown status</option>
                        </select>
                        <div class="table-container">
                            <table>
                                <tr>
                                    <th class="table-attributes sticky">Name</th>
                                    <th class="table-attributes sticky">Status</th>
                                    <th class="table-attributes sticky">Assigned</th>
                                    <th class="table-attributes sticky">Zone</th>
                                    <th class="table-attributes sticky">Location</th>
                                </tr>
                                <!--PHP-->
                                <?php // Fetch and display items in a table
                                while ($item = $itemsQuery->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $item['name'] . '</td>';

                                    if ($item['status'] == 0) echo '<td>Incomplete</td>';  
                                    elseif ($item['status'] == 1) echo '<td>Completed</td>';
                                    else echo '<td>Status Unknown</td>';

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

                                    $locationQuery = $conn->query("SELECT name FROM location WHERE location_id = (SELECT location_id FROM zone WHERE zone_id = " . $item['zone_id'] . ")");

                                    if ($locationQuery && $locationQuery->num_rows > 0) {
                                        $location = $locationQuery->fetch_assoc();
                                        echo '<td>' . ucfirst($location['name']) . '</td>'; // To uppercase
                                    } else echo '<td>Location not found</td>';

                                    echo '</tr>';
                                }
                                ?>
                                <!--PHP-->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--Main Content-->
    </body>
    <!--JS-->
    <script> const userId = "<?php echo $user_id; ?>"; </script> <!-- Pass user id to JS -->
    <script src="/assets/js/filters-items.js"></script>
    <script src="/assets/js/dynamic-navigation-bar.js"></script>
    <!--JS-->
</html>
<!--HTML-->
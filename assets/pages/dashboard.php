<!DOCTYPE html>
<!--Van Elias De Hondt-->
<!--PHP-->
<?php include '../php/database.php'; ?>
<!--PHP-->
<!--HTML-->
<html lang="en">
    <head>
        <!--Meta + Title-->
        <meta charset="utf-8">
        <title>Level Up - Dashboard</title>
        <meta property="og:title" content="Level Up - Dashboard"/>
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
                                <li><a href="/assets/pages/upkeepify/add-item.php">Add Items</a></li>
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
                    <h2 id="infoTitleEN" style="display: block;">Overview - Level Up Application</h2>
                    <h2 id="infoTitleNL" style="display: none;">Overzicht - Level Up Applicatie</h2>
                    <h2 id="infoTitleFR" style="display: none;">Aperçu - Application Level Up</h2>
                    <p id="infoContentEN" style="display: block;">
                        <strong>Purpose:</strong> The Level Up Application provides a centralized gateway to various applications used within the company, both internally developed and from external partners. It serves as a central hub for all employees, offering an overview of different applications, enabling simple navigation and access.
                        <br><br>
                        <strong>Version:</strong> 1.0.0
                        <br><br>
                        <a href="https://eliasdh.com/assets/pages/privacy-policy.html" target="_blank">EliasDH Privacy Policy</a>
                        <br>
                        <a href="https://eliasdh.com/assets/pages/legal-guidelines.html" target="_blank">EliasDH Legal Guidelines</a>
                    </p>
                    <p id="infoContentNL" style="display: none;">
                        <strong>Doel:</strong> Het Level Up Applicatie biedt een gecentraliseerde toegang tot diverse applicaties die worden gebruikt binnen het bedrijf, zowel intern ontwikkeld als door externe partners. Het vormt een centraal punt voor alle medewerkers en biedt een overzicht van verschillende applicaties, waardoor een eenvoudige navigatie en toegang mogelijk is.
                        <br><br>
                        <strong>Versie:</strong> 1.0.0
                        <br><br>
                        <a href="https://eliasdh.com/assets/pages/privacy-policy.html" target="_blank">EliasDH Privacybeleid</a>
                        <br>
                        <a href="https://eliasdh.com/assets/pages/legal-guidelines.html" target="_blank">EliasDH Juridische Richtlijnen</a>

                    </p>
                    <p id="infoContentFR" style="display: none;">
                        <strong>Objectif:</strong> L'application Level Up offre un accès centralisé à diverses applications utilisées au sein de l'entreprise, tant développées en interne que par des partenaires externes. Il constitue un point central pour tous les employés et donne un aperçu des différentes applications, permettant une navigation et un accès faciles.
                        <br><br>
                        <strong>Version:</strong> 1.0.0
                        <br><br>
                        <a href="https://eliasdh.com/assets/pages/privacy-policy.html" target="_blank">EliasDH Politique De Confidentialité</a>
                        <br>
                        <a href="https://eliasdh.com/assets/pages/legal-guidelines.html" target="_blank">EliasDH Directives Juridiques</a>
                    </p>
                    <button onclick="closeInfoWindow()">Close</button>
                    <select class="select" id="languageSelect" onchange="changeLanguage(this.value)">
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
                        <h1>Service Status</h1>
                        <ul class="status-list">
                            <li class="service-item">
                                <span class="service-name">Upkeepify</span>
                                <span class="service-status service-issues">Experiencing Issues</span>
                            </li>
                            <li class="service-item">
                                <span class="service-name">SessionSync</span>
                                <span class="service-status service-operational">Operational</span>
                            </li>
                            <li class="service-item">
                                <span class="service-name">KioskPulse</span>
                                <span class="service-status service-operational">Operational</span>
                            </li>
                            <li class="service-item">
                                <span class="service-name">Roller</span>
                                <span class="service-status service-operational">Operational</span>
                            </li>
                            <li class="service-item">
                                <span class="service-name">Lightspeed</span>
                                <span class="service-status service-operational">Operational</span>
                            </li>
                            <li class="service-item">
                                <span class="service-name">Strobbo</span>
                                <span class="service-status service-issues">Experiencing Issues</span>
                            </li>
                            <li class="service-item">
                                <span class="service-name">Level Up Entrance computer 1</span>
                                <span class="service-status service-operational">Operational</span>
                            </li>
                            <li class="service-item">
                                <span class="service-name">Level Up Entrance computer 2</span>
                                <span class="service-status service-operational">Operational</span>
                            </li>
                            <li class="service-item">
                                <span class="service-name">Level Up Entrance computer 3</span>
                                <span class="service-status service-operational">Operational</span>
                            </li>
                            <li class="service-item">
                                <span class="service-name">Ter Eiken Entrance computer 1</span>
                                <span class="service-status service-operational">Operational</span>
                            </li>
                        </ul>
                        <br>
                        <h1>Local Pages</h1>
                        <div class="local-pages">
                            <a href="https://192.168.20.23:18080" target="_blank" class="button">Eocortex Web Client</a>
                            <a href="http://192.168.20.25:5544" target="_blank" class="button">Loxone Web Client</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!--Main Content-->
    </body>
    <!--JS-->
    <script> const userId = "<?php echo $user_id; ?>"; </script> <!-- Pass user id to JS -->
    <script src="/assets/js/toggle-sticky.js"></script>
    <script src="/assets/js/dynamic-navigation-bar.js"></script>
    <!--JS-->
</html>
<!--HTML-->
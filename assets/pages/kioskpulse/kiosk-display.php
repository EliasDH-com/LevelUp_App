<!DOCTYPE html>
<!--Van Elias De Hondt-->
<!--PHP-->
<?php
function displayOrders($filename) {
  if (file_exists($filename)) {
    $csvLines = file($filename);
    foreach ($csvLines as $index => $csvLine) {
      $csvData = str_getcsv($csvLine);
      $name = $csvData[0];
      $completed = $csvData[1];
      echo "<div class='data-box'>";
      echo "<p>$name</p>";
      if ($completed == "Finished") {
        echo "<p style='color: green;'>$completed</p>";
      } else {
        echo "<p style='color: yellow;'>$completed</p>";
      }
      echo "</div>";
    }
  }
}
?>
<!--PHP-->
<!--HTML-->
<html lang="en">
  <head>
      <!--Meta + Title-->
      <meta charset="utf-8">
      <title>Level Up - Edegem Kiosk Display</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta property="og:title" content="Level Up - Edegem Kiosk Display"/>
      <!--Meta + Title-->
      <!--Favicon-->
      <link href="/assets/media/images/favicon.ico" rel="icon">
      <!--Favicon-->
      <!--Bootstrap-->
      <link rel="stylesheet" href="/assets/css/bootstrap.css">
      <!--Bootstrap-->
      <!--CSS-->
      <link rel="stylesheet" href="/assets/css/display-style.css">
      <!--CSS-->
  </head>
  <body>
    <img style="margin-left: 64px;" src="/assets/media/images/time-leverup-logo.png" alt="Logo">
    <div id="top-right">
      <div id="clock"></div>
    </div>
    <div id="content">
      <!-- Toon de niet voltooide orders -->
      <?php displayOrders("../../../data/not-finished-orders.csv"); ?>

      <!-- Toon de voltooide orders -->
      <?php displayOrders("../../../data/finished-orders.csv"); ?>
    </div>
    <!--JS-->
    <script>
    function updateClock() {
      const now = new Date();
      const hours = now.getHours().toString().padStart(2, '0');
      const minutes = now.getMinutes().toString().padStart(2, '0');
      const seconds = now.getSeconds().toString().padStart(2, '0');
      const formattedTime = `${hours}:${minutes}:${seconds}`;
      document.getElementById("clock").textContent = formattedTime;
    }
    // Update de klok elke seconde
    setInterval(updateClock, 1000);
    // Voer de klokfunctie ook meteen uit om de klok in te stellen
    updateClock();
    </script>
    <script> setTimeout(() => document.location.reload(), 5000); </script>
    <!--JS-->
  </body>
</html>
<!--HTML-->
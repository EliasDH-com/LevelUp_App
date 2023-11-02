<!DOCTYPE html>
<!--Van Elias De Hondt-->
<html lang="en">
    <head>
        <!--Meta + Title-->
        <meta charset="utf-8">
        <title>Level Up - Edegem Kiosk Back-End</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta property="og:title" content="Level Up - Edegem Kiosk Beck-End"/>
        <!--Meta + Title-->
        <!--Favicon-->
        <link href="/assets/media/images/favicon.ico" rel="icon">
        <!--Favicon-->
        <!--CSS-->
        <link rel="stylesheet" href="/assets/css/kiosk-index-style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <!--CSS-->
    </head>
    <body>
        <p>Please keep this page open for the full functionality of the application in question.</p>
        <!--PHP-->
        <?php
        // Check if orders in finished_orders.csv need to be archived
        $finishedFilename = "../../../data/finished-orders.csv";
        $archiveFilename = "../../../data/archive-orders.csv";
        if (file_exists($finishedFilename)) {
            $csvLines = file($finishedFilename);
            $currentTimestamp = time();
            foreach ($csvLines as $index => $csvLine) {
                $orderDetails = str_getcsv($csvLine);
                $completed = $orderDetails[1];
                $completedTimestamp = strtotime($orderDetails[2]); // Assuming timestamp is in third column
                if ($currentTimestamp - $completedTimestamp > 300) { // 300 seconds = 5 minutes
                    // Move the order to archive_orders.csv
                    file_put_contents($archiveFilename, $csvLine, FILE_APPEND);
                    unset($csvLines[$index]);
                }
            }
            file_put_contents($finishedFilename, implode("", $csvLines)); // Update finished_orders.csv
        }
        ?>
        <!--PHP-->
        <!--JS-->
        <script> setTimeout(() => document.location.reload(), 5000); </script>
        <!--JS-->
    </body>
</html>

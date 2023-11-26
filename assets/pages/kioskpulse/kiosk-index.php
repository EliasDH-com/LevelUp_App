<!DOCTYPE html>
<!--Van Elias De Hondt-->
<html lang="en">
    <head>
        <!--Meta + Title-->
        <meta charset="utf-8">
        <title>Level Up - Edegem Kiosk</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta property="og:title" content="Level Up - Edegem Kiosk"/>
        <!--Meta + Title-->
        <!--Favicon-->
        <link href="/assets/media/images/favicon.ico" rel="icon">
        <!--Favicon-->
        <!--CSS-->
        <link rel="stylesheet" href="/assets/css/bootstrap.css">
        <link rel="stylesheet" href="/assets/css/kiosk-index-style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <!--CSS-->
    </head>
    <body>
        <!--PHP-->
        <?php
        // Function to remove a line from CSV file by index
        function removeLineFromCSV($filename, $indexToRemove) {
            $lines = file($filename);
            if (isset($lines[$indexToRemove])) {
                unset($lines[$indexToRemove]);
                file_put_contents($filename, implode("", $lines));
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["naamInput"];
            $completed = isset($_POST["klaarCheckbox"]) ? "Finished" : "Not Finished";

            $data = array($name, $completed);

            $filename = "../../../data/not-finished-orders.csv";

            $file = fopen($filename, "a");

            if ($file) {
                fputcsv($file, $data);
                fclose($file);
            }
        }

        if (isset($_GET["remove"])) {
            $indexToRemove = $_GET["remove"];
            $filename = "../../../data/not-finished-orders.csv";
            $csvLines = file($filename);
            
            if (isset($csvLines[$indexToRemove])) {
                $removedOrder = $csvLines[$indexToRemove];
                unset($csvLines[$indexToRemove]);
            
                // Schrijf de bijgewerkte huidige orders terug naar het huidige bestand
                file_put_contents($filename, implode("", $csvLines));
            
                // Update the status and add the removed order to the finished orders file
                $csvLine = str_getcsv($removedOrder);
                $name = $csvLine[0];
                $completed = $csvLine[1] === "Not Finished" ? "Finished" : $csvLine[1];
                $timestamp = date("Y-m-d H:i:s"); // Adding the timestamp in the expected format
                $updatedOrder = "$name,$completed,$timestamp\n"; // Including timestamp
                
                // Voeg de verwijderde order toe aan het voltooide orders bestand
                $finishedFilename = "../../../data/finished-orders.csv";
                file_put_contents($finishedFilename, $updatedOrder, FILE_APPEND);
            }
        }
        ?>
        <!--PHP-->
        <h1>Enter name of customer:</h1>
        <form method="post">
            <input type="text" name="naamInput" placeholder="Enter name of customer">
            <label><input type="checkbox" name="klaarCheckbox"> Finished</label>
            
            <input type="submit">
        </form>
        <h2>Current Orders:</h2>
        <table>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Completed</th>
                <th>Actions</th>
            </tr>
            <!--PHP-->
            <?php
            // Dynamically load CSV data into the table
            $filename = "../../../data/not-finished-orders.csv";
            if (file_exists($filename)) {
                $csvLines = file($filename);
                for ($i = 0; $i < count($csvLines); $i++) {
                    $csvLine = str_getcsv($csvLines[$i]);
                    $name = $csvLine[0];
                    $completed = $csvLine[1];
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$name</td>";
                    echo "<td>$completed</td>";
                    echo "<td><a href=\"?remove=$i\">Remove</a></td>";
                    echo "</tr>";
                }
            }

            // Verwijder alle query parameters na het verwijderen van een rij
            if (isset($_GET["remove"])) {
                $currentUrl = $_SERVER['REQUEST_URI'];
                $cleanUrl = strtok($currentUrl, '?'); // Verwijder alle query parameters
                echo "<script> history.replaceState(null, null, '$cleanUrl'); </script>";
            }
            ?>
            <!--PHP-->
        </table>
    </body>
</html>

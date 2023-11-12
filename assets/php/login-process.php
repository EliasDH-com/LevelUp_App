<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

include '../../assets/php/database.php';

if (isset($_POST['login_post'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    // Check of er een overeenkomende gebruiker is
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $db_password = $row['password'];

      // Vergelijk het ingevoerde wachtwoord met het gehashte wachtwoord uit de database
      if (password_verify($password, $db_password)) {
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];

        header("Location: ../pages/dashboard.php");
      }
    }
  }
}
?>

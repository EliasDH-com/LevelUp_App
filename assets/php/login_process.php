<?php
/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 31/10/2023
 */

session_start(); // Start de sessie

$conn = mysqli_connect("localhost", "root", "", "levelup_app_upkeepify");

if(isset($_POST['login_post'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  
  while($row = mysqli_fetch_array($result)) {
    $db_password = $row['password'];

    if($password == $db_password) {
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['username'] = $row['username'];
      
      header("Location: ../pages/dashboard.php");
    }
  }
}
?>
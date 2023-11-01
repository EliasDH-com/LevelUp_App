<!DOCTYPE html>
<!--Van Elias De Hondt-->
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
    <link rel="stylesheet" href="/assets/css/login-style.css">
    <!--CSS-->
  </head>
  <body>
    <main>
      <div class="login-form">
        <div class="logo">
          <img src="/assets/media/images/logo.png" alt="Logo">
        </div>
        <form method="post" action="login.php">
          <input type="email" name="email" placeholder="E-mail" required><br>
          <input type="password" name="password" placeholder="Password" required><br>
          <button type="submit" name="login_post">Login</button>
        </form>
      </div>
      <div class="app-name">Level Up Upkeepify</div>
    </main>
  </body>
</html>
<!--HTML-->
<!--PHP-->
<?php
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
      
      header("Location: assets/pages/dashboard.php");
    }
  }
}
?>
<!--PHP-->
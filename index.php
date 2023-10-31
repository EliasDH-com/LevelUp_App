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
    <link rel="stylesheet" href="/assets/css/index-style.css">
    <!--CSS-->
  </head>
  <body>
    <header>
      <img src="/assets/media/images/index-logo.png" alt="Logo">
    </header>
    <main>
      <div class="login-form">
        <form method="post" action="">
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
if (isset($_POST['login_post'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $file = 'data/users.csv';

  if (file_exists($file)) { // Check if the file exists
    $users = array_map('str_getcsv', file($file));

    foreach ($users as $user) { // Loop through user data
      $db_email = $user[1];
      $db_password = $user[2];

      if ($email === $db_email && $password === $db_password) {
        header('Location: /assets/pages/dashboard.php');
        exit;
      }
    }
  }
}
?>
<!--PHP-->
<!DOCTYPE html>
<?php
session_start();
$name = $password;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  $conn = new mysqli('localhost', 'root', '', 'blog');

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * WHERE password=" . md5($password) . " AND username=" . $name;

  $result = $conn->query($sql);
  if($result) {
    $_SESSION['id'] = $result['id'];
    $_SESSION['username'] = $result['username'];
    $conn = null;
  } else {
    $conn = null;
    header("Location: welcome.php");
    die();
  }
}
?>
<html lang="en" style="height: 100%">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blog | Log in</title>
  <style rel="stylesheet">
    input, button[type=submit]{
      margin-bottom: 20px;
      padding: 10px;
      font-size: 20px;
    }
    #signup-banner {
      font-size: 20px;
      color: rgb(105, 105, 105);
    }
  </style>
</head>
<body style="margin: 0; padding: 0; height: 100%">
  <main style="display: flex; justify-content: center; height: 100%; align-items: center; background-color: rgb(245, 245, 245)">
    <section style="background-color: white; width: 30%; text-align: center; padding: 40px; height: 30%">
    <h3>Log in</h3>
      <form method="POST" action="welcome.php" style="display: flex; flex-direction: column">
        <input type="text" placeholder="username" />
        <input type="password" placeholder="password" />
        <button type="submit">Log in</button>
      </form>
      <div id="signup-banner">
        <span>Don't have an account?</span><a href="signup.php">Sign up</a>
      </div>
    </section>
  </main>
</body>
</html>
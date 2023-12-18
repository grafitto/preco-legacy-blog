<!DOCTYPE html>
<?php
$name = $email;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  print('Here inside');
  $name = trim($_POST["username"]);
  $password = trim($_POST["password"]);

  print($name);
  print($password);

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $conn = new mysqli('localhost', 'root', '', 'blog');

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO users (username, password) VALUES ('" . $name ."','" . md5($password) ."')";

  if ($conn->query($sql) === TRUE) {
    $conn = null;
    header("Location: index.php");
    die();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>

<html lang="en" style="height: 100%">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blog | Sign up</title>
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
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display: flex; flex-direction: column">
        <h3>Sign up</h3>
        <input type="text" placeholder="username" name="username" />
        <input type="password" placeholder="password" name="password" />
        <button type="submit">Sign up</button>
      </form>
      <div id="signup-banner">
        <span>Have an account?</span><a href="index.php">log in</a>
      </div>
    </section>
  </main>
</body>
</html>
<?php
session_start();

if(!$_SESSION['id']) {
  header("Location: index.php");
    die();
}
$title = $content = $user_id;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = trim($_POST["title"]);
  $content = trim($_POST["content"]);
  $user_id = $_SESSION['id'];

  $conn = new mysqli('localhost', 'root', '', 'blog');

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO blogs (title, content, user_id) VALUES ('" . $title ."','" . $content ."'," . $user_id . ")";

  if ($conn->query($sql) === TRUE) {
    $conn = null;
    header("Location: welcome.php");
    die();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog | New</title>
  <style rel="stylesheet">
    input, button[type=submit], textarea {
      margin-bottom: 20px;
      padding: 10px;
      font-size: 20px;
    }
  </style>
</head>
<body style="margin: 0; padding: 0; height: 100%">
  <main style="display: flex; justify-content: center; height: 100%; align-items: center; background-color: rgb(245, 245, 245)">
    <section style="background-color: white; width: 30%; text-align: center; padding: 40px; height: 80%">
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="display: flex; flex-direction: column">
        <h3>New post</h3>
        <input type="title" placeholder="title" name="title" required />
        <textarea placeholder="Write your sweet blog here" name="content" rows="20" required></textarea>
        <button type="submit">Save</button>
      </form>
    </section>
  </main>
</body>
</html>
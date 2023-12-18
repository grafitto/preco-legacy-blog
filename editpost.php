<?php
session_start();
if(!$_SESSION['id']) {
  header("Location: login.php");
    die();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $new_title = trim($_POST['title']);
  $new_content = trim($_POST['content']);
  $post_id = $_SESSION['post_id'];
  $new_post_is_public = $_POST['isPublic'] ? 1 : 0;

  $conn = new mysqli('localhost', 'root', '', 'blog');

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "UPDATE blogs SET title='" . $new_title ."', content='" . $new_content . "', is_public=" . $new_post_is_public . " WHERE id=" . $post_id;

  if ($conn->query($sql) === TRUE) {
    $conn = null;
    header("Location: welcome.php");
    die();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  die();
} else {
  $title = $_SESSION['post_title'];
  $post_id = $_SESSION['post_id'];
  $content = $_SESSION['post_content'];
  $is_public = $_SESSION['post_is_public'];
}
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
        <h3>Edit post</h3>
        <input type="text" placeholder="title" name="title" required value="<?= $title; ?>"/>
        <textarea placeholder="Write your sweet blog here" name="content" rows="20" required><?= $content; ?></textarea>
        <div>Public <input type="checkbox" name="isPublic" id="public" <?php echo $is_public ? 'checked' : ''; ?>/></div>
        <button type="submit">Save</button>
      </form>
    </section>
  </main>
</body>
</html>
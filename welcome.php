<?php
session_start();
$user_id = $_SESSION['id'];
$username = $_SESSION['username'];
$blogs = [];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if($_GET['edit'] == 1) {
    $_SESSION['post_title'] = $_GET['title'];
    $_SESSION['post_content'] = $_GET['content'];
    $_SESSION['post_id'] = $_GET['id'];
    header('Location: editpost.php');
    die();
  }
  // Fetch blogs
  $conn = new mysqli('localhost', 'root', '', 'blog');

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM blogs WHERE user_id=" . $user_id;

  $result = $conn->query($sql);
  if($result) {
    if ($result->num_rows > 0) {
      // output data of each row
      $blogs = $result->fetch_all(MYSQLI_ASSOC);
    } else {
      print('No rows');
      die();
    }
  } else {
    print('No result');
    die();
  }
  $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog | Dashboard</title>
  <style rel="stylesheet">
    body {
      margin: 0;
      padding: 0;
      height: 100%;
    }
    main {
      display: flex;
      flex-direction: column;
      align-items: stretch;
    }
    #header {
      height: 100px;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
      border-bottom: 1px solid grey;
    }
    #container {
      height: 300px;
    }

    #header div {
      width: 50%;
      height: 100%;
      text-align: right;
      padding-right: 20px;
      padding-top: 70px;
    }

    #header div a {
      font-size: 25px;
      padding: 8px;
      text-decoration: none;
      color: black
    }

    #header div a:hover {
      color: grey;
    }

    ul {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    li {
      width: 50%;
      text-decoration: none;
      padding: 12px;
      border: 1px solid #eee;
      list-style-type: none;
      background-color: #eee;
      margin-bottom: 12px;
    }

    li:hover {
      cursor: pointer;
      background-color: #ddd;
    }

    #post-header {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      border-bottom: 1px solid white;
    }

    #post-header span {
      color: #888;
      padding-top: 10px;
    }

    #post-header h4 {
      font-size: 20px;
    }

    #post-body {
      padding-top: 10px;
    }
  </style>
</head>
<body>
  <main>
    <section id="header">
      <div>
        <a href="newpost.php">New post</a>
      </div>
      <div>
        <a href="signout.php" style="">(<?= $username; ?>)Sign out</a>
      </div>
    </section>
    <section id="container">
      <ul>
      <?php foreach($blogs as $blog): ?>
          <li>
            <div id="post-header">
              <h4><?= $blog['title'];?></h4>
              <span>Creation Date: <?= $blog['creation_date'];?></span>
            </div>
            <div id="post-body"><?= $blog['content']; ?></div>
            <div style="margin-top: 15px; text-align: right">
              <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) . "?edit=1&title=" . $blog['title'] . "&content=" . $blog['content'] . "&id=" . $blog['id'];?>">Edit</a>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </section>
  </main>
</body>
</html>

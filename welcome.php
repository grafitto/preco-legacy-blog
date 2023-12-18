<?php
session_start();

$id = $_SESSION['id'];
print($id);
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
  </style>
</head>
<body>
  <main>
    <section id="header">
      <div>
        <a href="newblog.php">New blog</a>
      </div>
      <div>
        <a href="signout.php" style="">Sign out</a>
      </div>
    </section>
    <section id="container">
    </section>
  </main>
</body>
</html>

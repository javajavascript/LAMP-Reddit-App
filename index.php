<!doctype html>
<html>
  <head>
    <title>Discussion!</title>
    <style>
      textarea {
        resize: none;
        width: 300px;
        height: 100px;
      }
    </style>
  </head>
  <body>
    <h1>Discussion!</h1>

    <form method="post" action="save.php">
      Username:
      <br>
      <input type="text" name="username">
      <br>
      Title:
      <br>
      <input type="text" name="title">
      <br>
      Question:
      <br>
      <textarea name="question"></textarea>
      <br>
      <input type="submit">
    </form>

    <?php

    print "<a href=index.php?sortASC=true>Sort By Time Ascending</a>";
    print "<br>";
    print "<a href=index.php?sortDESC=true>Sort By Time Descending</a>";

    if ($_GET["error"]) {
      print "<p>Fill out the form!<p>";
    }
    if ($_GET["success"]) {
      print "<p>Message saved!<p>";
    }

    ?>

    <hr>

    <form method="POST" action="search.php">
    Search Messages:
    <br>
    <input type="text" name="search">
    <br>
    <input type="submit" value="Submit">
    </form>

    <hr>

    <?php

      // connect to databases
      include('config.php');

      date_default_timezone_set('America/New_York');

      // grab all posts
      if ($_GET["search"] && $_GET["keyword"]) {
        $keyword = $_GET["keyword"];
        $sql = "SELECT * FROM posts WHERE title LIKE '%$keyword%' OR body LIKE '%$keyword%' OR name LIKE '%$keyword%'";
      }
      else if ($_GET["sortASC"]) {
        $sql = "SELECT * FROM posts ORDER BY time ASC";
      }
      else if ($_GET["sortDESC"]) {
        $sql = "SELECT * FROM posts ORDER BY time DESC";
      }
      else {
        $sql = "SELECT * FROM posts";
      }
      $result = $db->query($sql); 

      //check if no results
      $counter = 0;

      // iterate over posts and display
      while ($row = $result->fetchArray()) {
        $counter++;
        ?>

        <div>
          <p>Username: <?php print $row['name']; ?></p>
          <p>Title: <?php print $row['title']; ?></p>
          <p>Time: <?php

          $pretty_time = date("F j, Y, g:i a", $row['time']);
          print $pretty_time;

          print " - <a href=view.php?id=" . $row['id'] . ">expand</a>";
          ?></p>

        </div>
        <hr>



        <?php
      }

      //if no results
      if ($counter == 0) {
        print "<div>No posts</div>";
      }



     ?>

  </body>
</html>

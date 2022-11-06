<?php

  include('config.php');

  date_default_timezone_set('America/New_York');

  // grab the ID of the question
  // comes from index.php
  // comes form searchcomment.php
  $id = $_GET['id'];

  // run a query against the database that grabs this post
  $sql = "SELECT * FROM posts WHERE id = $id";

  $results = $db->query($sql); 

  while ($row = $results->fetchArray()) {
    // print "ID: $row[0] <br>";
    print "Username: $row[3] <br>";
    print "Title: $row[1] <br>";
    print "Description: $row[2] <br>";
    $pretty_time = date("F j, Y, g:i a", $row[4]);
    print "Time: $pretty_time";
  }

?>

<br>
<br>
<form method="POST" action="savecomment.php?id=<?php print $id; ?>">
  <!-- the comment needs to have the post/question id, so we send that through the server but hide it from the user -->
  <input type="hidden" name="id" value=<?php print $id; ?> readyonly></input>
  Username:
  <br>
  <input type="text" name="username">
  <br>
  Comment:
  <br>
  <textarea name="comment"></textarea>
  <br>
  <input type="submit">
</form>

<hr>

<form method="POST" action="searchcomment.php?id=<?php print $id; ?>">
  Search Messages:
  <br>
  <input type="text" name="search">
  <br>
  <input type="submit" value="Submit">
</form>

<hr>

<?php

  //need to pass id to sort!
  print "<a href=view.php?sortASC=true&id=$id>Sort By Time Ascending</a>";
  print "<br>";
  print "<a href=view.php?sortDESC=true&id=$id>Sort By Time Descending</a>";

  if ($_GET["error"]) {
    print "<p>Fill out the form!<p>";
  }
  if ($_GET["success"]) {
    print "<p>Message saved!<p>";
  }

  // grab all posts

  //make sure to say no search results if empty

  //DO post_id = $id because we want the id of the post/question, all comments are under one post/question
  //DO NOT do id = $id because that is the id of the comment
  if ($_GET["search"] && $_GET["keyword"]) {
    $keyword = $_GET["keyword"];
    $sql2 = "SELECT * FROM comments WHERE post_id = $id AND body LIKE '%$keyword%' OR name LIKE '%$keyword%'";
  }
  else if ($_GET["sortASC"]) {
    $sql2 = "SELECT * FROM comments WHERE post_id = $id ORDER BY time ASC";
  }
  else if ($_GET["sortDESC"]) {
    $sql2 = "SELECT * FROM comments WHERE post_id = $id ORDER BY time DESC";
  }
  else {
    $sql2 = "SELECT * FROM comments WHERE post_id = $id";
  }
  $result = $db->query($sql2); 

  //check if no results
  $counter = 0;

  // iterate over posts and display
  while ($row = $result->fetchArray()) {
    $counter++;
    ?>

    <div>
      <p>Username: <?php print $row['name']; ?></p>
      <p>Comment: <?php print $row['body']; ?></p>
      <p>Time: <?php

      $pretty_time = date("F j, Y, g:i a", $row['time']);
      print $pretty_time;
      ?></p>

    </div>
    <hr>



    <?php
  }

  //if no results
  if ($counter == 0) {
    print "<div>No comments</div>";
  }



?>
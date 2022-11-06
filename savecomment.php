<?php

  // grab data from form
  $username = $_POST['username'];
  $comment = $_POST['comment'];
  $id = $_POST['id'];

  // connect to database!
  include('config.php');

  // validation
  if (!$username || !$comment) {
    header("Location: view.php?error=true");
    exit();
  }

  // if everything is OK, save the record into
  // the database
  $now = time();

  // make sure it's post_id not id
  $sql = "INSERT INTO comments (post_id, body, name, time) VALUES ('$id', '$comment', '$username', $now)";
  $db->query($sql);

  header("Location: view.php?success=true&id=$id");
  exit();
 ?>

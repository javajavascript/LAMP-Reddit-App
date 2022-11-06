<?php

  // grab data from form
  $username = $_POST['username'];
  $title = $_POST['title'];
  $question = $_POST['question'];

  // connect to database!
  include('config.php');

  // validation
  if (!$username || !$title || !$question) {
    header("Location: index.php?error=true");
    exit();
  }

  // if everything is OK, save the record into
  // the database
  $now = time();

  $sql = "INSERT INTO posts (title, body, name, time) VALUES ('$title', '$question', '$username', $now)";
  $db->query($sql);

  // send them back to index.php
  header("Location: index.php?success=true");
  exit();

  //To view and create sqlite3 files, do the following:
  //cd into the database folder
  //must have sqlite (for Mac) or sqlite3.exe (for PC) installed
  //.\sqlite3 (for PC) or ./sqlite3
  //.open dicussion.db
  //CREATE TABLE posts (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT, body TEXT, name TEXT, time INTEGER);
  //CREATE TABLE comments (id INTEGER PRIMARY KEY AUTOINCREMENT, post_id INTEGER, body TEXT, name TEXT, time INTEGER);
  //select * from posts;
  //select * from comments;
  //type control C to quit 

  //How to upload to i6
  //Open powershell on windows
  //ssh dl4422@i6.cims.nyu.edu
  //chmod 777 databases (the folder itself)
  //chmod 777 database.txt or database.db (the file itself)

 ?>

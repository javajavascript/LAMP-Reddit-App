<?php

  include('config.php');

  $keyword = $_POST['search'];
  $id = $_GET['id'];

  header("Location: view.php?search=true&keyword=$keyword&id=$id");
  exit();

?>
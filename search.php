<?php

  include('config.php');

  $keyword = $_POST['search'];

  header("Location: index.php?search=true&keyword=$keyword");
  exit();

?>
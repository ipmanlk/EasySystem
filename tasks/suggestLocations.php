<?php

if (isset($_GET['location']) && !empty($_GET['location'])) {
  require_once '../setup/config.php';
  $location = trim($_GET['location']) . '%';

  $stmt = mysqli_prepare($link, "SELECT location FROM item_delivered WHERE location LIKE ? ORDER BY location LIMIT 4");
  mysqli_stmt_bind_param($stmt, "s", $location);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $locations = [];

  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
      $locations[] = $row['location'];
    }
  }

  mysqli_stmt_close($stmt);
  mysqli_close($link);

  echo (json_encode($locations));
}

?>

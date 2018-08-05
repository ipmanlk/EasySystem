<?php

if (isset($_GET['itemID']) && !empty($_GET['itemID'])) {
  require_once '../setup/config.php';
  $itemID = trim($_GET['itemID']) . '%';

  $stmt = mysqli_prepare($link, "SELECT itemID FROM item_stock WHERE itemID LIKE ? ORDER BY itemID LIMIT 4");
  mysqli_stmt_bind_param($stmt, "s", $itemID);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $itemIDs = [];

  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_array($result)) {
      $itemIDs[] = $row['itemID'];
    }
  }

  mysqli_stmt_close($stmt);
  mysqli_close($link);

  echo (json_encode($itemIDs));
}

?>

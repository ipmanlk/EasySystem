<?php
// 1 - all done
// 2 - item ID duplicate
// 3 - input details are missing
require_once 'checkSession.php';
if (isset($_GET['itemID']) && !empty($_GET['itemID'])) {
  require_once '../setup/config.php';
  $itemID = trim($_GET['itemID']);
  $stmt = mysqli_prepare($link, "SELECT * FROM item_stock WHERE itemID=?");
  mysqli_stmt_bind_param($stmt, "s", $itemID);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $itemData = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $itemData[] = $row;
  }
  mysqli_stmt_close($stmt);
  mysqli_close($link);

  echo (json_encode($itemData));
} else {
  echo "3";
}

?>

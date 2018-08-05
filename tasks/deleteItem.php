<?php
// 1 - all done
// 2 - item ID duplicate
// 3 - input details are missing
// 4 - error
if (isset($_GET['itemID']) && !empty($_GET['itemID'])) {
  require_once '../setup/config.php';
  $itemID = trim($_GET['itemID']);

  $stmt = mysqli_prepare($link, "DELETE FROM item_stock WHERE itemID=?");
  mysqli_stmt_bind_param($stmt,'s',$itemID);
  $result = mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  mysqli_close($link);

  if ($result == TRUE) {
    echo "1";
  } else {
    echo "4";
  }

} else {
  echo "3";
  exit();
}
?>

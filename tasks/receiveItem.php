<?php
// 1 - all done
// 2 - item ID duplicate
// 3 - input details are missing
// 4 - error
if (isset($_POST['receiveItemID']) && !empty($_POST['receiveItemID']) && isset($_POST['receiveQty']) && !empty($_POST['receiveQty'])) {
  require_once '../setup/config.php';
  $itemID = trim($_POST['receiveItemID']);
  $qty = trim($_POST['receiveQty']);

  $stmt = mysqli_prepare($link, "SELECT qty FROM item_stock WHERE itemID=?");
  mysqli_stmt_bind_param($stmt,'s',$itemID);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $stockQty = (mysqli_fetch_array($result))['qty'];
  mysqli_stmt_close($stmt);

  $newQty = $stockQty + $qty;

  $stmt = mysqli_prepare($link, "UPDATE item_stock SET qty=? WHERE itemID=?");
  mysqli_stmt_bind_param($stmt,'ds',$newQty, $itemID);
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

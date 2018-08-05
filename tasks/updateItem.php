<?php
// 1 - all done
// 2 - item ID duplicate
// 3 - input details are missing
// 4 - error
if (isset($_POST['itemID']) && !empty($_POST['itemID']) && isset($_POST['qty']) && !empty($_POST['qty'])) {
  require_once '../setup/config.php';
  $itemID = $_POST['itemID'];
  $itemDes = $_POST['itemDes'];
  $stockingUM = $_POST['stockingUM'];
  $partNum = $_POST['partNum'];
  $qty = $_POST['qty'];

  $stmt = mysqli_prepare($link, "UPDATE item_stock SET itemID=?, itemDes=?, stockingUM=?, partNum=?, qty=? WHERE itemID=?");
  mysqli_stmt_bind_param($stmt,'ssssds',$itemID, $itemDes, $stockingUM, $partNum, $qty, $itemID);
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

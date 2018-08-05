<?php
// 1 - all done
// 2 - item ID duplicate
// 3 - input details are missing

if (isset($_POST['itemID']) && !empty($_POST['itemID']) && isset($_POST['qty']) && !empty($_POST['qty'])) {
  require_once '../setup/config.php';
  $itemID = trim($_POST['itemID']);
  $itemDes = trim($_POST['itemDes']);
  $stockingUM = trim($_POST['stockingUM']);
  $partNum = trim($_POST['partNum']);
  $qty = trim($_POST['qty']);

  $stmt = mysqli_prepare($link, "SELECT itemID FROM item_stock WHERE itemID=?");
  mysqli_stmt_bind_param($stmt,'s',$itemID);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) > 0) {
    echo "2";
    exit();

  } else {
    $stmt = mysqli_prepare($link, "INSERT INTO item_stock VALUES (?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, "ssssd", $itemID,$itemDes,$stockingUM,$partNum,$qty);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo "1";
    mysqli_close($link);
  }

} else {
  echo "3";
  exit();
}

?>

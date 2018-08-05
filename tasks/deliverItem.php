<?php
// 1 - all done
// 2 - item ID does not exist
// 3 - input details are missing
// 4 - stock qty is low
require_once 'checkSession.php';
if (isset($_POST['itemID']) && !empty($_POST['itemID']) && isset($_POST['qty']) && !empty($_POST['qty'])) {
  require_once '../setup/config.php';
  $itemID = trim($_POST['itemID']);
  $qty = trim($_POST['qty']);
  $dNote = trim($_POST['dNote']);
  $mrn = trim($_POST['mrn']);
  $location = trim($_POST['location']);


  $stmt = mysqli_prepare($link, "SELECT itemID FROM item_stock WHERE itemID=?");
  mysqli_stmt_bind_param($stmt,'s',$itemID);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) == 0) {
    mysqli_stmt_close($stmt);
    echo "2";
    exit();

  } else {
    $stmt = mysqli_prepare($link, "SELECT qty FROM item_stock WHERE itemID=?");
    mysqli_stmt_bind_param($stmt,'s',$itemID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $stockQty = (mysqli_fetch_array($result))['qty'];
    mysqli_stmt_close($stmt);

    if ($qty <= $stockQty) {
      //create record in item deliverd
      $stmt = mysqli_prepare($link, "INSERT INTO item_delivered(itemID, dNote, mrn, location, qty) VALUES (?,?,?,?,?)");
      mysqli_stmt_bind_param($stmt, "ssssd", $itemID,$dNote,$mrn,$location,$qty);
      $result = mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      //update stock
      $stmt = mysqli_prepare($link, "UPDATE item_stock SET qty=? WHERE itemID=?");
      $currentQty = $stockQty - $qty;
      mysqli_stmt_bind_param($stmt,'ds',$currentQty, $itemID);
      $result = mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      //close connection
      mysqli_close($link);

      echo "1";

    } else {
      echo "4";
      exit();
    }

  }

} else {
  echo "3";
  exit();
}

?>

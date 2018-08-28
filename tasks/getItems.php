<?php
require_once '../setup/config.php';
$stmt = mysqli_prepare($link, "SELECT * FROM item_stock");
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$itemData = [];
while ($row = mysqli_fetch_assoc($result)) {
  $itemData[] = $row;
}
mysqli_stmt_close($stmt);
mysqli_close($link);

echo (json_encode($itemData));

?>

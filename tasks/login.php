<?php

require_once '../setup/config.php';

if (isset($_POST['pwd']) && !empty($_POST['pwd']) && isset($_POST['uname']) && !empty($_POST['uname'])) {
  $pwd = $_POST['pwd'];
  $username = $_POST['uname'];
  $stmt = mysqli_prepare($link, "SELECT password FROM user WHERE username=?");
  mysqli_stmt_bind_param($stmt,'s', $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  mysqli_stmt_close($stmt);
  mysqli_close($link);

  if (mysqli_num_rows($result) == 1) {
    $hash = (mysqli_fetch_array($result))['password'];
    if (password_verify($pwd, $hash)) {
      session_start();
      $_SESSION['username'] = $username;
      echo "1";
    } else {
      echo "2";
    }
  } else {
    echo "2";
  }

}

?>

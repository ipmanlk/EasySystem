<?php

require_once '../setup/config.php';

if (isset($_POST['pwd']) && !empty($_POST['pwd'])) {
  $pwd = $_POST['pwd'];
  $stmt = mysqli_prepare($link, "SELECT password FROM user WHERE username=?");
  $username = "ShaNiraj";
  mysqli_stmt_bind_param($stmt,'s', $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $hash = (mysqli_fetch_array($result))['password'];
  mysqli_stmt_close($stmt);
  mysqli_close($link);

  if (password_verify($pwd, $hash)) {
    session_start();
    $_SESSION['username'] = "ShaNiraj";
    echo "1";
  } else {
    echo "2";
  }
}

?>

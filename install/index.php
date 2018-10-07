<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <!--
  This is a simple install script for Easy System.
  I wrote this in a hurry. So, code may look messy.
  Really sorry about that. Trust me, you actually
  don't need this to get this project up & running!.
-->
<meta charset="utf-8">
<title>Install EasySystem</title>
<link rel="stylesheet" href="../res/css/bootstrap.min.css">
<style>
<?php if (($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['submit']))) {echo ".container {display:none;}";} ?>
li { font-size: 20px; font-weight: bold;}
h2 { color: blue;}
.good { color: green ;}
.bad  { color: red; }
</style>
</head>
<body>
  <?php
  if (($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['submit']))) {
    $server = $_POST['server'];
    $db_name = $_POST['dbname'];
    $db_user = $_POST['dbuser'];
    $db_pass = $_POST['dbpass'];
    $login_user = $_POST['loginuser'];
    $login_pass = $_POST['loginpass'];

    echo "<h2><u>Output</u></h2><ol>";

    // connect to database
    $link = mysqli_connect($server, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()){
      echo '<li>Connect to database - <span class="bad">failed!</span> : ' . mysqli_connect_error() . '</li>';
      exit();
    } else {
      echo '<li>Connect to database - <span class="good">done!</span></li>';
    }

    //create easy system user
    $login_pass = password_hash($login_pass, PASSWORD_DEFAULT);

    //reset user table
    if (mysqli_query($link, "TRUNCATE TABLE user")) {
      echo '<li>Empty user table - <span class="good">done!</span></li>';
    } else {
      echo '<li>Empty user table - <span class="bad">failed!</span></li>';
    }

    //create new user
    if (mysqli_query($link, "INSERT INTO user(username,password) VALUES('$login_user','$login_pass')")) {
      echo '<li>Insert new user - <span class="good">done!</span></li>';
    } else {
      echo '<li>Insert new user - <span class="bad">failed!</span></li>';
    }

    //write config file
    $config_file = fopen("../setup/config.php", "w") or die("Unable to open config file!");
    $txt = '<?php' ."\n" . 'define("DB_SERVER", "'. $server . '");'."\n" .'define("DB_USERNAME", "' . $db_user . '");'."\n" .'define("DB_PASSWORD", "' . $db_pass . '");' . "\n" . 'define("DB_NAME", "' . $db_name . '");'."\n\n" .'$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);'."\n\n" .'if ($link === false) {die("ERROR: Could not connect." . mysqli_connect_error());}' . "\n" . '?>';
    fwrite($config_file, $txt);
    fclose($config_file);
    echo '<li>Setup config file - <span class="good">done!</span></li></ol>';

    echo "<h3>Everything is done!. Please delete the <i>install</i> directory from this project!</h3>";

    mysqli_close($link);
  }
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-4">
        <h1>EasySystem Installer</h1>
        <hr>
        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">
          <div class="alert alert-dark">
            <ol>
              <li>Creata a database manually (Using phpmyadmin or commandline).</li>
              <li>Import '<strong>easysystem.sql</strong>' in <strong>db directory</strong> to that database (Using phpmyadmin or any other method).</li>
              <li>Fill the form below and click the install button.</li>
            </ol>
          </div>
          <fieldset>
            <legend>Database setup</legend>
            <div class="alert alert-danger">
              <div class="form-group">
                <label for="server">Server (HOST):</label>
                <input class="form-control" type="text" name="server" id="server" value="localhost">
              </div>
              <div class="form-group">
                <label for="dbname">Database Name:</label>
                <input class="form-control" type="text" name="dbname" id="dbname" value="" autofocus>
              </div>
              <div class="form-group">
                <label for="dbuser">Database User:</label>
                <input class="form-control" type="text" name="dbuser" id="dbuser" value="">
              </div>
              <div class="form-group">
                <label for="dbpass">Database User's Password:</label>
                <input class="form-control" type="password" name="dbpass" id="dbpass" value="">
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>EasySystem user login setup</legend>
            <div class="alert alert-primary">
              <div class="form-group">
                <label for="loginusername">Login Username:</label>
                <input class="form-control" type="text" name="loginuser" id="loginuser" value="">
              </div>
              <div class="form-group">
                <label for="loginpass">Login Password:</label>
                <input class="form-control" type="password" name="loginpass" id="loginpass" value="">
              </div>
            </div>
          </fieldset>
          <input type="submit" class="btn btn-primary btn-block mb-4" name="submit" value="submit">
        </form>
      </div>
    </div>
  </div>
</body>
</html>

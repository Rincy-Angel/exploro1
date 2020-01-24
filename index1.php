<?php
  date_default_timezone_set('Europe/Copenhagen');
  include 'dbh.inc.php';
  include 'comments.inc.php';
  session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF_8">
  <title>COmment</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>EXCERCISE AND FEEDBACK</h1>
<?php
echo "<form method='POST' action='".getLogin($conn)."'>
    <input type='text' name='uid'><br><br>
    <input type='password' name='pwd'><br><br>
    <button type='submit' name='loginSubmit'>LOGIN</button>
  </form>";
  echo "<form method='POST' action='".userLogout()."'>
  <button type='submit' name='logoutSubmit'>LOGOUT</button>
  </form>";
    if(isset($_SESSION['id'])){
      echo "You Are Loged in";
    }
    else{
      echo "You Are NOT Loged in";
    }
  ?>
  <br><br>
  <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY?autoplay=1" frameborder="0" allowfullscreen></iframe><br>
<?php
if(isset($_SESSION['id'])){
echo "<form method='POST' action='".setComments($conn)."'>
  <input type='hidden' name='uid' value='".$_SESSION['id']."'>
  <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
  <textarea name='message'></textarea><br>
  <button type='submit' name='commentSubmit'>Comment</button>
  </form>";
}else{
  echo "You need to login to comment
  <br><br>";
}
  getComments($conn);
  ?>
</body>
</html>

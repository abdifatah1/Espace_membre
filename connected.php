
<?php
session_start();
include 'db.php';
// if there is no activity redirecto to logout.php to destroy the session
if(isset($_SESSION)){
  if((time()-$_SESSION['last_login_timestamp']) > 60){
    header('location:logout.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <!-- refresh after a certain of time -->
  <meta http-equiv="refresh" content="61" >
  <meta charset="utf-8">
  <title>Profile</title>
  <link rel="stylesheet" href="style.css" media="screen" title="no title">

</head>
<body>
  <?php
  // if connected show me some details
  if($_SESSION){
    echo "<h1>Bienvenue  ".$_SESSION['nom'].',</h1><br>'. '<h2>Votre compte a été crée :
    '.$_SESSION['created']. '<br> Votre mail est :' .$_SESSION['mail'].'<br> Vous avez : '.$_SESSION['age'].' ans!'." </h2>";

  }
  // if not redirect to connection.php
  else{
    header("Location:connection.php");
  }
  ?>
  <form class="" action="logout.php" method="post">
    <input type="submit" name="submit" value="logout">
  </form>
</body>
</html>

<?php
session_start();

include "db.php";
?>
<html>
<head>
  <meta charset="utf-8" />
  <title>Login</title>
  <link rel="stylesheet" href="style.css" media="screen" title="no title">
</head>
<body>
  <div class="container">


    <h2>Se connecter </h2>
    <form method="POST" action="">
      <input type="email" name="mailconnect" value="" placeholder="Votre email" /><br /><br />
      <input type="password" name="passconnect" placeholder="votre mote de passe" /><br /><br />
      <input type="submit"  name="connecter" value="Connection" />
      <input type="submit"  name="inscription" value="Inscription" />
    </form>
  </div>
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// if someone is connected redirect to connected page
if($_SESSION){
  echo "<h2>Vous etes Connecté en tant que ".$_SESSION['nom']."</h2>";
  header("refresh:3; url=connected.php");
}
if(isset($_POST['inscription'])){
  header ("Location: inscription.php");

}
if(isset($_POST['connecter'])){
  $_SESSION['last_login_timestamp']= time();

  // get mail and password from the input
  $mailconnect = htmlspecialchars($_POST['mailconnect']);
  $passconnect = htmlspecialchars(sha1($_POST['passconnect']));

  // if mail and password not empty and match
  if(!empty($_POST['mailconnect']) AND !empty($_POST['passconnect']))
  {

    $user = $db->prepare("SELECT * FROM membre WHERE mail = ? AND pass = ?");
    $user->execute(array($mailconnect,$passconnect));
    $usertrue = $user->rowCount();

    if($usertrue){
      $userinfo = $user->fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['nom'] = $userinfo['nom'];
      $_SESSION['mail'] = $userinfo['mail'];
      $_SESSION['age'] = $userinfo['age'];
      $_SESSION['created'] = $userinfo['created'];

      header ("Location: connected.php");

    }else{
      echo "Incorrect email or password please try again !";
    }
  } else
  {
    echo "Tous les champs doivent etre remplir";
  }

}

?>

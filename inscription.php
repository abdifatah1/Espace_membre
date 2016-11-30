<?php
session_start();
include "db.php";
?>
<html>
<head>
  <meta charset="utf-8" />
  <title>inscription</title>
  <link rel="stylesheet" href="style.css" media="screen" title="no title">

</head>
<body>
  <div class="container">

  <h2>Inscription</h2>
  <form method="POST" action="" enctype='multipart/form-data'>
    <input type="text" name="nom" value="" placeholder="Votre identifiant" /><br />
    <input type="email" name="mail" value="" placeholder="Votre email" /><br />
    <input type="number" name="age" value="" placeholder="Votre age" /><br />
    <input type="password" name="pass" placeholder="votre mote de passe" /><br />
    <input type="password" name="pass2" placeholder="votre mote de passe" /><br />
    <input type="submit"  name="inscription" value="Inscription" class="submit" />
  </form>
  
</div>
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// if inscription is clicked store the data to variables
if(isset($_POST['inscription'])){
  // get all data from input using post
  $nom = htmlspecialchars($_POST['nom']);
  $mail = htmlspecialchars($_POST['mail']);
  $age = htmlspecialchars($_POST['age']);
  $pass = sha1($_POST['pass']);
  $pass2= sha1($_POST['pass2']);
  // $img_name= htmlspecialchars($_POST['img']);
  $created= date("Y/m/d H:i:s");


  // Check if email is valide
  if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail))
  {

    // check if the password is matched
    if($pass === $pass2)
    {
      // check if user exist
      $query = $db->prepare("SELECT * FROM membre WHERE nom = ?");
      $query->execute(array($nom));
      $userexist = $query->rowCount();
      // check if the mail is used
      $query2 = $db->prepare("SELECT * FROM membre WHERE mail = ?");
      $query2->execute(array($mail));
      $mailexist = $query2->rowCount();
      // if username exist show me this error

      if($userexist)
      {
        echo "votre identifiant exist deja !";
      }
      elseif($mailexist)
      {
        echo "Votre mail a été utilisé !";
      }
      // if not exist insert the new user into the database
      else
      {
        $new_user = $db->prepare("INSERT INTO membre (nom,mail,pass,age,created)VALUES(?,?,?,?,?)");
        $new_user->execute(array($nom,$mail,$pass,$age,$created));

        if($new_user)
        {
          echo "inscription validé";
          header( "refresh:3;url=connection.php" );
        }else{
          echo "Reessayer s'il vous plait";
        }
      }
    }
    else
    {
      echo "les mots de passes ne sont pas identiques";
    }
  }
  else
  {
    echo 'L\'adresse ' . $mail. ' n\'est pas valide, recommencez !';
  }
}

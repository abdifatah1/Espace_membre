<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class users
{
  function connection(){

    // try {
    // $db = new PDO("mysql:host=localhost;dbname=info;charset=utf8",'abdifatah','faaiza');
    //
    // } catch (Exception $e) {
    // echo "database not connected";
    // }
    $db = mysql_connect('localhost','abdifatah','faaiza');
    mysql_select_db('info',$db);
  }
  function show(){
    // $user = $db->prepare("SELECT * FROM membre?");

    $select = "SELECT * FROM membre";
    $req = mysql_query($select);
    while ($data = mysql_fetch_assoc($req)) {
      $table[]= $data;
    }
    return $table;
  }

}

$some = new users();
$some->connection();

$somes = $some->show();
foreach ($somes as $value) {
  echo $value['nom'];
}

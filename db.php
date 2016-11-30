<?php

try {
$db = new PDO("mysql:host=localhost;dbname=info;charset=utf8",'abdifatah','faaiza');

} catch (Exception $e) {
echo "database not connected";
}

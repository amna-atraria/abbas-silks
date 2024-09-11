<?php
$host="localhost";
$username="root";
$pass="";
$db="office_data";

$conn= new mysqli($host,$username,$pass,$db);


if (!$conn) {
        echo "Error";
}
?>
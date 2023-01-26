<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "registration";

$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn){
    die("Connection was not established because of ".mysqli_connect_error());
}
?>
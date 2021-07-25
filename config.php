<?php

$server = "localhost";
$dbuser = "root";
$dbpass = "292216";
$database = "file_upload";

$conn = mysqli_connect($server, $dbuser, $dbpass, $database);

if(!$conn){
    die("<script>alert('deu errado')</script>");
}

$base_url = "http://localhost/Download&Upload/";

?>
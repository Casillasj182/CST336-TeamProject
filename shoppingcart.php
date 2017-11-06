<?php
session_start();
$host = "localhost";
$dbname = "project";
$username = "root";
$password = "";

$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
<html>
    <head>
        <title>Shopping Cart</title>
        <style>
 body{
                width:800px;
                margin:0 auto;
                text-align:center;
        }
        </style>
    </head>
    <body>
        <center><h1> Shopping Cart </h1></center> 
    <form>
    </form>
    </body>
</html>
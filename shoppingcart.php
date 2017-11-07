<?php
session_start();
include '../dbConnection.php';
$conn = getDatabaseConnection();

$_SESSION['cartItems'] = array();
$_SESSION['itemNum'] = 0;
function displayCart() {
    global $conn;
    $sql = "SELECT movieName 
            FROM movie 
            WHERE movieId=" .$_GET['movieId'];
    $statement = $conn->prepare($sql);
    $statement->execute();
    $movies = $statement->fetchAll(PDO::FETCH_ASSOC);
    //print_r($movies);
    return $movies;
}
function addToCart()
{
    //$_SESSION['cartItems'] = array();
    global $newItem;
    $newItem = displayCart();
    //echo $newItem[0]['movieName'];
    //array_push($_SESSION['cartItems'],$newItem);
    if($_SESSION['itemNum'] != 0)
    {
        $_SESSION['cartItems'][] = $newItem;
    }
    else
    {
        $_SESSION['cartItems'][$_SESSION['itemNum']] = $newItem;
    }
    $_SESSION['itemNum']++;
    //echo $item;
    //return $_SESSION['cartItems'][0][0]['movieName'];
    //return $_SESSION[0];
}

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
        <center>
            <h1> Shopping Cart </h1>
            <?php
              
                addToCart();
                for($i = 0;$i<count($_SESSION['cartItems']);$i++)
                {
                    echo "Movie Title: ". $_SESSION['cartItems'][$i][0]['movieName'] . "<br>";
                }
                $item++;
            ?>
        </center> 
        
    <form>
    </form>
    </body>
</html>
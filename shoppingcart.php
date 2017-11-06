<div>
<?php


function displayShoppingCart() {
    //echo "<title> Device Checkout </title>";
    
    include '../dbConnection.php';
    $conn = getDatabaseConnection();
    
    $sql = "SELECT * 
            FROM `movies` 
            NATURAL JOIN director
            NATURAL JOIN genre
            WHERE movieId = :movieId";
    
    $namedParam = array(":movieId"=>$_GET['movieId']);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParam);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<div>";
    foreach ($records as $record) {
        
        echo  $record['movieName'] . " " . $record['directorName'] ." " . $record['genreName'] . "<br />";
        
    }
     echo "</div>";
    
}

?>
</div>

<!DOCTYPE html>
<html>
    <head>
        <div>
        <title> Shopping Cart</title>
    </head>
    <body>
        
        <h2> Shopping Cart </h2>


        <?=displayShoppingcart()?>

    </body>
    </div>
</html>
<?php

include '../../dbConnection.php';

$conn = getDatabaseConnection();

function getGenre() {
    global $conn;
    $sql = "SELECT genreName
            FROM `genre` 
            ORDER BY genreName";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<option> "  . $record['genreName'] . "</option>";
    }
}


function displayMovies(){
    global $conn;
    
    $sql = "SELECT * FROM movies WHERE 1 ";
    
    
    if (isset($_GET['submit']))
    {
        
        $namedParameters = array();
     
       
         
        if (!empty($_GET['name'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND name LIKE :name"; //using named parameters
            $namedParameters[':name'] = "%" . $_GET['name'] . "%";

         }     
         
           
        if (!empty($_GET['releaseyear'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND release_year LIKE :releaseyear"; //using named parameters
            $namedParameters[':releaseyear'] = "%" . $_GET['release_year'] . "%";
         }     
         
       
        
        
    }//endIf (isset)
    
    //If user types a deviceName
     //   "AND deviceName LIKE '%$_GET['deviceName']%'";
    //if user selects device type
      //  "AND deviceType = '$_GET['deviceType']";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
     foreach ($records as $record) {
        
        echo  $record['name'] . " " . "  ". $record['genre'] .
              "<a target='shoppingcart' href='shoppingcart.php?movieId=".$record['movieId']."'> Shopping Cart </a> <br />";
        
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Movie Shop </title>
    </head>
    <body>
          <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <div>
        <h1> Movie Catalog Shop </h1>
        
        <form>
            Movie Names: <input type="text" name="name" placeholder="name"/>
            Genre: 
            <select name="gname">
                <option value="">Select One</option>
                <?=getGenre()?>
            </select>
            
           
            
            <br>
            Order by:
            <input type="radio" name="orderBy" id="orderByReleaseyear" value="releaseyear"/> 
             <label for="releaseyear"> Release Year </label>
            <input type="radio" name="orderBy" id="orderByLength" value="length"/> 
             <label for="length"> Movie Length </label>
             <input type="radio" name="orderBy" id="orderByRating" value="rating"/> 
             <label for="rating"> Movie Rating </label>
            
            
            <br></br>
            <input type="submit" value="Search!" name="submit" >
        </form>
        
        
        <hr>
        
        <?=displayMovies()?>
        
        
        
        <iframe name="checkoutHistory" width="400" height="400"></iframe>
        


</div>
    </body>
</html>
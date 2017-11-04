<?php

include '../dbConnection.php';

$conn = getDatabaseConnection();

function getMovieLength() {
    global $conn;
    $sql = "SELECT distinct(length)
            FROM `movie` 
            ORDER BY length";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<option> "  . $record['length'] . "</option>";
    }
}


function displayMovies(){
    global $conn;
    
    $sql = "SELECT * FROM movie WHERE 1 ";
    
    
    if (isset($_GET['submit']))
    {
        
        $namedParameters = array();
     
       
         
        if (!empty($_GET['movieName'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND movieName LIKE :movieName"; //using named parameters
            $namedParameters[':movieName'] = "%" . $_GET['movieName'] . "%";

         }     
         
           
        if (!empty($_GET['release_year'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND release_year LIKE :releaseyear"; //using named parameters
            $namedParameters[':releaseyear'] = "%" . $_GET['release_year'] . "%";
         }     
         
             
        if (!empty($_GET['length'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND length LIKE :length"; //using named parameters
            $namedParameters[':length'] = "%" . $_GET['
            length'] . "%";
         }   
              
        if (!empty($_GET['rating'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND rating LIKE :rating"; //using named parameters
            $namedParameters[':rating'] = "%" . $_GET['
            rating'] . "%";
         }   
           if (!empty($_GET['genreId'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND genreId LIKE :genreId"; //using named parameters
            $namedParameters[':genreId'] = "%" . $_GET['
           genreId'] . "%";
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
        
        echo  $record['movieName'] . " " . $record['length']. "  ". $record['release_year'] 
        . " " . $record['rating'] . " " . $record['genreId'] .
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
            Movie Names: <input type="text" name="movieName" placeholder="movieName"/>
            Movie Length: 
            <select name="length">
                <option value="">Select One</option>
                <?=getMovieLength()?>
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
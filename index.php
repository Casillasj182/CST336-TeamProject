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

function getMovieYear() {
    global $conn;
    $sql = "SELECT distinct(release_year)
            FROM `movie` 
            ORDER BY release_year";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<option> "  . $record['release_year'] . "</option>";
    }
}

function getMovieRating() {
    global $conn;
    $sql = "SELECT distinct(rating)
            FROM `movie` 
            ORDER BY rating";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<option> "  . $record['rating'] . "</option>";
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
  
           $sql .= " AND release_year = :release_year"; //using named parameters
            $namedParameters[':release_year'] =   $_GET['release_year'] ;
         }     
         
             
        if (!empty($_GET['length'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND length = :length"; //using named parameters
            $namedParameters[':length'] =   $_GET['length'] ;
         }   
              
        if (!empty($_GET['rating'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
          
            $sql .= " AND rating = :rating"; //using named parameters
            $namedParameters[':rating'] =   $_GET['rating'] ;
         }   
           if (!empty($_GET['genreId'])) {
            
            //The following query allows SQL injection due to the single quotes
            //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
            $sql .= " AND genreId LIKE :genreId"; //using named parameters
            $namedParameters[':genreId'] = "%" . $_GET['
           genreId'] . "%";
         }   
       if(!empty($_GET['asc']))
       {
             $sql .= "  ORDER BY movieName" . " " . $_GET['asc'];
            //$sql = "SELECT * FROM movie ORDER BY movieName" . " " . $_GET['asc'];
       }
       
     
    
     
      
     
        
    }
    
    
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
     foreach ($records as $record) 
     {
          $url = $record['movieId'];
         echo "<td>" . "<a href='movieInfo.php?movieId=" . $url . "' target='movieInfoFrame'>" . $record['movieName'] . "</a></td>";
           echo "<td>" . $_GET['movieName'] . "</td>";
        echo  $record['movieName'] . " " . $record['length']. "  ". $record['release_year'] 
        . " " . $record['rating'] .
              "<a target='shoppingcart' href='shoppingcart.php?movieId=".$record['movieId']."'> Shopping Cart </a> <br />";
        
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>CSUMB Movie Store</title>
    </head>
    <body>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

          <link href="css/styles.css" rel="stylesheet" type="text/css" />
          <div class="col-md-2"></div>
          <div>
        <h1>CSUMB Movie Store</h1>
        

        <form>
            Movie Names: <input type="text" name="movieName" placeholder="movieName"/>
            <br></br>
            Movie Length: 
            <select name="length">
                <option value="">Select One</option>
                <?=getMovieLength()?>
            </select>
            <br></br>
            
             Release Year: 
            <select name="release_year">
                <option value="">Select One</option>
                <?=getMovieYear()?>
            </select>
            <br></br>
           Movie Rating(1-100): 
            <select name="rating">
                <option value="">Select One</option>
                <?=getMovieRating()?>
            </select>
            
             <br></br>
             Sort by:
          <input type="radio" name="asc" value="ASC" /> Ascending
          <input type="radio" name="asc" value="DESC"/> Descending<br />
            
            
           
          
            <br></br>
            <input type="submit" value="Search for a Movie!" name="submit" >
            
            <br></br>
             <input type ="button" value="Shopping Cart" name="shoppingcart" onclick="location.href='shoppingcart.php'"/>
              <br></br>  
        </form>
        
        
        <hr>
        <div class="col-md-2"></div>
        <div id="movieList" class="col-md-6">

        <?=displayMovies()?>

</div>
 <div id="movieinfo" style = "float:center">
    <iframe src="" width="400" height="400" name="movieinfoFrame"></iframe>
    <br></br>
    <iframe name="shoppingcart" width="400" height="400"></iframe>
</div>
</div>

    </body>
</html>
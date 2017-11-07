<?php

include '../dbConnection.php';

$conn = getDatabaseConnection();

function getMovieLength() 
{
    global $conn;
    $sql = "SELECT distinct(length)
            FROM `movie` 
            ORDER BY length";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) 
    {
        
        echo "<option> "  . $record['length'] . "</option>";
    }
}

function getMovieYear()
{
    global $conn;
    $sql = "SELECT distinct(release_year)
            FROM `movie` 
            ORDER BY release_year";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record)
    {
        
        echo "<option> "  . $record['release_year'] . "</option>";
    }
}

function getMovieRating() 
{
    global $conn;
    $sql = "SELECT distinct(rating)
            FROM `movie` 
            ORDER BY rating";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) 
    {
        echo "<option> "  . $record['rating'] . "</option>";
    }
}


function displayMovies(){
    global $conn;
    
    $sql = "SELECT * FROM movie WHERE 1 ";
    
    
    if (isset($_GET['submit']))
        {
        $namedParameters = array();
     
    if (!empty($_GET['movieName'])) 
        {
  
            $sql .= " AND movieName LIKE :movieName"; 
            $namedParameters[':movieName'] = "%" . $_GET['movieName'] . "%";
        }     
       
    if (!empty($_GET['release_year']))
        {
         
           $sql .= " AND release_year = :release_year";
            $namedParameters[':release_year'] =   $_GET['release_year'] ;
        }     
        
    if (!empty($_GET['length'])) 
        {
       
            $sql .= " AND length = :length"; 
            $namedParameters[':length'] =   $_GET['length'] ;
        }   
              
    if (!empty($_GET['rating'])) 
        {
            $sql .= " AND rating = :rating"; 
            $namedParameters[':rating'] =   $_GET['rating'] ;
        }  
    
    if (!empty($_GET['genreId']))
        {
         
            $sql .= " AND genreId LIKE :genreId"; 
            $namedParameters[':genreId'] = "%" . $_GET['
           genreId'] . "%";
        } 
         
    if(!empty($_GET['asc']))
        {
             $sql .= "  ORDER BY movieName" . " " . $_GET['asc'];
           
        }
    }
    
    
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <table>
        <tr>
            <th>Title</th>
            <th>Length</th>
            <th>Released</th>
            <th>Score</th>
            <th>Shop</th>
        </tr>
    
        
    <?php
     foreach ($records as $record) 
     {
          $url = $record['movieId'];
        echo "<tr>".
        "<td>" . "<a href='movieInfo.php?movieId=" . $url . "' target='movieInfoFrame'>" . $record['movieName'] . "</a></td>".
        "<td> " .  $record['length']. "</td>". 
        "<td> ". $record['release_year'] . "</td>" .
        "<td>" . $record['rating'] . "</td>".
        "<td> <a target='shoppingcart' href='shoppingcart.php?movieId=".$record['movieId']."'> [Add to Cart] </a> <br /> </td>".
        "</tr>";
        
    }
}

?>
</table>
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
            Title: <input type="text" name="movieName" placeholder="type here"/>
            <br></br>
            Length (mins): 
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
               Rating (%): 
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

</div>

    </body>
</html>
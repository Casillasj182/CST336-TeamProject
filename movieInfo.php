<?php
session_start();




include '../dbConnection.php';
$conn = getDatabaseConnection();


function displayUsers() {
    global $conn;
    $sql = "SELECT * 
            FROM movie NATURAL JOIN director NATURAL JOIN genre
            WHERE movieId=" . $_GET['movieId'];
    $statement = $conn->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    //print_r($users);
    return $users;
}


?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
          <link href="css/main.css" rel="stylesheet" type="text/css" />
           <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <center>
        <div>
        <title>Movie Information </title>
    </head>
    <body>
        <div>
<center>
        <h1> Movie Information </h1>
      
        
        <hr>
        
        
            
            
            
        </form>
        
       
        
        <br /><br />
        
        <?php
        
        $users =displayUsers();
        
      foreach($users as $user) {
            
            echo " Movie Name: " . $user['movieName']. "<br> " . ' Movie Length: '  .$user['length'] ." mins". "<br". ' Movie Genre: '  .$user['genreName'] . "<br> " . ' Movie ID: '  .$user['movieId']
            . "<br> " . ' Year of Release: '  .$user['release_year'] . "<br> " . ' Director Name: '.$user['directorName'];
           
          
            
        }
        
      
        ?>
        </div>
        </center>
        </div>
    </body>     
</html>


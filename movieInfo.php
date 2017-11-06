<?php
session_start();




include '../dbConnection.php';
$conn = getDatabaseConnection();


function displayUsers() {
    global $conn;
    $sql = "SELECT * 
    FROM movie AS m 
    INNER JOIN director AS d 
    ON m.movieId = " . $_GET['movieId'];
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    //print_r($users);
    return $users;
}

// function displayDirector() {
//     $sql = "SELECT *
//             FROM director
//             WHERE directorId =" 
// }


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
            
            echo " Movie Name: " . $user['movieName']
            . "<br> " . 
            ' Movie ID: '  .$user['movieId']
            . "<br> " . 
            ' Year of Release: '  .$user['release_year']
            . "</br>" . 
            'Length: ' . $user['length']
            ."<br/>".
            'Rating: ' . $user['rating']
            . "<br/>";
            
           // echo "[<a href= . $user['firstName']";
          // echo "[<a href='updateUser.php?userId=".$user['userId']."'> Update </a> ]";
            
           
           //this is what im trying to make wo
            //echo "[<a href='userinfo.php?variableName=$_GET['variable']".$user['userId']."'> Update </a> ]";
            // echo "<a href='userinfo.php?userId=".$user['userId']."'> . $user['firstName']"'.  </a> ";
           
            
//$name = $user['firstName'] . "  " . $user['lastName'];
           //  echo "<a href='userinfo.php?". "<a href=' . $user['firstName']" i. $_GET['firstName']."'></a> ]";
            //echo "[<a href='deleteUser.php?userId=".$user['userId']."'> Delete </a> ]";
           // echo "<a class='name' href='usernfo.php?userId=".$user['userId']."'> $name </a> ";
          
            
        }
        
        
        ?>
        </div>
        </center>
        </div>
    </body>     
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST["username"];
   $pwd = $_POST["pwd"];

   try {
      require_once "dbh.inc.php"; //require,include,include_once do the sane thing which checks if the file has been included n throws an errror message

      $query = "DELETE FROM users WHERE username = :username AND pwd = :pwd;"; 
      //putting the variables directly in to values is not a good practice cuz users can inject wrong stuff to our database so it is replaced with question marks


      //using none name parameters, the other in which the inputs r inserted matter
      //$stmt = $pdo->prepare($query); //prepared statement, $stmt stands for statement

      //inserting data to the db using name parameters
      $stmt = $pdo->prepare($query);
      
      $stmt->bindparam("username", $username);
      $stmt->bindParam(":pwd", $pwd);
      //$stmt->bindParam(":email", $email);
      $stmt->execute();

      //$stmt->execute([$username, $pwd, $email]);

      //clossing the connection to the db manually to free up resouces
      $pdo = null;
      $stmt = null;

      header("Location: ../index.php");

      die();//it is preferable to use "die" instead of "exit" when you are running a script having a connection
   } catch (PDOException $e) {
      die("Query failed: ".$e->getMessage());
   }
}else{
   header("Location: ../index.php");
} 



if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST["username"];
   $pwd = $_POST["pwd"];

   try {
      require_once "dbh.inc.php";
      //Fetch user details
      $query = "SELECT pwd FROM users WHERE username = :username";      
      $stmt = $pdo->prepare($query);
      $stmt->bindparam(":username", $username);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetches as associative array

      if ($user && password_verify($pwd, $user['pwd'])) {
         //deletes user if password is correct
         $deleteQuery = "DELETE FROM users WHERE username = :username"; 
         $deleteStmt = $pdo->prepare($deleteQuery);
         $deleteStmt->bindparam(":username", $username);
         $deleteStmt->execute();

         //optionally, comfirm the deletion
         if ($deleteStmt->rowCount()>0) {
            echo "User deleted succesfully and ". $deleteStmt->rowCount()." row was affected";
         }  
      }else {
         echo "Invalid username or password";
      }
      //close connection
      $pdo = null;
      $stmt = null;

      //header("Location: ../index.php");

      die();
   } catch (PDOException $e) {
      die("Query failed: ".$e->getMessage());
   }
}else{
   header("Location: ../index.php");
}
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST["username"];
   $pwd = $_POST["pwd"];
   $email = $_POST["email"];

   try {
      require_once "dbh.inc.php"; //require,include,include_once do the sane thing which checks if the file has been included n throws an errror message

     // $query = "INSERT INTO users (username, pwd, email) VALUES (?, ?, ?);"; 
      //putting the variables directly in to values is not a good practice cuz users can inject wrong stuff to our database so it is replaced with question marks

      //using none name parameters, the other in which the inputs r inserted matter
      //$stmt = $pdo->prepare($query); //prepared statement, $stmt stands for statement

      //inserting data to the db using name parameters
      $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
      
      $stmt = $pdo->prepare($query);

      $options = [
         'cost' => 12
      ];
      
      $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
      
      $stmt->bindparam("username", $username);
      $stmt->bindParam(":pwd", $hashedPwd);
      $stmt->bindParam(":email", $email);
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


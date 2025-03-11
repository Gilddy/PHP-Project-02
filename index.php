<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="database.css">
   <title>DataBases with MySQL in PHP</title>
</head>
<body>
   <div class="formarea">
      <div class="signup">
         <h3>SignUp</h3>

         <form action="includes/formhandler.inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="email" placeholder="E-mail">
            <button>SignUp</button>
         </form>
      </div>

      <div class="changeaccount">
         <h3>Change Account</h3>

         <form action="includes/userupdate.inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="email" placeholder="E-mail">
            <button>Update</button>
         </form>
      </div>

      <div class="deleteaccount">
         <h3>Delete Account</h3>

         <form action="includes/userdelete.inc.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <button>Delete</button>
         </form>  
      </div>
   </div>

</body>
</html>

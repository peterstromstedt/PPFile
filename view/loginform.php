<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
   <title>Login</title>
</head>
<body>
   <header>
      <h1>Login to Prague Parking</h1>      
   </header>
   <main>
      <fieldset>         
         <form method="post" action="../login.php">
         <label for="user">User</label>
         <input type="text" name="user" required>
         <label for="password">Password</label>
         <input type="password" name="password" required>
         <input type="submit" value="Sign In">
    </form>
      </fieldset>
   </main>
   <a href="signupform.php">do you need an account?</a>
</body>
</html>
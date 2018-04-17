<?php
  session_start();
  require_once 'dbconfig.php';

  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //echo "Connected to $dbname at $host successfully";


     if(isset($_POST['signin'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $select = $conn->prepare("SELECT * FROM user WHERE email='$email' and password='$password'");
      $select->setFetchMode(PDO::FETCH_ASSOC);
      $select->execute();
      $data=$select->fetch();

      if ($data['email'] != $email and $data['password'] != $password) {
        echo "invalid email or password";
      } elseif ($data['email'] == $email and $data['password'] == $password) {
        $_SESSION['email']=$data['email'];
        $_SESSION['username']=$data['username'];
        header("location:profile.php");
      }
    }

  } catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
  }
 ?>

 <html>
 <body>
   <div style="width:500px; float:left; height:600px;">
     <div style="padding:85px;">
       <h1>Log In Here</h1>
       <form method="post">
       <label for="email">Email: </label>
       <input type="text" name="email" placeholder="Email"><br><br>
       <label for="password">Password: </label>
       <input type="text" name="password" placeholder="Password"><br><br>
       <input type="submit" name="signin" value="SIGN IN">
       <a href="signup.php">Sign up!</a>
     </form>
     </div>
   </div>
 </body>
 </html>

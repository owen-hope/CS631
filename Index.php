<?php
  session_start();
  require_once 'dbconfig.php';

  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //echo "Connected to $dbname at $host successfully";


     if(isset($_POST['signin'])) {
      $EMail = $_POST['EMail'];


      $select = $conn->prepare("SELECT * FROM customer WHERE EMail='$EMail'");
      $select->setFetchMode(PDO::FETCH_ASSOC);
      $select->execute();
      $data=$select->fetch();

      if ($data['EMail'] != $EMail) {
        echo "invalid Email";
      } elseif ($data['EMail'] == $EMail) {
        $_SESSION['EMail']=$data['EMail'];
        $_SESSION['FName']=$data['FName'];
        $_SESSION['CID']=$data['CID'];
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
       <label for="EMail">Email: </label>
       <input type="text" name="EMail" placeholder="Email"><br><br>
       <input type="submit" name="signin" value="SIGN IN">
     </form>
     <a href="signup.php">Sign up!</a><br><br>
     <a href="saleStatistics.php">Sale Statistics!</a>
     </div>
   </div>
 </body>
 </html>

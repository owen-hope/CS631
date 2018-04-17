<?php
  session_start();

  if(empty($_SESSION['email'])) {
    header("location:Index.php");
  }
 ?>

 <html>
 <body>
   WELCOME :<?php echo $_SESSION['username']; ?>

   <a href="logout.php">Logout</a>
 </body>
 </html>

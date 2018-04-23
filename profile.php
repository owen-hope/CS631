<?php
  session_start();

  if(empty($_SESSION['EMail'])) {
    header("location:Index.php");
  }
 ?>

 <html>
 <body>
   WELCOME :<?php echo $_SESSION['FName']; ?>

   <a href="logout.php">Logout</a>
 </body>
 </html>

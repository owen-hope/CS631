<?php
  session_start();
  require_once 'dbconfig.php';

  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    if(isset($_POST['signup'])) {
      $FName = $_POST['FName'];
      $LName = $_POST['LName'];
      $EMail = $_POST['EMail'];

      $Address = $_POST['Address'];

      $Phone = $_POST['Phone'];
      $Status = $_POST['Status'];


      $insert = $conn->prepare("INSERT INTO customer (FName,LName,EMail,Phone,Status,Address)
      VALUES(:FName,:LName,:EMail,:Phone,:Status,:Address)");

      $insert->bindParam(':FName', $FName);
      $insert->bindParam(':LName', $LName);
      $insert->bindParam(':EMail', $EMail);


      $insert->bindParam(':Phone', $Phone);
      $insert->bindParam(':Status', $Status);
      $insert->bindParam(':Address', $Address);

      $insert->execute();
      //header("location:Index.php");
    }
    //header("location:Index.php");

  } catch (Exception $e) {
    echo $e->getMessage();

  }

 ?>


<html>
<body>
  <div style="width:500px; height:600px; float:left;">
    <div style="padding:85px;">
      <h1>Create Account here</h1>
      <form method="post">
        <!--
        <label for="username">Username: </label>
        <input type="text" name="username" placeholder="Username"><br><br>
      -->
        <label for="FName">First Name: </label>
        <input type="text" name="FName" placeholder="First Name"><br><br>
        <label for="LName">Last Name: </label>
        <input type="text" name="LName" placeholder="Last Name"><br><br>
        <label for="EMail">Email: </label>
        <input type="text" name="EMail" placeholder="Email"><br><br>
        <label for="Phone">Phone Number: </label>
        <input type="text" name="Phone" placeholder="###-###-####"><br><br>
        <!--
        <label for="password">Password: </label>
        <input type="text" name="password" placeholder="Password"><br><br>
      -->
        <label for="Status">Status: </label>
        <select name="Status">
          <option value="Status">Status</option>
          <option value="regular">Regular</option>
          <option value="silver">Silver</option>
          <option value="gold">Gold</option>
          <option value="platinum">Platinum</option>
        </select><br><br>
        <p><font size="5"><b>Address Info</b></font></p>
        <label for="Address">Address: </label>
        <input type="text" name="Address" placeholder="Address"><br><br>

        <p><font size="5"><b>Credit Card Info</b></font></p>
        <label for="CCNumber">Credit Card Number: </label>
        <input type="text" name="CCNumber" placeholder="XXXX-XXXX-XXXX-XXXX"><br><br>
        <label for="SecNumber">CVV: </label>
        <input type="text" name="SecNumber" placeholder="XXX"><br><br>
        <label for="OwnerName">Card Holder Name: </label>
        <input type="text" name="OwnerName" placeholder="John Doe"><br><br>
        <label for="CCType">Credit Card Type: </label>
        <select name="CCType">
          <option value="Type">Type</option>
          <option value="Visa">Visa</option>
          <option value="Master">MasterCard</option>
          <option value="Discover">Discover</option>
          <option value="American">American Express</option>
        </select><br><br>
        <label for="CCAddress">Billing Address: </label>
        <input type="text" name="CCAddress" placeholder="Billing Address"><br><br>
        <label for="ExpDate">Experation Date</label>
        <input type="text" name="ExpDate" placeholder="MM/YYYY">
        <input type="submit" name="signup" value="SIGN UP">
      </form>
    </div>
  </div>
</body>
</html>

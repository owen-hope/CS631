<?php

  function mostFrequentlySold() {

  }

  function highestNumDistinctCustomers() {

  }

  function bestCustomers() {

  }

  function bestZipCodes() {

  }

  function aveSellingProductPrice() {

  }

  
  session_start();
  require_once 'dbconfig.php';

  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    if(isset($_POST['getData'])) {
      $startDate = $_POST['startDate'];
      $endDate = $_POST['endDate'];
      $statistics = $_POST['statistics'];

      $mysqlStartDate = date("Y-m-d", strtotime($startDate));
      $mysqlEndDate = date("Y-m-d", strtotime($endDate));

      switch ($statistics) {
        case 'mostFrequentlySold':
          // code...
          break;

        case 'highestNumDistinctCustomers':
          // code...
          break;

        case 'bestCustomers':
          // code...
          break;

        case 'bestZipCodes':
          // code...
          break;

        case 'aveSellingProductPrice':
          // code...
          break;

        default:
          // code...
          break;
      }

    }

  } catch (Exception $e) {
    echo $e->getMessage();
  }

 ?>


<html>
<body>
  <h1>Sale Statistics</h1>
  <p>Choose a start date and end date. Then choose the option you would like to
    see for those dates. Press the enter button once you have decided everything</p>
  <form method="post">
    <label for="startDate">Start Date: </label>
    <input type="date" name="startDate" placeholder="MM/DD/YYYY">
    <label for="endDate">End Date: </label>
    <input type="date" name="endDate" placeholder="MM/DD/YYYY"><br><br>
    <select name="statistics">
      <option value="statistics">Statistics</option>
      <option value="mostFrequentlySold">Most frequently Sold</option>
      <option value="highestNumDistinctCustomers">Products sold to highest number
        of distinct custiomers</option>
      <option value="bestCustomers">Top 10 best customers (based on money spent)</option>
      <option value="bestZipCodes">5 best zip codes (terms of shipments made)</option>
      <option value="aveSellingProductPrice">Average selling product price per
        product type</option>
    </select><br><br>
    <input type="submit" name="getData" value="Get Data">
  </form>

</body>
</html>

<?php
  //most frequently sold product
  function mostFrequentlySold($startDate, $endDate, $conn) {

    //AS OF RN THIS ONLY RETURNS THE PName OF THE ONE WITH THE MAX VALUE
    $query = $conn->prepare("SELECT p.PName
    FROM product AS p, cart AS c, appears_in AS a
    WHERE c.CartID = a.CartID AND a.PID = p.PID AND
    a.Quantity = (SELECT MAX(Quantity) FROM appears_in WHERE c.CartID = a.CartID AND a.PID = p.PID
    AND c.TDate BETWEEN '$startDate' AND '$endDate')
    GROUP BY p.PName");

    $query->execute();
    echo "\nPDOStatement::errorInfo():\n";
    $arr = $query->errorInfo();
    print_r($arr);


    //echo "<table>";
    //Iterate
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      echo $row['PName'];
      echo "<br>";
      $result[] = $row;
    }
    //echo "</table>";
    return $result;
  }

  //query call for products sold to highest number of different customers
  function highestNumDistinctCustomers($startDate, $endDate, $conn) {


    $query = $conn->prepare();

  }

  //query call for the top 10 customers who spend the most money
  function bestCustomers($startDate, $endDate, $conn) {

    $query = $conn->prepare("SELECT c.FName, c.LName, SUM((a.PriceSold * a.Quantity)) AS s
    FROM appears_in AS a, cart AS ca, shipping_address AS sa, customer AS c
    WHERE a.CartID = ca.CartID AND (ca.CID, ca.SAName) = (sa.CID, sa.SAName) AND sa.CID = c.CID
    AND ca.TDate BETWEEN '$startDate' AND '$endDate'
    GROUP BY c.CID
    ORDER BY s DESC LIMIT 10");

    $query->execute();

    //Iterate
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      echo $row['FName'] . " " . $row['LName'];
      echo "<br>";
      $result[] = $row;
    }

    return $result;
  }

  //query call for 5 best zip codes. Zip codes that have the most shipped to them
  function bestZipCodes($startDate, $endDate, $conn) {

    $query = $conn->prepare("SELECT sa.Zip, COUNT(*) AS c
    FROM shipping_address AS sa, cart AS ca
    WHERE (ca.CID, ca.SAName) = (sa.CID, sa.SAName) AND
    ca.TDate BETWEEN '$startDate' AND '$endDate'
    GROUP BY sa.Zip
    ORDER BY c DESC LIMIT 5");

    $query->execute();

    //Iterate
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
      echo $row['Zip'];
      echo "<br>";
      $result[] = $row;
    }

    return $result;
  }

  function aveSellingProductPrice($startDate, $endDate, $conn) {

  }


  session_start();
  require_once 'dbconfig.php';

  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);


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

<?php
if(isset($_POST['getData'])) {
  $startDate = $_POST['startDate'];
  $endDate = $_POST['endDate'];
  $statistics = $_POST['statistics'];


  switch ($statistics) {
    case "mostFrequentlySold":
       print_r(mostFrequentlySold($startDate, $endDate, $conn));

      break;

    case 'highestNumDistinctCustomers':
      // code...
      break;

    case 'bestCustomers':
      print_r(bestCustomers($startDate, $endDate, $conn));
      break;

    case 'bestZipCodes':
      print_r(bestZipCodes($startDate, $endDate, $conn));
      break;

    case 'aveSellingProductPrice':
      // code...
      break;

    default:
      // code...
      break;
  }

}
 ?>

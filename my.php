<?php

// Connect to the MySQL database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "lost_and_found";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the search parameters from the user
$location = $_POST['location'];
$item_type = $_POST['item_type'];
$date_of_loss = $_POST['date_of_loss'];

// Build the SQL query based on the search parameters
$sql = "SELECT * FROM lost_items WHERE 1=1";
if (!empty($location)) {
  $sql .= " AND location = '$location'";
}
if (!empty($item_type)) {
  $sql .= " AND item_type = '$item_type'";
}
if (!empty($date_of_loss)) {
  $sql .= " AND date_of_loss = '$date_of_loss'";
}

// Execute the query and get the results
$result = $conn->query($sql);

// Display the results on the web page
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "Location: " . $row["location"] . "<br>";
    echo "Item Type: " . $row["item_type"] . "<br>";
    echo "Date of Loss: " . $row["date_of_loss"] . "<br><br>";
  }
} else {
  echo "No results found.";
}

// Close the database connection
$conn->close();

?>
<!DOCTYPE html>
<html>
    <head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    </head>
   <style>

table {
  margin-left: auto;
  margin-right: auto;
  font-family: "Roboto", serif;
}

tr:hover {background-color: #D6EEEE;}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
   </style> 
    <body>
    
<?php
/*
  Rui Santos
  Complete project details at https://RandomNerdTutorials.com/esp32-esp8266-mysql-database-php/
  
  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files.
  
  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.
*/

$servername = "localhost";

// REPLACE with your Database name
$dbname = "wear8563_esp_dt";
// REPLACE with Database user
$username = "wear8563_esp_dtt";
// REPLACE with Database user password
$password = "_S12@gh#1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, sensor, location, value1, value2, value3, reading_time FROM SensorData ORDER BY id DESC";

echo '<table cellspacing="7" cellpadding="5" >
      <tr> 
        <td><b>S/N<b></td> 
        <td><b>SENSORS<b></td> 
        <td><b>LOCATION<b></td> 
        <td><b>TEMPERATURE<b></td> 
        <td><b>HUMIDITY<b></td>
        <td><b>AIR QUALITY<b></td> 
        <td><b>DATE & TIME<b></td> 
      </tr>';
 
if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $row_id = $row["id"];
        $row_sensor = $row["sensor"];
        $row_location = $row["location"];
        $row_value1 = $row["value1"];
        $row_value2 = $row["value2"]; 
        $row_value3 = $row["value3"]; 
        $row_reading_time = $row["reading_time"];
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
      
        echo '<tr> 
                <td>' . $row_id . '</td> 
                <td>' . $row_sensor . '</td> 
                <td>' . $row_location . '</td> 
                <td>' . $row_value1 . '</td> 
                <td>' . $row_value2 . '</td>
                <td>' . $row_value3 . '</td> 
                <td>' . $row_reading_time . '</td> 
              </tr>';
    }
    $result->free();
}

$conn->close();
?> 
</table>
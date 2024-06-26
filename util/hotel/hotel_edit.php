<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $hotelID = $_POST['hotelID'] ?? '';
    $hotelName = $_POST['hotelName'] ??'';
    $hotelLocation = $_POST['hotelLocation'] ?? '';
    $hotelDesc = $_POST['hotelDesc'] ?? '';

    $query = "UPDATE hotel 
              SET hotel_name = '$hotelName', 
              hotel_location = '$hotelLocation', 
              hotel_desc = '$hotelDesc' 
              WHERE hotel_id = '$hotelID'";
    $result = mysqli_query($link, $query) or die("Query failed");

    if ($result) {
        echo json_encode(['status' => true, 'message' => 'Hotel updated successfully.']);
    } else {
        // mysqli_error($link) can provide more insight into why the query failed
        echo json_encode(['status' => false, 'message' => 'Failed to update hotel.']);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}